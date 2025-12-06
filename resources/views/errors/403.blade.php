@extends('errors.layout')

@section('title', 'Accès interdit')

@section('content')
    <div class="error-icon danger">
        <i class="fas fa-ban"></i>
    </div>

    <div class="error-code">403</div>
    <h1 class="error-title">Accès interdit</h1>
    <p class="error-message">
        Vous n'avez pas les permissions nécessaires pour accéder à cette page.<br>
        Si vous pensez qu'il s'agit d'une erreur, contactez l'administrateur.
    </p>

    <div class="error-actions">
        <a href="{{ url()->previous() }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
    </div>

    <div class="error-details">
        <p>
            @auth
                <i class="fas fa-user"></i> Connecté en tant que : {{ auth()->user()->name }}
            @else
                <i class="fas fa-sign-in-alt"></i> <a href="{{ route('login') }}">Se connecter</a> pour accéder à plus de fonctionnalités
            @endauth
        </p>
    </div>
@endsection
