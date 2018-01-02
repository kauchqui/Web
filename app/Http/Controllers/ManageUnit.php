<?php
/**
 * Created by IntelliJ IDEA.
 * User: Owen
 * Date: 11/11/2017
 * Time: 8:33 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ManageUnit
{
    public function create($id)
    {
        $request = DB::table('requests')->where('unit_id','=',$id)->first();

        $unit = DB::table('units')->where('id', '=', $id)->first();

        $building = DB::table('buildings')->where('id', '=', $unit->building_id)->first();

        $property = DB::table('properties')->where('id', '=', $building->property_id)->first();

        return view('manageunit')->with('unit', $unit)->with('building', $building)->with('property', $property)->with('request', $request);

    }
    public function images($unit){

        $pictures = DB::table('maintenancepictures')->where('maintenance_id','=',$unit)->get();

        return $pictures;

    }
}