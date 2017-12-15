@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <br>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('viewmaintenance') }}">Maintenance Requests</a>
                    </li>
                </ul>
            </nav>

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                @php($total = DB::table('units')->sum('rent'))
                @php($renters = DB::table('units')->count("renter"))
                <h1>
                    Dashboard
                </h1>
                    <hr>
                    <br>
                    <div>
                        <section class="row text-center placeholders">
                            <div class="col-6 col-sm-3 placeholder">
                                <h5>Monthly Income:</h5>
                                <div class="text-muted">${{number_format($total,'2')}}</div>
                            </div>
                            <div class="col-6 col-sm-3 placeholder">
                                <h5>Quarterly Income(Projected):</h5>
                                <span class="text-muted">${{number_format($total*3,'2')}}</span>
                            </div>
                            <div class="col-6 col-sm-3 placeholder">
                                <h5>Yearly Income(Projected):</h5>
                                <span class="text-muted">${{number_format($total*12,'2')}}</span>
                            </div>
                            <div class="col-6 col-sm-3 placeholder">
                                <h5>Number of Renters:</h5>
                                <span class="text-muted">{{number_format($renters)}}</span>
                            </div>
                        </section>
                    </div>
                    <br>
                    <hr>

                    <h2>Properties</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Property</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php ($properties =  DB::table('properties')->get())
                            @foreach ($properties as $property)
                                @if (($property->user_id) === (Auth::user()->id) )

                                    <tr>
                                        <td><a href="{{ route('manageproperty',['id' => $property->id]) }}">
                                                {{$property->name}}</a></td>
                                        <td>{{$property->address}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <a href= "{{ url('addproperty') }}" class="btn btn-info"> Add Property</a>
                    </div>
                <hr>
                    <h2>Units</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Unit Number</th>
                                    <th>Renter</th>
                                    <th>Rent</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                            <div class="table-responsive" style="overflow-y:auto;height: 500px">
                                <table class="table table-striped">
                            <tbody>
                            @php($units = DB::table('units')->get())
                            @foreach($units as $unit)
                                <tr>
                                    <td>{{$unit->name}}</td>
                                    <td>{{$unit->renter}}</td>
                                    <td>${{number_format($unit->rent,'2')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </main>
        </div>
    </div>

@endsection

