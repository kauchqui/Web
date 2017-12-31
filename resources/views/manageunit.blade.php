@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card" >
                <div class="card-header">
                    <h3>Basic Unit Information</h3>
                </div>
                    <div class="container">
                        <div>
                            <br>
                            <span>Property Location: {{$property->name}} </span>
                            <br>
                            <span>Building Location: {{$building->name}} </span>
                            <br>
                            <span>Unit Name: {{$unit->name}}</span>
                            <br>
                            <span>Unit Renter: {{$unit->renter}}</span>
                            <br>
                            @php ($mrequests =  DB::table('requests')->get())

                            @foreach($mrequests as $mrequest)
                                @if($mrequest->unit_id === $unit->id && $mrequest->status === 0)


                                    <?php \Cloudinary::config(array(
                                        "cloud_name" => "dwunmryjy",
                                        "api_key" => "392581967417787",
                                        "api_secret" => "Gfvlo-MD4baaYC877MUuglXCVsM"
                                    ));?>
                                    <span class="w3-tag w3-small w3-theme-d5">Unit Maintenance: {{$mrequest->maintenance}}  <a href="{{ route('updateMaintenanceRequest',['id' => $mrequest->id]) }}" button type="submit" class="btn btn-primary">Resolve</a></span>
                                    <span class="w3-tag w3-small w3-theme-d5">Picture:
                                        @php($pictures = DB::table('maintenancepictures')->where('maintenance_id','=',$mrequest->id))
                                        {{--{{\App\Http\Controllers\ManageUnit::images($pictures)}}--}}
                                        @foreach($pictures->picture as $picture)
                                        @php($pname = $picture -> picture)
                                        @php(cl_image_tag( $pname,
                                            array("transformation"=>array(array("width"=>110, "height"=>110,),array("width"=>106, "crop"=>"scale"))))

                                            )
                                        @endforeach
                                            @endif
                                    </span>

                                    <br>

                            @endforeach

                            <br>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection