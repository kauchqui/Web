@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Property Registration</div>
                    <div class="container">
                        <div class="card-body">
{{--todo: javascript not working--}}
                            <div id="locationField">
                                <input id="autocomplete" placeholder="Enter your address"
                                       onFocus="geolocate()" type="text">
                            </div>

                            <hr>

                            <table id="address">
                                <tr>
                                    <td class="label">Street address</td>
                                    <td class="slimField"><input class="field" id="street_number"
                                                                 disabled="true"/></td>
                                    <td class="wideField" colspan="2"><input class="field" id="route"
                                                                             disabled="true"/></td>
                                </tr>
                                <tr>
                                    <td class="label">City</td>
                                    <!-- Note: Selection of address components in this example is typical.
                                         You may need to adjust it for the locations relevant to your app. See
                                         https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
                                    -->
                                    <td class="wideField" colspan="3"><input class="field" id="locality"
                                                                             disabled="true"/></td>
                                </tr>
                                <tr>
                                    <td class="label">State</td>
                                    <td class="slimField"><input class="field"
                                                                 id="administrative_area_level_1" disabled="true"/></td>
                                    <td class="label">Zip code</td>
                                    <td class="wideField"></td>
                                </tr>
                                <tr>
                                    <td class="label">Country</td>
                                    <td class="wideField" colspan="3"><input class="field"
                                                                             id="country" disabled="true"/></td>
                                </tr>
                            </table>

                            <script>
                                // This example displays an address form, using the autocomplete feature
                                // of the Google Places API to help users fill in the information.

                                // This example requires the Places library. Include the libraries=places
                                // parameter when you first load the API. For example:
                                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                                var placeSearch, autocomplete;
                                var componentForm = {
                                    street_number: 'short_name',
                                    route: 'long_name',
                                    locality: 'long_name',
                                    administrative_area_level_1: 'short_name',
                                    country: 'long_name',
                                    postal_code: 'short_name'
                                };

                                function initAutocomplete() {
                                    // Create the autocomplete object, restricting the search to geographical
                                    // location types.
                                    autocomplete = new google.maps.places.Autocomplete(
                                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                                        {types: ['geocode']});

                                    // When the user selects an address from the dropdown, populate the address
                                    // fields in the form.
                                    autocomplete.addListener('place_changed', fillInAddress);
                                }

                                function fillInAddress() {
                                    // Get the place details from the autocomplete object.
                                    var place = autocomplete.getPlace();

                                    for (var component in componentForm) {
                                        document.getElementById(component).value = '';
                                        document.getElementById(component).disabled = false;
                                    }

                                    // Get each component of the address from the place details
                                    // and fill the corresponding field on the form.
                                    for (var i = 0; i < place.address_components.length; i++) {
                                        var addressType = place.address_components[i].types[0];
                                        if (componentForm[addressType]) {
                                            var val = place.address_components[i][componentForm[addressType]];
                                            document.getElementById(addressType).value = val;
                                        }
                                    }
                                }

                                // Bias the autocomplete object to the user's geographical location,
                                // as supplied by the browser's 'navigator.geolocation' object.
                                function geolocate() {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function(position) {
                                            var geolocation = {
                                                lat: position.coords.latitude,
                                                lng: position.coords.longitude
                                            };
                                            var circle = new google.maps.Circle({
                                                center: geolocation,
                                                radius: position.coords.accuracy
                                            });
                                            autocomplete.setBounds(circle.getBounds());
                                        });
                                    }
                                }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAetIFaNY_rTcm-ycmSLWLtDfYgY7coE_4&libraries=places&callback=initAutocomplete"
                                    async defer></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="container">--}}
        {{--<div class="row justify-content-md-center mt-5">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">--}}
                        {{--<h3>New Property for {{Auth::user()->name}}</h3>--}}
                    {{--</div>--}}

                    {{--<br>--}}

                    {{--<form class="form-horizontal" method="POST" action="{{ route('updateProperty') }}">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Property Name</label>--}}
                                {{--<div class="container">--}}
                                    {{--<input id="name" type="text" class="form-control" name="name"--}}
                                           {{--value="{{ old('name') }}" required autofocus>--}}

                                    {{--@if ($errors->has('name'))--}}
                                        {{--<span class="help-block">--}}
                                            {{--<strong>{{ $errors->first('name') }}</strong>--}}

                                            {{--{{ route('updateProperty') }}--}}

                                        {{--</span>--}}

                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">--}}
                                {{--<label for="address" class="col-md-4 control-label">Property Address</label>--}}

                                {{--<div class="container">--}}
                                    {{--<input id="address" type="text" class="form-control" name="address"--}}
                                           {{--value="{{ old('address') }}" required>--}}

                                    {{--@if ($errors->has('address'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('address') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">--}}
                                {{--<label for="owner" class="col-md-4 control-label">Owner</label>--}}

                                {{--<div class="container">--}}
                                    {{--<input id="owner" type="text" class="form-control" name="owner" required>--}}

                                    {{--@if ($errors->has('owner'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('owner') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="container">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--Submit Property--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                    {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
@endsection
