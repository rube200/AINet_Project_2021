<nav class="bg-dark fixed-top navbar navbar-dark shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            {{config('app.name', 'MagicShirts')}}
        </a>
        @include('partials.auth')
    </div>
</nav>
