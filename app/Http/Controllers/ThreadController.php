<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    public function index(){
        $threads = Thread::latest()->get();
/*        $threads = DB::table('Threads')->get();*/


        return view('threads.threads', compact('threads'));
    }

    public function show(Thread $thread){

        return view('threads.show', compact('thread'));
    }


    public function create(){

    }
}
