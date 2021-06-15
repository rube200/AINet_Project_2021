<nav class="bg-dark sticky-top navbar navbar-dark shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            {{config('app.name', 'MagicShirts')}}
        </a>
        <div class="dropdown nav-item">
            <div class="navbar-toggler-icon"></div>
            <div class="dropdown-menu">
                @auth
                    <a class="dropdown-item" href="{{route('profile.show', Auth::user())}}">
                        {{Auth::user()->name}}
                    </a>
                    @can('isAdmin', \App\Models\User::class)
                        <a class="dropdown-item" href="{{route('shopManage')}}">
                            {{__('Manage-Shop')}}
                        </a>
                    @endcan
                    @can('viewAny', \App\Models\User::class)
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
    </div>
</nav>
