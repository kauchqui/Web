<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageUser extends Controller
{
    public function create($user){

        //todo make it so this only returns users under the super user.

        $employee = User::where('id',$user) -> first();
        $assigned = DB::table('assignedproperty')->select('properties.name as Name')->join('properties','properties.id','=','assignedproperty.property_id')->where('assignedproperty.user_id','=',$employee->id)->get();


        return view('Forms.userUpdate', compact('employee','assigned'));



    }
    public function delete($user){

        $employee = User::where('id',$user) -> first();
        $employee->delete();

        return view('home');

    }
}
