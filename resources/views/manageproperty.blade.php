@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card" >
                    <div class="card-header">
                    <h3>Basic Property Information</h3>
                    </div>
                <div class="card-body">
                <span>Property Name: {{$property->name}}</span>
                <br>
                <span>Property Address: {{$property->address}}</span>
                <br>
                <span>Property Owner: {{$property->owner}}</span>
                <br>
                <h2>Buildings</h2>

                @php ($buildings =  DB::table('buildings')->get())
                @foreach ($buildings as $building)
                    @if (($building->property_id) === ($property->id) )
                        <a href="{{ route('managebuilding',['id' => $building->id]) }}" class="btn btn-submit"> {{$building->name}} </a>
                        <br>
                    @endif
                @endforeach
                    <br>
                <a href="{{ url('addbuilding',['id' => $property->id]) }}" class="btn btn-info"> Add a Building >></a>
                </div>
                </div>
            </div>
        </div>
    </div>


@endsection

<?php
/*\Cloudinary::config(array(
    "cloud_name" => "dwunmryjy",
    "api_key" => "392581967417787",
    "api_secret" => "Gfvlo-MD4baaYC877MUuglXCVsM"
));
echo cl_image_tag("sample.jpg", array( "alt" => "Sample Image" ));

*/?>
