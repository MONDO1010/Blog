<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mon Panier - Ets Modeste</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/tshirt.css')}}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"></script>
</head>
<body>
    @include('layouts.header')

    <div class="container mt-5 mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mon Panier</li>
            </ol>
        </nav>

        <h1 class="mb-4"><i class="fas fa-shopping-cart"></i> Mon Panier</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4>Votre panier est vide</h4>
                    <p class="text-muted">Ajoutez des produits pour commencer vos achats</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left"></i> Continuer mes achats
                    </a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-list"></i> Articles ({{ $cartItems->count() }})</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Produit</th>
                                            <th>Prix</th>
                                            <th>Quantité</th>
                                            <th>Sous-total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $item->produit->photo_principale) }}"
                                                         alt="{{ $item->produit->marque }}"
                                                         class="img-thumbnail mr-3"
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0">
                                                            <a href="{{ route('voir_produit', $item->produit->id) }}">
                                                                {{ $item->produit->marque }}
                                                            </a>
                                                        </h6>
                                                        <small class="text-muted">{{ $item->produit->type }}</small><br>
                                                        <small class="text-muted">Couleur: {{ $item->produit->couleur }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <strong>{{ number_format($item->produit->prix, 0, ',', ' ') }} FCFA</strong>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group" style="width: 120px;">
                                                        <input type="number" name="quantity" class="form-control form-control-sm"
                                                               value="{{ $item->quantity }}" min="1" max="99">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="align-middle">
                                                <strong class="text-primary">
                                                    {{ number_format($item->quantity * $item->produit->prix, 0, ',', ' ') }} FCFA
                                                </strong>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir retirer cet article ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Continuer mes achats
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                                <i class="fas fa-trash"></i> Vider le panier
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-calculator"></i> Récapitulatif</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total:</span>
                                <strong>{{ number_format($total, 0, ',', ' ') }} FCFA</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Livraison:</span>
                                <span class="text-success">Gratuite</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <h5>Total:</h5>
                                <h5 class="text-success">{{ number_format($total, 0, ',', ' ') }} FCFA</h5>
                            </div>

                            @auth
                                <button class="btn btn-success btn-block btn-lg mb-3">
                                    <i class="fas fa-credit-card"></i> Passer la commande
                                </button>
                            @else
                                <div class="alert alert-info">
                                    <small>
                                        <i class="fas fa-info-circle"></i>
                                        Connectez-vous pour passer commande
                                    </small>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary btn-block mb-2">
                                    <i class="fas fa-sign-in-alt"></i> Se connecter
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-user-plus"></i> S'inscrire
                                </a>
                            @endauth

                            <hr>
                            <div class="text-center text-muted">
                                <small>
                                    <i class="fas fa-shield-alt"></i> Paiement sécurisé<br>
                                    <i class="fas fa-truck"></i> Livraison rapide<br>
                                    <i class="fas fa-undo"></i> Retours gratuits
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
