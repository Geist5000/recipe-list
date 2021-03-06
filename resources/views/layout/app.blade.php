<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    @stack('scripts')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rezept Liste - @yield('title')</title>
    @stack('head')
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{asset('pictures/logo/Rezepte-Logo.png')}}" width="60" height="60" alt="Logo">
        Rezept Liste
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li>
                <a class="nav-item nav-link @if(url()->current() == route('recipes.index')) active @endif"
                   href="{{route('recipes.index')}}">Alle Rezepte</a></li>
            <li>
                <a class="nav-item nav-link @if(url()->current() == route('recipes.create')) active @endif"
                   href="{{route('recipes.create')}}">Neues Rezept</a></li>
            <li>
                <a class="nav-item nav-link @if(url()->current() == route('tags.index')) active @endif"
                   href="{{route('tags.index')}}">Tags</a></li>
        </ul>

    </div>


</nav>

<main>
    @hasSection('main')
        @yield('main')
    @endif
</main>
</body>
</html>
