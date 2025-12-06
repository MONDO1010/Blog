@extends('admin.layouts.app')

@section('page-title', 'Détails du Produit')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-eye"></i> Produit #{{ $product->id }}</h5>
                <div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/produits/' . $product->photo_principale) }}"
                             alt="{{ $product->marque }}"
                             class="img-fluid rounded shadow">
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $product->marque }}</h3>
                        <h5 class="text-muted">{{ $product->type }}</h5>

                        <hr>

                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 150px;">Catégorie:</th>
                                <td><span class="badge badge-info">{{ $product->category->nom }}</span></td>
                            </tr>
                            <tr>
                                <th>Couleur:</th>
                                <td>{{ $product->couleur }}</td>
                            </tr>
                            <tr>
                                <th>Prix:</th>
                                <td><strong class="text-success" style="font-size: 24px;">{{ number_format($product->prix, 0, ',', ' ') }} FCFA</strong></td>
                            </tr>
                            <tr>
                                <th>Stock:</th>
                                <td>
                                    @if($product->stock > 10)
                                        <span class="badge badge-success" style="font-size: 16px;">{{ $product->stock }} unités</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge badge-warning" style="font-size: 16px;">{{ $product->stock }} unités</span>
                                    @else
                                        <span class="badge badge-danger" style="font-size: 16px;">Rupture de stock</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tags:</th>
                                <td>
                                    @forelse($product->tags as $tag)
                                        <span class="badge badge-secondary">{{ $tag->nom }}</span>
                                    @empty
                                        <span class="text-muted">Aucun tag</span>
                                    @endforelse
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <h6>Description:</h6>
                        <p>{{ $product->description }}</p>

                        <hr>

                        <small class="text-muted">
                            <strong>Créé le:</strong> {{ $product->created_at->format('d/m/Y à H:i') }}<br>
                            <strong>Modifié le:</strong> {{ $product->updated_at->format('d/m/Y à H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
