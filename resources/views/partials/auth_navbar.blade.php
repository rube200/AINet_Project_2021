@auth
    <a class="nav-link">
        {{Auth::user()->name}}
    </a>
    @if (Route::has('logout'))
        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-request').submit();">
            {{__('Logout-Button')}}
        </a>
        <form id="logout-request" action="{{route('logout')}}" method="POST" class="d-none">
            @csrf
        </form>
    @endif
@else
    @if (Route::has('login'))
        <a class="nav-link" href="{{route('login')}}">
            {{__('Login-Button')}}
        </a>
    @endif

    @if (Route::has('register'))
        <a class="nav-link" href="{{route('register')}}">
            {{__('Register-Button')}}
        </a>
    @endif
@endauth
