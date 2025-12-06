@extends('errors.layout')

@section('title', 'Trop de requêtes')

@section('content')
    <div class="error-icon warning">
        <i class="fas fa-tachometer-alt"></i>
    </div>

    <div class="error-code">429</div>
    <h1 class="error-title">Trop de requêtes</h1>
    <p class="error-message">
        Vous avez effectué trop de requêtes en peu de temps.<br>
        Veuillez patienter quelques instants avant de réessayer.
    </p>

    <div class="error-actions">
        <a href="javascript:window.location.reload();" class="btn btn-primary">
            <i class="fas fa-redo"></i> Réessayer
        </a>
        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
    </div>

    <div class="error-details">
        <p>
            <i class="fas fa-shield-alt"></i>
            Cette limite protège notre site contre les abus.
        </p>
    </div>
@endsection
