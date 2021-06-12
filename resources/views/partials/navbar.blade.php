<nav class="bg-dark sticky-top navbar navbar-dark shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            {{config('app.name', 'MagicShirts')}}
        </a>
        @include('partials.auth_navbar')
    </div>
</nav>
