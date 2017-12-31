<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--this is the css compiled from Bootstrap. It's different from the CDN Bootstrap but will be included for dev purposes (CDN doesn't work with out internet) Probably should remove before deployment--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html {
            position: relative;
            min-height: 100%;
            overflow-y: scroll; /*this puts a scrollbar on each page even if there is no scroll to prevent shifting elements*/

        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
            padding-bottom: 60px;
            /*adding padding to bottom seems to solve problem with overlapped content*/
        }
    </style>

</head>
<body>
    <div id="app">
        @include('layouts.nav')

        @yield('content')
    </div>
</body>

<div>
    @include('layouts.footer')


    <!-- CSS CDN -->
        {{--this is the css loaded from Bootstrap.--}}


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Scripts -->



        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <script src="{{ asset('js/app.js') }}"></script>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
</div>

</html>
