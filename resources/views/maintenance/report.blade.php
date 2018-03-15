@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    @php($name = DB::table('units')
                                ->where('id','=',$reportinfo->unit_id)->first())
                    <div class="card-header">
                        <h5>Report for Unit {{$name->name}}</h5>
                    </div>
                    <div class="card-body">
                        {{--<form role="form" method="POST" action="{{route('resolveReport')}}">--}}
                        <form role="form" method="POST" action="{{ route('report',['id' => $reportinfo->id])}}">

                            {{ csrf_field() }}

                            <div class="form-group row">

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Issue:
                                    {{$reportinfo->maintenance}}</label>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Issue Description</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="inputDesc" name="inputDesc">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label text-lg-right">Report</label>


                                <div class="col-lg-6">

                                    <textarea type="text" class="form-control" id="inputReport"
                                              name="inputReport"></textarea>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 offset-lg-4">
                                    <button type="submit" class="btn btn-primary">
                                        Resolve
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