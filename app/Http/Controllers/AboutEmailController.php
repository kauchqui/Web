<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutEmailController extends Controller
{
    public function sendEmail(Request $request)
    {

        $first = $request->input('first');
        $last = $request->input('last');
        $email = $request->input('email');
        $content = $request->input('message');
        $phone = $request->input('phone');

       /* $data = $request->all();*/
        Mail::send(['html'=>'mail'], ['first' => $first, 'last' => $last,'email'=>$email,'content'=>$content,'phone'=>$phone], function ($message) {
            $message->to('quintinkauchick@yahoo.com', 'To ManageIT')->subject('About Inquiry');
            $message->from('manageitteam1@gmail.com', 'ManageIT');
        });
        $request->session()->flash('status', 'Your request was submitted');

        return view('about');
    }
}
