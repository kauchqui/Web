<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','show');
    }

    public function index(){
        $threads = Thread::latest()->get();
        return view('threads.threads', compact('threads'));
    }

    public function show($channelId, Thread $thread){

        return view('threads.show', compact('thread'));
    }


    public function create(){
        return view('threads.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'channel_id'=>'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);
        return redirect($thread->path());
    }
}
