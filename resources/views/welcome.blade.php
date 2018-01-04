@extends('layouts.app')

{{--@section('content')--}}
    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<br>--}}
                {{--<div class="panel panel-success">--}}

                    {{--@if(Auth::guest())--}}
                            {{--<div class="panel-heading">Welcome to ManageIT! 🏡🏡🏡</div>--}}
                    {{--@endif--}}
                    {{--@if(Auth::check())--}}
                            {{--<div class="panel-heading">Welcome, {{Auth::user()->name}}!</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<br>--}}
                {{--<div>--}}
                {{--@if(Auth::guest())--}}
                    {{--<a href= "{{ URL::route('login')}}" class="btn btn-info"> Login>></a>--}}


                {{--@endif--}}
                {{--@if(Auth::check())--}}

                    {{--<a href= "{{ route('home') }}" class="btn btn-info"> Go to Dashboard 💼 >></a>--}}
                {{--@endif--}}

                    {{--<a href= "{{ url('about') }}" class="btn btn-info"> Learn more about us! 📖 >></a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

@section('content')

    <style>
        /* GLOBAL STYLES
    -------------------------------------------------- */
        /* Padding below the footer and lighter body text */

        body {
            color: #5a5a5a;
        }


        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }
        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
            background-color: #777;
        }
        .carousel-item > img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 32rem;
        }


        /* MARKETING CONTENT
        -------------------------------------------------- */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .marketing h2 {
            font-weight: 400;
        }
        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }


        /* Featurettes
        ------------------------- */

        .featurette-divider {
            margin: 5rem 0; /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            letter-spacing: -.05rem;
        }


        /* RESPONSIVE CSS
        -------------------------------------------------- */

        @media (min-width: 40em) {
            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }

    </style>

<body>




<main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src= "{{asset('img\old-house-hotel-exterior.jpg')}}" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <div class="card" style="width: 20rem;background-color:rgba(0,0,0,0.75);border-style: none ">
                            <div class="card-body" >
                                <h1>ManageIT</h1>
                                @auth()
                                    <p>Welcome, {{trim(strtok(Auth::user()->name, ' '))}}!</p>
                                    @endauth
                                @guest()
                                    <p>Start managing your life today!</p>
                                    @endguest

                            </div>
                        </div>
                        <br>
                        <p>
                                @auth()
                                <a class="btn btn-lg btn-primary" href="{{ URL::route('home')}}" role="button">Go to Dashboard</a>
                                <a class="btn btn-lg btn-primary" href="{{ URL::route('about')}}" role="button">About Us</a>

                                @endauth
                                @guest()
                                    <a class="btn btn-lg btn-primary" href="{{ URL::route('register')}}" role="button">Sign up today</a>
                                        <a class="btn btn-lg btn-primary" href="{{ URL::route('login')}}" role="button">Login</a>
                                        <a class="btn btn-lg btn-primary" href="{{ URL::route('about')}}" role="button">About Us</a>
                                @endguest

                        </p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="{{asset('img/house1.jpg')}}" alt="Second slide">
                <div class="card" style="background-color:rgba(0,0,0,0.75);border-style: none ">
                    <div class="card-body" style="color: white">
                        <p>At {{ config('app.name', 'Laravel') }}, we strive to bring meaningful insight to your property-based
                            business. Our software gives you a clear view of you properties' capital expenditures, and more
                            importantly, gives you meaningful feedback about how to plan the future. Whether you just want to
                            improve maintenance or build additions, you can know exactly how much it is going to cost, which
                            helps you avoid the hassle of unforeseen costs. Don't guess about your property -- {{ config('app.name','Laravel') }}
                            .&nbsp;</p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="{{asset('img/house1.jpg')}}" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>One more for good measure.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img class="rounded-circle" src="{{asset('img/house2.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle" src="{{asset('img/house3.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                <h2>Heading</h2>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img class="rounded-circle" src="{{asset('img/house4.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="{{asset('img/house1.jpg')}}" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" src="{{asset('img/house2.jpg')}}" alt="Generic placeholder image">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="{{asset('img/house3.jpg')}}" alt="Generic placeholder image">
            </div>
        </div>
        <!-- /END THE FEATURETTES -->
    </div><!-- /.container -->

</main>
<br>
@endsection

