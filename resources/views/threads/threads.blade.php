@extends('layouts.app')

@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <div class = "container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2 ">
              <div class="panel panel-default">
          <div class="panel-heading">Forum Threads</div>
          <div class="panel-body">
              @foreach($threads as $thread)
                  <article>
                      <h4>
                          <a href ="{{$thread->path()}}">{{$thread->title}}</a>
                      </h4>
                      <div class="body">{{$thread->body}}</div>
                  </article>
                  @endforeach
              <hr>
          </div>
          </div>
          </div>
      </div>
    </div>
@endsection