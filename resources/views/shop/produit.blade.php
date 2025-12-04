@extends('shop')

@section('content')

<main role="main">
    <div class="container">

        <div class="row justify-content-between">
            <div class="col-6">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         src="{{ asset('produits/'.$produit->photo_principale) }}"
                         alt="Photo du produit"
                         style="width: 330px; height: 310px; object-fit: cover;">
                </div>
            </div>

            <div class="col-6">
                <h1 class="jumbotron-heading">
                    {{ $produit->marque }} <br> {{ $produit->type }}
                </h1>

                <h5>{{ number_format($produit->prix, 0, ',', ' ') }} F</h5>

                <p class="lead text-muted">
                    {{ $produit->description }}
                </p>

                <hr>

                @foreach($produit->tags as $tag)
                    <span class="badge badge-info">
                        <a class="text-white"
                           href="{{ route('voir_produit_par_tag', ['id' => $tag->id]) }}">
                            {{ $tag->nom }}
                        </a>
                    </span>
                @endforeach

                <label>Choisissez votre couleur</label>
                <select class="form-control">
                    <option>noir</option>
                    <option>blanc</option>
                    <option>bleue</option>
                    <option>rouge</option>
                    <option>cafe</option>
                    <option>cendre</option>
                    <option>vert</option>
                </select>

                <p>
                    <a href="#" class="btn btn-cart my-2 btn-block">
                        <i class="fas fa-shopping-cart"></i> Ajouter au Panier
                    </a>
                </p>
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <h3>Vous aimerez aussi :</h3>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{ asset('produits/motohomme.jpeg') }}"
                                 class="card-img-top img-fluid"
                                 style="width: 350px; height: 300px; object-fit: cover;">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{ asset('produits/tricylcle.jpeg') }}"
                                 class="card-img-top img-fluid"
                                 style="width: 350px; height: 300px; object-fit: cover;">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{ asset('produits/motohomme.jpeg') }}"
                                 class="card-img-top img-fluid"
                                 style="width: 350px; height: 300px; object-fit: cover;">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</main>

@endsection
