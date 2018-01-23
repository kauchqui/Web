<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    //
    public function generate($id)
    {
        // grabs autofill items for report
        $reportinfo = DB::table('requests')->where('id', '=', $id)->first();

        return view('maintenance.report', compact('reportinfo'));
    }

    public function resolveReport($id)
    {
        //        updates request as resolved in database, and stores report in database when resolve button hit

        DB::table('requests')->where('id','=',$id)->update([
            'status' => 1
        ]);


        $sid = Auth::user()->id; // this doesnt work // todo

        Report::create([

            //need to finish linking report to user
            'staff_id' => $sid,
            'user_id' => 1,
            'unit_id' => 1,
            'body' => request('inputReport'),
            'issue' => 'placeholder',
            'issue_desc' => request('inputDesc'),
            'resolved' => true

        ]);

        return redirect('home');
    }

    public function delete()
    {
        //deletes report for maximal sketchyness
    }
}
