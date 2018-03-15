@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        New Building for {{$property->name}}
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST"
                              action="{{ route('updateBuilding',$property->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Building Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>

                                            {{ route('updateBuilding',$property->id) }}

                                        </span>

                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="tenant" class="col-md-4 control-label">Tenant</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="tenant" type="text" class="form-control" name="tenant" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="container">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Building
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
