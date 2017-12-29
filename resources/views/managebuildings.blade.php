@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h3>Basic Building Information</h3>
                    </div>
                    <div class="card-body">
                        <span>Property Location: {{$property->name}} </span>
                        <br>
                        <span>Building Name: {{$building->name}} </span>
                {{--<br>--}}
                {{--<span class="w3-tag w3-small w3-theme-d5">Building Tenant: {{$building->tenant}}</span>--}}
                    {{--<br>--}}
                        <hr>
                        <h3>Units</h3>
                        <p><a class="btn btn-primary" href="{{ url('addunit',['id' => $building->id]) }}" role="button"> Add a Unit >></a></p>

                        <div class="table table-responsive" style="overflow-y:auto;height: 500px">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Unit Number</th>
                                    <th>Renter</th>
                                    <th>Rent</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($units = DB::table('units')->get())
                                @foreach($units as $unit)
                                    <tr>
                                        <td><a href="{{ route('manageunit',['id' => $unit->id]) }}"> {{$unit->name}} </a></td>
                                        <td>{{$unit->renter}}</td>
                                        <td>${{number_format($unit->rent,'2')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection