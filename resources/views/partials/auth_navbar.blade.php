<div class="dropdown nav-item">
    {{-- todo change photo--}}
    <div class="navbar-toggler-icon"></div>
    <div class="dropdown-menu">
        @auth
            <a class="dropdown-item" href="{{route('profile.show', Auth::user())}}">
                {{Auth::user()->name}}
            </a>
            <a class="dropdown-item" href="{{route('logout')}}"
               onclick="event.preventDefault();document.getElementById('logout-request').submit();">
                {{__('Logout-Button')}}
            </a>
            <form action="{{route('logout')}}" id="logout-request" method="POST">
                @csrf
            </form>
        @else
            @if (Route::has('login'))
                <a class="dropdown-item" href="{{route('login')}}">
                    {{__('Login-Button')}}
                </a>
            @endif

            @if (Route::has('register'))
                <a class="dropdown-item" href="{{route('register')}}">
                    {{__('Register-Button')}}
                </a>
            @endif
        @endauth
    </div>
</div>


