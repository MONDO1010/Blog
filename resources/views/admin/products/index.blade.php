@extends('admin.layouts.app')

@section('page-title', 'Gestion des Produits')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('admin.products.index') }}" method="GET" class="form-inline">
            <div class="input-group" style="width: 100%;">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Rechercher
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouveau Produit
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Marque/Type</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Tags</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>
                                <img src="{{ asset('storage/produits/' . $produit->photo_principale) }}"
                                     alt="{{ $produit->marque }}"
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            </td>
                            <td>
                                <strong>{{ $produit->marque }}</strong><br>
                                <small class="text-muted">{{ $produit->type }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $produit->category->nom }}</span>
                            </td>
                            <td><strong>{{ number_format($produit->prix, 0, ',', ' ') }} F</strong></td>
                            <td>
                                @if($produit->stock > 10)
                                    <span class="badge badge-success">{{ $produit->stock }}</span>
                                @elseif($produit->stock > 0)
                                    <span class="badge badge-warning">{{ $produit->stock }}</span>
                                @else
                                    <span class="badge badge-danger">Rupture</span>
                                @endif
                            </td>
                            <td>
                                @foreach($produit->tags as $tag)
                                    <span class="badge badge-secondary">{{ $tag->nom }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.show', $produit) }}" class="btn btn-sm btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $produit) }}" class="btn btn-sm btn-primary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $produit) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Aucun produit trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $produits->links() }}
        </div>
    </div>
</div>
@endsection
