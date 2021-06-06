@auth
    <li class="nav-item">
        <a class="nav-link">
            {{Auth::user()->name}}
        </a>
    </li>
    @if (Route::has('logout'))
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-request').submit();">
                {{__('Logout')}}
            </a>
            <form id="logout-request" action="{{route('logout')}}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endif
@else
    @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">
                {{__('Login')}}
            </a>
        </li>
    @endif

    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">
                {{__('Register')}}
            </a>
        </li>
    @endif
@endauth
