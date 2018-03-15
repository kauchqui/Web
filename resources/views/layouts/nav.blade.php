<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(Auth::user()->permissions == 1)
        <div class ="navbar-brand" id="navbarSupportedContent">
            <ul class ="nav navbar-nav">
                <li class = "dropdown">
                    <a href="#" class="dropdown-toggle text-white justify-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Forum Channels<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach(App\Channel::all() as $channel)
                                <li><a href = "/threads/{{ $channel->slug }}" class="text-dark"> {{ $channel->name }}</a></li>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <li><a href="/threads/create" class="text-dark">Create Thread</a></li>
                        </ul>

                </li>
            </ul>
        </div>
        @endif
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @else
                    <li class="nav-item dropdown text-white">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a href="{{ route('home') }}" class="dropdown-item">
                                Dashboard
                            </a>

                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
