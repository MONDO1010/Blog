@extends('layouts.master')

@section('title', 'Mon Panier - Ets Modeste')

@section('content')
<div class="container mt-4 mb-5">
    <!-- Breadcrumb Neumorphic -->
    <div class="neu-breadcrumb mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mon Panier</li>
            </ol>
        </nav>
    </div>

    <h1 class="neu-section-title"><i class="fas fa-shopping-cart"></i> Mon Panier</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="neu-card text-center py-5">
            <i class="fas fa-shopping-cart text-muted mb-3" style="font-size: 80px; opacity: 0.3;"></i>
            <h4 class="mt-4">Votre panier est vide</h4>
            <p class="text-muted">Ajoutez des produits pour commencer vos achats</p>
            <a href="{{ route('home') }}" class="neu-btn-primary neu-btn mt-3">
                <i class="fas fa-arrow-left"></i> Continuer mes achats
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="neu-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-gradient mb-0"><i class="fas fa-list"></i> Articles ({{ $cartItems->count() }})</h5>
                    </div>

                    @foreach($cartItems as $item)
                    <div class="neu-card-sm mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ asset('storage/produits/' . $item->produit->photo_principale) }}"
                                     alt="{{ $item->produit->marque }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">
                                    <a href="{{ route('voir_produit', $item->produit->id) }}" class="text-gradient">
                                        {{ $item->produit->marque }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $item->produit->type }}</small><br>
                                <small class="text-muted"><i class="fas fa-palette"></i> {{ $item->produit->couleur }}</small>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="neu-product-price" style="font-size: 16px;">{{ number_format($item->produit->prix, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="quantity" class="neu-input text-center"
                                               value="{{ $item->quantity }}" min="1" max="99"
                                               style="width: 60px; padding: 8px;">
                                        <button type="submit" class="neu-btn-primary ml-2" style="padding: 8px 12px; border-radius: 10px;">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="mb-2">
                                    <strong class="text-gradient">{{ number_format($item->quantity * $item->produit->prix, 0, ',', ' ') }} FCFA</strong>
                                </div>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            style="border-radius: 10px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir retirer cet article ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('home') }}" class="neu-btn">
                            <i class="fas fa-arrow-left"></i> Continuer mes achats
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                    style="border-radius: 15px;"
                                    onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                                <i class="fas fa-trash"></i> Vider le panier
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="neu-card sticky-top" style="top: 100px;">
                    <h5 class="text-gradient mb-4"><i class="fas fa-calculator"></i> Récapitulatif</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Sous-total:</span>
                        <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Livraison:</span>
                        <span class="text-success">Gratuite</span>
                    </div>

                    <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="mb-0">Total:</h5>
                        <h5 class="neu-product-price mb-0">{{ number_format($total, 0, ',', ' ') }} FCFA</h5>
                    </div>

                    @auth
                        <button class="neu-btn-accent neu-btn btn-block py-3 mb-3">
                            <i class="fas fa-credit-card"></i> Passer la commande
                        </button>
                    @else
                        <div class="neu-card-sm mb-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle text-gradient"></i>
                                Connectez-vous pour passer commande
                            </small>
                        </div>
                        <a href="{{ route('login') }}" class="neu-btn-primary neu-btn btn-block mb-2">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="neu-btn btn-block">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </a>
                    @endauth

                    <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                    <div class="text-center text-muted">
                        <small>
                            <i class="fas fa-shield-alt text-gradient"></i> Paiement sécurisé<br>
                            <i class="fas fa-truck text-gradient"></i> Livraison rapide<br>
                            <i class="fas fa-undo text-gradient"></i> Retours gratuits
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
