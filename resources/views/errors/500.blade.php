@extends('errors.layout')

@section('title', 'Erreur serveur')

@section('content')
    <div class="error-icon danger">
        <i class="fas fa-exclamation-triangle"></i>
    </div>

    <div class="error-code">500</div>
    <h1 class="error-title">Erreur serveur</h1>
    <p class="error-message">
        Une erreur inattendue s'est produite sur notre serveur.<br>
        Notre équipe technique a été notifiée. Veuillez réessayer plus tard.
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
            <i class="fas fa-headset"></i>
            Si le problème persiste, <a href="tel:+22890000000">contactez le support</a>
        </p>
    </div>
@endsection
