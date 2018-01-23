<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateUser extends Controller
{
    public function update(Request $request, $user){

        //todo make it so this only returns users under the super user.

        $employee = User::where('id',$user) -> first();
        $employee->name = $request->newname;
        $employee->email = $request->newemail;
        $employee->save();



        return view('home');

    }

}
