@extends('layouts.master')

@section('title', 'Accueil - Ets Modeste')

@section('content')
    <!-- Hero Section Neumorphic -->
    <section class="neu-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 neu-hero-content">
                    <h1 class="mb-4">Trouvez Votre Moto Idéale</h1>
                    <p>Découvrez notre sélection exceptionnelle de motos neuves et d'occasion. Qualité garantie, prix compétitifs et service client incomparable.</p>
                    <div class="mt-4">
                        <a href="#produits" class="neu-btn-primary neu-btn mr-3">
                            <i class="fas fa-motorcycle"></i> Voir nos Motos
                        </a>
                        <a href="{{ route('cart.index') }}" class="neu-btn">
                            <i class="fas fa-shopping-cart"></i> Mon Panier
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <i class="fas fa-motorcycle float-animation" style="font-size: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section Neumorphic -->
    <section class="py-5">
        <div class="container">
            <h2 class="neu-section-title">Nos Catégories</h2>
            <div class="row">
                @foreach($categories ?? [] as $category)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('voir_produit_par_cat', $category->id) }}" class="text-decoration-none">
                        <div class="neu-category-card">
                            <div class="neu-category-icon">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <h3 class="neu-category-title">{{ $category->nom }}</h3>
                            <p class="neu-category-count">Découvrez notre gamme</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section Neumorphic -->
    <section class="py-5" id="produits">
        <div class="container">
            <h2 class="neu-section-title">Produits en Vedette</h2>

            <div class="row">
                @foreach($produits ?? [] as $produit)
                <div class="col-md-3 mb-4">
                    <div class="neu-product-card position-relative">
                        <div style="position: relative; overflow: hidden;">
                            <span class="neu-product-badge">{{ $produit->category->nom ?? 'Catégorie' }}</span>
                            <a href="{{ route('voir_produit', $produit->id) }}">
                                <img src="{{ asset('storage/produits/' . $produit->photo_principale) }}"
                                     alt="{{ $produit->marque }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="neu-product-title">{{ $produit->marque }}</h5>
                            <p class="text-muted mb-2" style="font-size: 14px;">{{ $produit->type }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="neu-product-price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-palette"></i> {{ $produit->couleur }}
                                </small>
                                @if($produit->stock > 0)
                                    <small class="text-success">
                                        <i class="fas fa-check-circle"></i> En stock
                                    </small>
                                @else
                                    <small class="text-danger">
                                        <i class="fas fa-times-circle"></i> Épuisé
                                    </small>
                                @endif
                            </div>
                            <a href="{{ route('voir_produit', $produit->id) }}" class="neu-btn-primary neu-btn btn-block mt-3">
                                <i class="fas fa-eye"></i> Voir Détails
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Why Choose Us Neumorphic -->
    <section class="py-5">
        <div class="container">
            <h2 class="neu-section-title">Pourquoi Nous Choisir ?</h2>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="neu-card text-center">
                        <div class="neu-category-icon mx-auto mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Qualité Garantie</h4>
                        <p class="text-muted">Toutes nos motos sont vérifiées et certifiées pour votre sécurité. Garantie constructeur disponible.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="neu-card text-center">
                        <div class="neu-category-icon mx-auto mb-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Prix Compétitifs</h4>
                        <p class="text-muted">Les meilleurs prix du marché avec des facilités de paiement adaptées à vos besoins.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="neu-card text-center">
                        <div class="neu-category-icon mx-auto mb-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="font-weight-bold mb-3">Service Client</h4>
                        <p class="text-muted">Une équipe dédiée disponible 7j/7 pour vous accompagner dans votre choix et après l'achat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="neu-card text-center py-5">
                <h2 class="text-gradient mb-4">Prêt à Trouver Votre Moto ?</h2>
                <p class="text-muted mb-4" style="font-size: 18px;">Contactez-nous dès aujourd'hui pour découvrir nos offres exclusives</p>
                <a href="#produits" class="neu-btn-accent neu-btn btn-lg">
                    <i class="fas fa-phone"></i> Nous Contacter
                </a>
            </div>
        </div>
    </section>
@endsection
