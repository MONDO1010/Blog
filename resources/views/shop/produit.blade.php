@extends('layouts.master')

@section('title', $produit->marque . ' ' . $produit->type . ' - Ets Modeste')

@section('content')
<div class="container mt-4">
    <!-- Breadcrumbs Neumorphic -->
    <div class="neu-breadcrumb mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('voir_produit_par_cat', $produit->category->id) }}">{{ $produit->category->nom }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $produit->marque }} {{ $produit->type }}</li>
            </ol>
        </nav>
    </div>

    <!-- Product Details -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="neu-card p-3">
                <img class="w-100"
                     src="{{ asset('storage/produits/'.$produit->photo_principale) }}"
                     alt="{{ $produit->marque }} {{ $produit->type }}"
                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';"
                     style="height: 400px; object-fit: cover; border-radius: 15px;">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="neu-card">
                <!-- Product Header -->
                <div class="mb-3">
                    <span class="neu-product-badge d-inline-block mb-2" style="position: static;">{{ $produit->category->nom }}</span>
                    <h1 class="h2 font-weight-bold text-gradient">{{ $produit->marque }}</h1>
                    <h4 class="text-muted">{{ $produit->type }}</h4>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <h2 class="neu-product-price mb-2" style="font-size: 32px;">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</h2>
                    @if($produit->stock > 0)
                        <span class="text-success"><i class="fas fa-check-circle"></i> En stock ({{ $produit->stock }} disponibles)</span>
                    @else
                        <span class="text-danger"><i class="fas fa-times-circle"></i> Rupture de stock</span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="font-weight-bold text-gradient">Description</h5>
                    <p class="text-muted">{{ $produit->description }}</p>
                </div>

                <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                <!-- Specifications -->
                <div class="mb-4">
                    <h5 class="font-weight-bold text-gradient mb-3">Caractéristiques</h5>
                    <div class="neu-card-sm">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="font-weight-bold text-muted" style="width: 130px;"><i class="fas fa-motorcycle mr-2"></i>Marque</td>
                                <td>{{ $produit->marque }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted"><i class="fas fa-tag mr-2"></i>Type</td>
                                <td>{{ $produit->type }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted"><i class="fas fa-palette mr-2"></i>Couleur</td>
                                <td>{{ $produit->couleur }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-muted"><i class="fas fa-folder mr-2"></i>Catégorie</td>
                                <td><a href="{{ route('voir_produit_par_cat', $produit->category->id) }}" class="text-gradient">{{ $produit->category->nom }}</a></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Tags -->
                @if($produit->tags->count() > 0)
                <div class="mb-4">
                    <h6 class="font-weight-bold text-gradient mb-2">Tags</h6>
                    @foreach($produit->tags as $tag)
                        <a href="{{ route('voir_produit_par_tag', ['id' => $tag->id]) }}"
                           class="badge mr-1 mb-1"
                           style="background: var(--primary-gradient); color: white; font-size: 12px; padding: 8px 12px; border-radius: 10px;">
                            {{ $tag->nom }}
                        </a>
                    @endforeach
                </div>
                @endif

                <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                <!-- Action Buttons -->
                <div class="mt-4">
                    <form action="{{ route('cart.add', $produit->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="quantity" class="font-weight-bold">Quantité:</label>
                            <input type="number" name="quantity" id="quantity"
                                   class="neu-input w-100"
                                   value="1" min="1" max="{{ $produit->stock }}"
                                   {{ $produit->stock == 0 ? 'disabled' : '' }}>
                        </div>
                        <button type="submit" class="neu-btn-primary neu-btn btn-block py-3" {{ $produit->stock == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart"></i> Ajouter au Panier
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-truck text-gradient"></i> Livraison disponible |
                            <i class="fas fa-shield-alt text-gradient"></i> Paiement sécurisé
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products (optional section) -->
    @if(isset($produitsLies) && $produitsLies->count() > 0)
    <section class="py-5">
        <h2 class="neu-section-title">Produits Similaires</h2>
        <div class="row">
            @foreach($produitsLies as $related)
            <div class="col-md-3 mb-4">
                <div class="neu-product-card position-relative">
                    <div style="position: relative; overflow: hidden;">
                        <span class="neu-product-badge">{{ $related->category->nom }}</span>
                        <a href="{{ route('voir_produit', $related->id) }}">
                            <img src="{{ asset('storage/produits/'.$related->photo_principale) }}"
                                 alt="{{ $related->marque }}"
                                 onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="neu-product-title">{{ $related->marque }}</h5>
                        <span class="neu-product-price">{{ number_format($related->prix, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
