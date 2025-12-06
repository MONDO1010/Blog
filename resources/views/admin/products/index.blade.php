@extends('admin.layouts.app')

@section('page-title', 'Gestion des Produits')
@section('page-description', 'Gérez votre catalogue de produits')

@section('content')
<!-- Header Actions -->
<div class="row mb-4">
    <div class="col-md-6">
        <form action="{{ route('admin.products.index') }}" method="GET">
            <div class="d-flex" style="gap: 8px;">
                <input type="text" name="search" class="flat-input" placeholder="Rechercher un produit..." value="{{ request('search') }}" style="max-width: 300px;">
                <button type="submit" class="flat-btn flat-btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('admin.products.create') }}" class="flat-btn flat-btn-success">
            <i class="fas fa-plus"></i> Nouveau Produit
        </a>
    </div>
</div>

<!-- Products Table -->
<div class="flat-card">
    <div class="flat-card-header">
        <h5 class="flat-card-title">Liste des produits</h5>
        <span class="flat-badge flat-badge-info">{{ $produits->total() }} produits</span>
    </div>
    <div class="flat-card-body p-0">
        <div class="table-responsive">
            <table class="flat-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 70px;">Photo</th>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Tags</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                        <tr>
                            <td class="text-muted">{{ $produit->id }}</td>
                            <td>
                                <img src="{{ asset('storage/produits/' . $produit->photo_principale) }}"
                                     alt="{{ $produit->marque }}"
                                     class="product-thumb"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            </td>
                            <td>
                                <strong>{{ $produit->marque }}</strong>
                                <br>
                                <small class="text-muted">{{ $produit->type }}</small>
                            </td>
                            <td>
                                <span class="flat-badge flat-badge-info">{{ $produit->category->nom }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($produit->prix, 0, ',', ' ') }} F</strong>
                            </td>
                            <td>
                                @if($produit->stock > 10)
                                    <span class="flat-badge flat-badge-success">{{ $produit->stock }}</span>
                                @elseif($produit->stock > 0)
                                    <span class="flat-badge flat-badge-warning">{{ $produit->stock }}</span>
                                @else
                                    <span class="flat-badge flat-badge-danger">Rupture</span>
                                @endif
                            </td>
                            <td>
                                @foreach($produit->tags->take(2) as $tag)
                                    <span class="flat-badge flat-badge-info" style="font-size: 11px;">{{ $tag->nom }}</span>
                                @endforeach
                                @if($produit->tags->count() > 2)
                                    <span class="text-muted" style="font-size: 11px;">+{{ $produit->tags->count() - 2 }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.show', $produit) }}" class="flat-btn flat-btn-sm flat-btn-icon flat-btn-outline" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $produit) }}" class="flat-btn flat-btn-sm flat-btn-icon flat-btn-primary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $produit) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flat-btn flat-btn-sm flat-btn-icon flat-btn-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-motorcycle"></i>
                                    <h4>Aucun produit trouvé</h4>
                                    <p>Commencez par ajouter votre premier produit</p>
                                    <a href="{{ route('admin.products.create') }}" class="flat-btn flat-btn-primary">
                                        <i class="fas fa-plus"></i> Ajouter un produit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($produits->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $produits->links() }}
</div>
@endif
@endsection
