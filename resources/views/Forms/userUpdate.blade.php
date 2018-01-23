@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update {{$employee->name}}'s Profile</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('updateUser',['user' => $employee->id])}}" >
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="userUpdate" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="userUpdate" type="text" class="form-control" name="newname" value="{{ old('name', $employee->name) }}" required>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="userUpdate" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="userUpdate" type="text" class="form-control" name="newemail" value="{{ old('email', $employee->email) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Update
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