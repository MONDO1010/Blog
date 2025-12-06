@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $stats['total_produits'] }}</h3>
                    <p>Total Produits</p>
                </div>
                <div class="icon text-primary">
                    <i class="fas fa-motorcycle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $stats['total_categories'] }}</h3>
                    <p>Catégories</p>
                </div>
                <div class="icon text-success">
                    <i class="fas fa-folder"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $stats['total_users'] }}</h3>
                    <p>Utilisateurs</p>
                </div>
                <div class="icon text-info">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $stats['produits_rupture'] }}</h3>
                    <p>Rupture de Stock</p>
                </div>
                <div class="icon text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-clock"></i> Derniers Produits Ajoutés</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Marque/Type</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($derniers_produits as $produit)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/produits/' . $produit->photo_principale) }}"
                                             alt="{{ $produit->marque }}"
                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
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
                                        @if($produit->stock > 0)
                                            <span class="badge badge-success">{{ $produit->stock }}</span>
                                        @else
                                            <span class="badge badge-danger">Rupture</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $produit) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Aucun produit trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-bolt"></i> Actions Rapides</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-block">
                            <i class="fas fa-plus"></i> Nouveau Produit
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-list"></i> Voir tous les Produits
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-info btn-block">
                            <i class="fas fa-folder"></i> Gérer Catégories
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-users"></i> Gérer Utilisateurs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
