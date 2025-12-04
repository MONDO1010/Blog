@extends('shop')

@section('content')
<!--<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Films</li>
            <li class="breadcrumb-item"><a href="#">Les goonies</a></li>
            <li class="breadcrumb-item"><a href="#">Star Wars</a></li>
            <li class="breadcrumb-item"><a href="#">Star Trek</a></li>
            <li class="breadcrumb-item"><a href="#">Superman</a></li>
        </ol>
</nav>-->
<main role="main">


<div class="py-3">
    <div class="container-fluid">
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img src="{{asset('produits/'.$produit->photo_principale )}}" 
                        class="card-img-top img-fluid" alt="{{$produit->nom}}" style="width: 330px; height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">{{$produit->nom}}<br>{{$produit->marque}}<br>{{$produit->type}}<br>{{$produit->description}} <br>
                            <span class="badge badge-info"><a class="text-white" href="{{route('voir_produit_par_cat',['id'=>$produit->category->id])}}">{{ $produit->category->nom}}</a></span></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">{{$produit->prix}}F</span>
                                <a href="{{route('voir_produit',['id'=>$produit->id])}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

</main>


@endsection
