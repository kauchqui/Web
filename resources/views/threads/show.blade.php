@extends('layouts.app')

@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class = "container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$thread->title}}
                    </div>
                    <div class="panel-body">
                        {{$thread->body}}
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                @foreach($thread->replies as $reply)

                    @include('threads.reply')

                @endforeach
            </div>
        </div>
    </div>
@endsection