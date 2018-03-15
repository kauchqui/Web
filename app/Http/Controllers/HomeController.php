<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->permissions == 1){
            return view('home');
        }
        else if(Auth::user()->permissions == 2){

            return view('home');

        }
    }

    public function addUnit(Request $request)
    {
        $user = Auth::user();

        $propertyid = $request->get('property_id');

        $buildingid = $request->get('building_id');

        $unitid = $request->get('unit_id');

        $property = DB::table('properties')->where('id', '=', $propertyid)->first();

        $building = DB::table('buildings')->where('id', '=', $buildingid)->first();

        $unit = DB::table('units')->where('id', '=', $unitid)->first();

        $user->personalunit = $unit->id;

        $user->personalbuilding = $building->id;

        $user->personalproperty = $property->id;

        $user->save();

        return redirect('home');

    }
    public function myforrm()
    {
        $properties = DB::table('properties')->pluck("name","id")->all();
        return view('home',compact('properties'));
    }


    public function selectbuild(Request $request){
        $data = DB::table('buildings')->where('property_id',$request->property_id)->pluck("name","id")->all();
        return response()->json($data);
    }

    /**
     * Show the application selectAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectBuilding(Request $request)
    {
        if($request->ajax()){
            $buildings = DB::table('buildings')->where('property_id',$request->property_id)->pluck("name","id")->all();
            try {
                $data = view('building-select', compact('buildings'))->render();
            } catch (\Throwable $e) {
            }
            return response()->json(['options'=>$data]);
        }
    }

    public function selectUnit(Request $request)
    {
        if($request->ajax()){
            $units = DB::table('units')->where('building_id',$request->building_id)->pluck("name","id")->all();
            try {
                $data = view('unit-select', compact('units'))->render();
            } catch (\Throwable $e) {
            }
            return response()->json(['options'=>$data]);
        }
    }
}
