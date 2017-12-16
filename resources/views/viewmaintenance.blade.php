@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Maintenance Requests</div>
                    <div class="card-body">
                        @foreach($properties as $property)
                            <p style="font-size:160%;">Property: {{$property->name}} </p>
                            <hr>
                            @foreach($buildings as $building)
                                @if($building->property_id === $property->id)
                                    <p style="font-size:120%;"> {{$building->name}} </p>
                                @endif
                                    <div class="table table-responsive" style="overflow-y:auto;">
                                        <table class="table table-striped">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>Unit Number</th>
                                                <th>Request</th>
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($units as $unit)
                                                @foreach($requests as $request)
                                                    @if($request->unit_id === $unit ->id && $unit->building_id === $building->id && $building->property_id === $property->id)
                                                        @if($request->status == false)
                                                            <tr>
                                                                <td><a href="{{ route('manageunit',['id' => $unit->id]) }}"> {{$unit->name}}</a></td>
                                                                <td><a href="{{ route('manageunit',['id' => $unit->id]) }}">{{$request->maintenance}}</a></td>
                                                                <td><a>{{$contact = DB::table('users')
                                                                ->where('personalunit','$unit->id')->pluck('email')}}
                                                                    </a></td>
                                                            </tr>
                                                            {{--@else
                                                            <a href="{{ route('manageunit',['id' => $request->id]) }}"> {{$unit->name}}: {{$request->maintenance}} {{"------requests resolved"}} </a>
                                                            <br>--}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                <hr>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







