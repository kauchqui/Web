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

        //todo finish setting up automatic email to staff.

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




       $request->session()->flash('status', 'Your maintenance request was submitted');

        return redirect('userhome');

    }

}
