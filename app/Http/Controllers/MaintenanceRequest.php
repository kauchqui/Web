<?php
/**
 * Created by IntelliJ IDEA.
 * User: Owen
 * Date: 11/11/2017
 * Time: 10:20 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mrequest;
use App\pictureAdd;

use Log;
use Mail;

class MaintenanceRequest extends Controller
{
    /*
     * Create a new user instance.
     *
     * @param  Request $request
     * @return Response
     */

    public function create(Request $request, $id)
    {
        //todo create cloudinary config file and use a simple include statement.
        \Cloudinary::config(array(
            "cloud_name" => "dwunmryjy",
            "api_key" => "392581967417787",
            "api_secret" => "Gfvlo-MD4baaYC877MUuglXCVsM"
        ));

/*
        $matchThese = ['permissions' => 3, '' => 'another_value', ...];


        $staff = DB::table('users')->select(['email'])->where('permissions','=',3)

            $pictures = DB::table('maintenancepictures')->select(['picture'])->where('maintenance_id','=',$mrequest->id)->pluck('picture')->all()*/

        $unit = DB::table('units')->where('id', '=', $id)->first();

        //$mrequest creates a new maintenance request tuple

        $mrequest = new Mrequest;

        $mrequest->unit_id = $unit->id;

        $mrequest->renter = $unit->renter;

        $mrequest->maintenance = $request->maintenance;

        $mrequest->status = false;

        $mrequest->save();

        $lastID = DB::getPdo()->lastInsertId();


        //for each picture we store it in the maintenancepictures relation

        $files = $request->file('picture');
        if($files != null) {
            foreach ($files as $file) {
                $uploaded = \Cloudinary\Uploader::upload($file, array("use_filename" => TRUE));


                //todo test multiple picture input
                //$uploaded['public_id'];

                $pictureAdd = new pictureAdd;
                $pictureAdd->unit_id = $unit->id;
                $pictureAdd->picture = $uploaded['public_id'];
                $pictureAdd->maintenance_id = $lastID;
                $pictureAdd->save();

            }
        }

        $user = Auth::user();
        $property = $user->personalproperty;
        $staff = DB::table('assignedproperty')->where('property_id','=',$property)->pluck('staff_email')->all();
        foreach($staff as $employee){
            Log::info('Shows $request->maintenance that will be sent to sendEmail method '.$request->maintenance);
            Log::info('Shows $unit->name that will be sent to sendEmail method '.$unit->name);


            $this->sendEmail($request, $employee,$unit);
        }



       $request->session()->flash('status', 'Your maintenance request was submitted');

        return redirect('userhome');

    }

    public function sendEmail(Request $request, $employee,$unit)
    {
        $issue = $request->maintenance;
        $unitNumber = $unit->name;
        $unitBuilding = $unit->building_id;

        Log::info('Showing employee email that will receive mrequest '.$employee);


        /* $data = $request->all();*/

        Log::info('Showing unumber in content '.$unitNumber);
        Log::info('Showing issue in content '.$issue);
        Mail::send(['html'=>'mrequestEmail'], ['content'=>$issue,'UNumber'=>$unitNumber,'UBuilding'=>$unitBuilding], function ($message) use ($employee) {
            $message->to($employee, 'To ManageIT')->subject('New Maintenance Request');
            $message->from('manageitteam1@gmail.com', 'ManageIT');
        });
        $request->session()->flash('status', 'Your request was submitted');

    }

}
