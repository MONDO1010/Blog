@extends('layouts.master')

@section('title')
    @if(isset($produits) && $produits->count() > 0)
        {{ $produits->first()->category->nom }} - Ets Modeste
    @else
        Catégorie - Ets Modeste
    @endif
@endsection

@section('content')
<!-- Breadcrumbs Neumorphic -->
<div class="container mt-4">
    <div class="neu-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($produits) && $produits->count() > 0)
                        {{ $produits->first()->category->nom }}
                    @else
                        Catégorie
                    @endif
                </li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <!-- Category Title -->
        @if(isset($produits) && $produits->count() > 0)
            <h2 class="neu-section-title">{{ $produits->first()->category->nom }}</h2>
        @else
            <h2 class="neu-section-title">Catégorie</h2>
        @endif

        <div class="row">
            @forelse($produits as $produit)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="neu-product-card position-relative">
                        <!-- Category Badge -->
                        <div style="position: relative; overflow: hidden;">
                            <span class="neu-product-badge">{{ $produit->category->nom }}</span>
                            <a href="{{ route('voir_produit', $produit->id) }}">
                                <img src="{{ asset('storage/produits/'.$produit->photo_principale) }}"
                                     alt="{{ $produit->marque }} {{ $produit->type }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            </a>
                        </div>

                        <div class="card-body">
                            <!-- Product Title -->
                            <h5 class="neu-product-title">{{ $produit->marque }}</h5>
                            <p class="text-muted mb-2" style="font-size: 14px;">{{ $produit->type }}</p>

                            <!-- Tags -->
                            <div class="mb-3">
                                @foreach($produit->tags as $tag)
                                    <span class="badge" style="background: var(--primary-gradient); color: white; font-size: 10px;">{{ $tag->nom }}</span>
                                @endforeach
                            </div>

                            <!-- Price -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="neu-product-price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                            </div>

                            <!-- Stock Status -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-palette"></i> {{ $produit->couleur }}
                                </small>
                                @if($produit->stock > 0)
                                    <small class="text-success">
                                        <i class="fas fa-check-circle"></i> En stock ({{ $produit->stock }})
                                    </small>
                                @else
                                    <small class="text-danger">
                                        <i class="fas fa-times-circle"></i> Épuisé
                                    </small>
                                @endif
                            </div>

                            <a href="{{ route('voir_produit', $produit->id) }}" class="neu-btn-primary neu-btn btn-block">
                                <i class="fas fa-eye"></i> Voir Détails
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="neu-card text-center py-5">
                        <i class="fas fa-motorcycle text-muted" style="font-size: 60px; opacity: 0.3;"></i>
                        <h4 class="mt-4 text-muted">Aucun produit disponible</h4>
                        <p class="text-muted">Cette catégorie ne contient pas encore de produits.</p>
                        <a href="{{ route('home') }}" class="neu-btn-primary neu-btn mt-3">
                            <i class="fas fa-home"></i> Retour à l'accueil
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
