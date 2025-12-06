@extends('errors.layout')

@section('title', 'Maintenance')

@section('content')
    <div class="error-icon info">
        <i class="fas fa-tools"></i>
    </div>

    <div class="error-code">503</div>
    <h1 class="error-title">Site en maintenance</h1>
    <p class="error-message">
        Nous effectuons actuellement des travaux de maintenance.<br>
        Nous serons de retour très bientôt. Merci de votre patience !
    </p>

    <div class="error-actions">
        <a href="javascript:window.location.reload();" class="btn btn-primary">
            <i class="fas fa-redo"></i> Actualiser
        </a>
    </div>

    <div class="error-details">
        <p>
            <i class="fas fa-clock"></i>
            Durée estimée : quelques minutes
        </p>
    </div>
@endsection
