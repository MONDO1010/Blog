@extends('shop')

@section('content')

<main role="main">
    <div class="container mt-4">

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('voir_produit_par_cat', $produit->category->id) }}">{{ $produit->category->nom }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $produit->marque }} {{ $produit->type }}</li>
            </ol>
        </nav>

        <!-- Product Details -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <img class="card-img-top"
                         src="{{ asset('storage/produits/'.$produit->photo_principale) }}"
                         alt="{{ $produit->marque }} {{ $produit->type }}"
                         onerror="this.src='{{ asset('produits/'.$produit->photo_principale) }}'"
                         style="width: 100%; height: 450px; object-fit: cover; border-radius: 10px;">
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Product Header -->
                <div class="mb-3">
                    <span class="badge badge-info mb-2">{{ $produit->category->nom }}</span>
                    <h1 class="h2 font-weight-bold">{{ $produit->marque }}</h1>
                    <h4 class="text-muted">{{ $produit->type }}</h4>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <h2 class="product-price mb-0">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</h2>
                    @if($produit->stock > 0)
                        <small class="text-success"><i class="fas fa-check-circle"></i> En stock ({{ $produit->stock }} disponibles)</small>
                    @else
                        <small class="text-danger"><i class="fas fa-times-circle"></i> Rupture de stock</small>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="font-weight-bold">Description</h5>
                    <p class="text-muted">{{ $produit->description }}</p>
                </div>

                <hr>

                <!-- Specifications -->
                <div class="mb-4">
                    <h5 class="font-weight-bold mb-3">Caractéristiques</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td class="font-weight-bold" style="width: 150px;">Marque:</td>
                            <td>{{ $produit->marque }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Type:</td>
                            <td>{{ $produit->type }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Couleur:</td>
                            <td>{{ $produit->couleur }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Catégorie:</td>
                            <td><a href="{{ route('voir_produit_par_cat', $produit->category->id) }}">{{ $produit->category->nom }}</a></td>
                        </tr>
                    </table>
                </div>

                <!-- Tags -->
                @if($produit->tags->count() > 0)
                <div class="mb-4">
                    <h6 class="font-weight-bold mb-2">Tags:</h6>
                    @foreach($produit->tags as $tag)
                        <a href="{{ route('voir_produit_par_tag', ['id' => $tag->id]) }}" class="badge badge-secondary mr-1 mb-1" style="font-size: 14px;">
                            {{ $tag->nom }}
                        </a>
                    @endforeach
                </div>
                @endif

                <hr>

                <!-- Action Buttons -->
                <div class="mt-4">
                    <form action="{{ route('cart.add', $produit->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="quantity" class="font-weight-bold">Quantité:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $produit->stock }}" {{ $produit->stock == 0 ? 'disabled' : '' }}>
                        </div>
                        <button type="submit" class="btn btn-cart btn-lg btn-block py-3" {{ $produit->stock == 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart"></i> Ajouter au Panier
                        </button>
                    </form>
                    <small class="text-muted d-block mt-2 text-center">
                        <i class="fas fa-truck"></i> Livraison disponible | <i class="fas fa-shield-alt"></i> Paiement sécurisé
                    </small>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection
