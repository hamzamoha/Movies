<nav class="navbar navbar-expand-lg navbar-dark bg-dark-18">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mt-2 mt-lg-0 d-block" href="#">
                {{config('app.name')}}
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.index') }}">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.genres') }}">Categories</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}} @if(Auth::user()->user_type == 'admin'){{("(Administrator)")}}@endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('auth.favorites') }}"><i class="far fa-heart"></i> Favorites</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.watch_later') }}"><i class="far fa-clock"></i> Watch Later</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.settings') }}"><i class="fas fa-cog"></i> Settings</a></li>
                            @if(Auth::user()->user_type == 'admin')
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif
                        </ul>
                    </li>
                    <form action="{{ route('logout') }}" method="POST" class="nav-item">
                        @csrf
                        <input type="submit" class="nav-link border-0 bg-transparent" value="Logout">
                    </form>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
