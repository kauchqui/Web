@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Maintenance Request</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('addmaintenance',['id' => Auth::user()->personalunit])}}" >
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="maintenance" class="col-md-4 control-label">Maintenance Needed</label>
                                <div class="col-md-6">
                                    <input id="maintenance" type="text" class="form-control" name="maintenance" required>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fileupload" class="col-md-4 control-label">Picture Documentation</label>

                                <div class="col-md-6">
                                    <input id="fileupload[]" type="file" name="picture[]" multiple accept="image/gif, image/jpeg, image/png">

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Request
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
