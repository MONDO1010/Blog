@extends('errors.layout')

@section('title', 'Session expirée')

@section('content')
    <div class="error-icon warning">
        <i class="fas fa-clock"></i>
    </div>

    <div class="error-code">419</div>
    <h1 class="error-title">Session expirée</h1>
    <p class="error-message">
        Votre session a expiré ou le token de sécurité n'est plus valide.<br>
        Cela arrive généralement après une longue période d'inactivité.
    </p>

    <div class="error-actions">
        <a href="{{ url()->previous() }}" class="btn btn-primary" onclick="event.preventDefault(); window.location.reload();">
            <i class="fas fa-redo"></i> Actualiser la page
        </a>
        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
    </div>

    <div class="error-details">
        <p>
            <i class="fas fa-info-circle"></i>
            Astuce : Actualisez la page et réessayez votre action.
        </p>
    </div>
@endsection
