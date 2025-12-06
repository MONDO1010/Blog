<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('img/favicon.png')}}">

    <title>Ets Modeste</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/album.css')}}" rel="stylesheet">
    <link href="{{asset('css/tshirt.css')}}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

</head>

<body>

@include('layouts.header')

    <main role="main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Trouvez Votre Moto Idéale</h1>
                    <p class="hero-subtitle">Découvrez notre sélection exceptionnelle de motos neuves et d'occasion. Qualité garantie, prix compétitifs.</p>
                    <a href="#produits" class="btn btn-hero">
                        <i class="fas fa-motorcycle"></i> Voir nos Motos
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-motorcycle" style="font-size: 200px; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Nos Catégories</h2>
            <div class="row">
                @foreach($categories ?? [] as $category)
                <div class="col-md-4">
                    <a href="{{ route('voir_produit_par_cat', $category->id) }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="card-body text-center py-5" style="background: linear-gradient(135deg, #075e7f 0%, #0a7ba0 100%);">
                                <i class="fas fa-motorcycle" style="font-size: 60px; color: #ffc107;"></i>
                                <h3 class="mt-3 text-white">{{ $category->nom }}</h3>
                                <p class="text-white-50">Découvrez notre gamme</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5" id="produits">
        <div class="container">
            <h2 class="section-title">Produits en Vedette</h2>

@yield('content')

        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Pourquoi Nous Choisir ?</h2>
            <div class="row mt-5">
                <div class="col-md-4 text-center mb-4">
                    <div class="p-4">
                        <i class="fas fa-shield-alt" style="font-size: 60px; color: #075e7f;"></i>
                        <h4 class="mt-3">Qualité Garantie</h4>
                        <p class="text-muted">Toutes nos motos sont vérifiées et certifiées pour votre sécurité.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="p-4">
                        <i class="fas fa-tags" style="font-size: 60px; color: #fd6060;"></i>
                        <h4 class="mt-3">Prix Compétitifs</h4>
                        <p class="text-muted">Les meilleurs prix du marché avec des facilités de paiement.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="p-4">
                        <i class="fas fa-headset" style="font-size: 60px; color: #ffc107;"></i>
                        <h4 class="mt-3">Service Client</h4>
                        <p class="text-muted">Une équipe dédiée pour vous accompagner dans votre choix.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Ets Modeste</p>
    </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/holder.min.js')}}"></script>
  </body>
</html>