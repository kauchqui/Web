@extends('layouts.app')

@section('content')
    @if(Auth::user()->permissions == 1 || Auth::user()->permissions == 3)
    <div class = "container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>
                        <div class="card-body">
                            <form method="POST" action="/threads">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="channel">Choose a Channel</label>
                                    <select name="channel_id" class = "form-control" id="channel_id">
                                        <option>Choose one...</option>

                                    @foreach(App\Channel::all() as $channel)
                                            <option value="{{$channel->id}}">{{ $channel->name }}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <textarea name="body" id="body" class="form-control" rows="8">{{ old('body') }}</textarea>
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                                </div>
                                @if(count($errors))
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
    @endif
@endsection