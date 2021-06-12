<div class="dropdown nav-item">
    {{-- todo change photo--}}
    <div class="navbar-toggler-icon"></div>
    <div class="dropdown-menu">
        @auth
            <a class="dropdown-item" href="{{route('profile.show', Auth::user())}}">
                {{Auth::user()->name}}
            </a>
            @can('viewAny', Auth::user())
            <a class="dropdown-item" href="{{route('profile.index')}}">
                {{__('Manage-Users')}}
            </a>
            @endcan
            <a class="dropdown-item" href="{{route('logout')}}"
               onclick="event.preventDefault();document.getElementById('logout-request').submit();">
                {{__('Logout-Button')}}
            </a>
            <form action="{{route('logout')}}" id="logout-request" method="POST">
                @csrf
            </form>
        @else
            <a class="dropdown-item" href="{{route('login')}}">
                {{__('Login-Button')}}
            </a>
            <a class="dropdown-item" href="{{route('profile.create')}}">
                {{__('Register-Button')}}
            </a>
        @endauth
    </div>
</div>


