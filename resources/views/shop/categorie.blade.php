@extends('shop')

@section('content')
<main role="main">

<!-- Breadcrumbs -->
<div class="container mt-4">
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

<div class="py-4">
    <div class="container">
        <!-- Category Title -->
        @if(isset($produits) && $produits->count() > 0)
            <h2 class="section-title mb-4">{{ $produits->first()->category->nom }}</h2>
        @endif

        <div class="row">
            @forelse($produits as $produit)
                <div class="col-md-4 col-lg-3">
                    <div class="product-card card h-100 position-relative">
                        <!-- Category Badge -->
                        <span class="product-badge badge badge-info">{{ $produit->category->nom }}</span>

                        <!-- Product Image -->
                        <img class="card-img-top"
                             src="{{ asset('storage/produits/'.$produit->photo_principale) }}"
                             alt="{{ $produit->marque }} {{ $produit->type }}"
                             onerror="this.src='{{ asset('produits/'.$produit->photo_principale) }}'">

                        <div class="card-body">
                            <!-- Product Title -->
                            <h5 class="product-title">{{ $produit->marque }}</h5>
                            <p class="text-muted mb-2"><small>{{ $produit->type }}</small></p>

                            <!-- Product Description -->
                            <p class="product-description">{{ $produit->description }}</p>

                            <!-- Tags -->
                            <div class="mb-3">
                                @foreach($produit->tags as $tag)
                                    <span class="badge badge-secondary badge-sm">{{ $tag->nom }}</span>
                                @endforeach
                            </div>

                            <!-- Price and Action -->
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">{{ number_format($produit->prix, 0, ',', ' ') }} F</span>
                                <a href="{{ route('voir_produit',['id'=>$produit->id]) }}" class="btn btn-view-product btn-sm">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </div>

                            <!-- Stock Status -->
                            @if($produit->stock > 0)
                                <small class="text-success mt-2 d-block"><i class="fas fa-check-circle"></i> En stock ({{ $produit->stock }})</small>
                            @else
                                <small class="text-danger mt-2 d-block"><i class="fas fa-times-circle"></i> Rupture de stock</small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Aucun produit disponible dans cette catégorie.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

</main>

@endsection
