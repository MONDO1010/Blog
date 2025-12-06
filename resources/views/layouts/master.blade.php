<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Ets Modeste - Votre partenaire pour l'achat de motos de qualité">
    <meta name="author" content="Ets Modeste">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('img/favicon.png')}}">

    <title>@yield('title', 'Ets Modeste')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Neumorphism CSS -->
    <link href="{{asset('css/neumorphism.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @stack('styles')
</head>

<body>
    @include('layouts.header')

    <main role="main">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Particles Effect -->
    <script src="{{asset('js/particles.js')}}"></script>

    @stack('scripts')
</body>
</html>
