@extends('errors.layout')

@section('title', 'Page non trouvée')

@section('content')
    <div class="error-icon purple">
        <i class="fas fa-search"></i>
    </div>

    <div class="error-code">404</div>
    <h1 class="error-title">Page non trouvée</h1>
    <p class="error-message">
        Oups ! La page que vous recherchez n'existe pas ou a été déplacée.<br>
        Vérifiez l'URL ou retournez à l'accueil.
    </p>

    <div class="error-actions">
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">
            <i class="fas fa-shopping-bag"></i> Voir la boutique
        </a>
    </div>

    <div class="error-details">
        <p>
            <i class="fas fa-question-circle"></i>
            Besoin d'aide ? <a href="tel:+22890000000">Contactez-nous</a>
        </p>
    </div>
@endsection
