@extends('layouts.app')

@section('content')

    @php($auth = Auth::user()->permissions)


    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <br>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="#">Reports</a>--}}
                    {{--</li>--}}
                    @if($auth == 1)
                        @php($rcount = DB::table('requests')->where('status','0')->count())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('viewmaintenance') }}">Maintenance @if($rcount > 0)
                                ({{$rcount}})@endif
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('threads') }}">Forum</a>
                        </li>
                    @endif
                    @if($auth == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('maintenance',['id' => Auth::user()->personalunit]) }}">Request Maintenance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('expenses',['id' => Auth::user()->personalunit])
                            }}">Manage Expenses</a>
                        </li>

                    @endif
                    @if($auth == 3)
                        @php($rcount = DB::table('requests')->where('status','0')->count())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('viewmaintenance') }}">Maintenance @if($rcount > 0)
                                    ({{$rcount}})@endif
                            </a>
                        </li>
                        @endif
                </ul>
            </nav>

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>
                    Dashboard
                </h1>
                    <hr>
                    <br>
                    <div>
                        <section class="row text-center placeholders">
                            @if($auth == 1)

                                @php($total = DB::table('units')->sum('rent'))
                                @php($renters = DB::table('units')->count("renter"))

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
                                @endif
                            @if($auth == 2)
                                <div id="chart">
                                    @if((Auth::user()->personalunit != 0))
                                        <?php
                                        $unit = DB::table('units')->where('id', Auth::user()->personalunit)->first();

                                        $expenses = Lava::DataTable();

                                        try {
                                            $expenses->addStringColumn('Monthly Expenses')
                                                ->addNumberColumn('$')
                                                ->addRow(array('Gas', $unit->gas))
                                                ->addRow(array('Water', $unit->water))
                                                ->addRow(array('Electricity', $unit->electricity))
                                                ->addRow(array('Damages', $unit->damages))
                                                ->addRow(array('Rent', $unit->rent))
                                                ->addRow(array('Total', $unit->rent + $unit->damages + $unit->electricity + $unit->water + $unit->gas));
                                        } catch (\Khill\Lavacharts\Exceptions\InvalidCellCount $e) {
                                        } catch (\Khill\Lavacharts\Exceptions\InvalidColumnType $e) {
                                        } catch (\Khill\Lavacharts\Exceptions\InvalidLabel $e) {
                                        } catch (\Khill\Lavacharts\Exceptions\InvalidRowDefinition $e) {
                                        } catch (\Khill\Lavacharts\Exceptions\InvalidRowProperty $e) {
                                        }
                                        $chart = Lava::BarChart('Expenses', $expenses);

                                        echo Lava::render('BarChart','Expenses','chart');
                                        ?>
                                    @endif
                                </div>
                                @endif

                                @if($auth == 3)
                                    @php($requests = DB::table('requests')->count("id"))
                                    @php($res = DB::table('requests')->where('status','=','1')->count("id"))
                                    @php($unres = DB::table('requests')->where('status','=','0')->distinct()
                                    ->count("id"))
                                {{--todo: make this only query the number of renters on the staffs property--}}
                                    @php($renters = DB::table('units')->count("renter"))

                                    <div class="col-6 col-sm-3 placeholder">
                                        <h5>All-time Requests Made:</h5>
                                        <div class="text-muted">{{number_format($requests)}}</div>
                                    </div>
                                    <div class="col-6 col-sm-3 placeholder">
                                        <h5>All-time Requests Resolved:</h5>
                                        <span class="text-muted">{{number_format($res)}}</span>
                                    </div>
                                    <div class="col-6 col-sm-3 placeholder">
                                        <h5>Percentage of Units with Open Requests:</h5>
                                        <span class="text-muted">{{number_format($unres/(float)$renters,'3')}}%</span>
                                    </div>
                                    <div class="col-6 col-sm-3 placeholder">
                                        <h5>Number of Renters:</h5>
                                        <span class="text-muted">{{number_format($renters)}}</span>
                                    </div>
                                @endif
                        </section>
                    </div>
                    <br>
                    <hr>

                @if($auth == 1)
                    @php ($properties =  DB::table('properties')->get())
                    @if($properties->count() != 0)
                    <h2>Properties</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>Property</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>

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
                    </div>
                        @endif
                    <div>
                        <a href= "{{ url('addproperty') }}" class="btn btn-info"> Add Property</a>
                    </div>


                @endif
                @if($auth == 2)
                    <p>My Unit</p>
                    <div class="card"><br>
                        <div class="card-body">
                            <p>My Unit</p>
                            @php ($units =  DB::table('units')->get())
                            @foreach ($units as $unit)
                                @if(($unit->id) === (Auth::user()->personalunit) )
                                    <a class="btn btn-info" href="{{ route('manageunit',['id' => $unit->id])
                                            }}">
                                        {{$unit->name}} </a>

                                @endif
                            @endforeach

                            {{--todo: speed up this form--}}
                        </div>


                        <form class="form-horizontal" method="POST" action="{{ route('updateUserUnit') }}">
                            {{ csrf_field() }}

                            <br>
                            <span class="w3-right w3-opacity"></span>
                            <br>

                            {!! Form::open() !!}


                            <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>


                            <div class="form-group">
                                <label for="property" class="col-md-4 control-label">Property</label>
                                {!! Form::select('property_id',[''=>'--- Select Property ---']+$properties,null,['class'=>'form-control']) !!}
                            </div>


                            <div class="form-group">
                                <label for="building" class="col-md-4 control-label">Building</label>
                                {!! Form::select('building_id',[''=>'--- Select Building ---'],null,['class'=>'form-control']) !!}

                            </div>

                            <div class="form-group">
                                <label for="unit" class="col-md-4 control-label">Unit</label>
                                {!! Form::select('unit_id',[''=>'--- Select Unit ---'],null,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>

{{--
                            <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
--}}


                            <script type="text/javascript">
                                $("select[name='property_id']").change(function(){
                                    var property_id = $(this).val();
                                    var token = $("input[name='_token']").val();
                                    $.ajax({
                                        url: "<?php echo route('select-building') ?>",
                                        method: 'POST',
                                        data: {property_id:property_id, _token:token},
                                        success: function(data) {
                                            $("select[name='building_id']").html('');
                                            $("select[name='building_id']").html(data.options);
                                        }
                                    });
                                });
                            </script>

                            <script type="text/javascript">
                                $("select[name='building_id']").change(function(){
                                    var building_id = $(this).val();
                                    var token = $("input[name='_token']").val();
                                    $.ajax({
                                        url: "<?php echo route('select-unit') ?>",
                                        method: 'POST',
                                        data: {building_id:building_id, _token:token},
                                        success: function(data) {
                                            $("select[name='unit_id']").html('');
                                            $("select[name='unit_id']").html(data.options);
                                        }
                                    });
                                });
                            </script>

                            {!! Form::close() !!}


                        </form>
                    </div>
                @endif

                {{--maintenance staff--}}


                @if($auth == 1)
                <hr>
                    <div class = "card">
                        <div class = "card-body">
                    <h2>Units</h2>

                    <div class="table table-responsive">
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
                                    <td>{{$unit->name}}</td>
                                    <td>{{$unit->renter}}</td>
                                    <td>${{number_format($unit->rent,'2')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Employees</h2>
                    @php($employees = DB::table('users')->distinct()->select('assignedproperty.user_id as UID')->join('properties','properties.user_id','=','users.id')->join('assignedproperty', 'properties.id','=','assignedproperty.property_id')->where('users.id','=',Auth::user()->id)->get())

                    <div class = "card">
                        <div class = "card-body">

                            <div class="table table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Properties</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $employee)
                                                @php($staffInfo = DB::table('users')->where('id','=',$employee->UID)->first())
                                                @php($assigned = DB::table('assignedproperty')->select('properties.name as Name')->join('properties','properties.id','=','assignedproperty.property_id')->where('assignedproperty.user_id','=',$employee->UID)->get())
                                                @if($staffInfo->permissions == 3)
                                                    @php($role = "Maintenance")
                                                @else
                                                    @php($role = "Admin")
                                                @endif
                                                @php($key = 0)
                                        <tr>

                                            <td>{{$staffInfo->name}}</td>
                                            <td>{{$staffInfo->email}}</td>
                                            <td>{{$role}}</td>
                                            <td>
                                            @foreach($assigned as $assign)

                                                @php(Log::info('Showing assign'.$assign->Name))

                                                @if($key === 0)
                                                    {{$assign->Name}}
                                                    @php($key = 1)
                                                @else
                                                    / {{$assign->Name}}

                                                @endif

                                            @endforeach
                                            </td>
                                            <td>  <a href= "{{ route('ManageUserForm',['user'=>$employee->UID]) }}" class="btn btn-info"> Update</a>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('DeleteUser',['user'=>$employee->UID]) }}" class="btn btn-outline-danger float-right">Delete</a>--}}

                                                <a href="{{ route('home') }}" class="btn btn-outline-danger">Delete</a>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            <hr>

                        </div>

                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection

@section('scripts')
  {{--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">
        $("select[name='property_id']").change(function(){
            var property_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-building') ?>",
                method: 'POST',
                data: {property_id:property_id, _token:token},
                success: function(data) {
                    $("select[name='building_id']").html('');
                    $("select[name='building_id']").html(data.options);
                }
            });
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">
        $("select[name='building_id']").change(function(){
            var building_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-unit') ?>",
                method: 'POST',
                data: {building_id:building_id, _token:token},
                success: function(data) {
                    $("select[name='unit_id']").html('');
                    $("select[name='unit_id']").html(data.options);
                }
            });
        });
    </script>
--}}
@stop

