<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active align-middle">
            <a class="nav-link align-nav" href="/">Home page</a>
        </li>
        @if(Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="/">
                <img class="img-thumbnail" src="/images/logo/{{$logo}}" alt="" style="width: 50px;">
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link align-nav" href="/company">Companies</a>
            </li>
        @endif
    </ul>
    <ul class="navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @else
            <li class="nav-item">
                <a href="/users/{{ Auth::user()->id }}" class="nav-link"><img class="profile-foto" src="{{ asset("images/photo/".Auth::user()->employeeProfile->photo) }}" alt=""></a>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle align-nav" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>