@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('page-description', 'Vue d\'ensemble de votre activité')

@section('content')
<!-- Stat Cards - Row 1 -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_produits'] }}</h3>
                <p>Total Produits</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_commandes'] }}</h3>
                <p>Commandes</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['commandes_en_attente'] }}</h3>
                <p>En Attente</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-coins"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($stats['chiffre_affaires'], 0, ',', ' ') }} F</h3>
                <p>Chiffre d'affaires</p>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards - Row 2 -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon secondary">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_categories'] }}</h3>
                <p>Catégories</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Utilisateurs</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon {{ $stats['produits_rupture'] > 0 ? 'danger' : 'success' }}">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['produits_rupture'] }}</h3>
                <p>Rupture de Stock</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="flat-card">
            <div class="flat-card-body">
                <div class="d-flex flex-wrap gap-2" style="gap: 12px;">
                    <a href="{{ route('admin.orders.index') }}" class="flat-btn flat-btn-warning">
                        <i class="fas fa-shopping-bag"></i> Commandes
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="flat-btn flat-btn-success">
                        <i class="fas fa-plus"></i> Nouveau Produit
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flat-btn flat-btn-primary">
                        <i class="fas fa-list"></i> Tous les Produits
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flat-btn flat-btn-outline">
                        <i class="fas fa-folder"></i> Catégories
                    </a>
                    <a href="{{ route('admin.tags.index') }}" class="flat-btn flat-btn-outline">
                        <i class="fas fa-tags"></i> Tags
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row mb-4">
    <div class="col-12">
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-shopping-bag mr-2 text-warning"></i> Dernières Commandes
                </h5>
                <a href="{{ route('admin.orders.index') }}" class="flat-btn flat-btn-sm flat-btn-outline">
                    Voir tout
                </a>
            </div>
            <div class="flat-card-body p-0">
                <div class="table-responsive">
                    <table class="flat-table">
                        <thead>
                            <tr>
                                <th>N° Commande</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieres_commandes as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>
                                        {{ $order->customer_name }}
                                        <br>
                                        <small class="text-muted">{{ $order->customer_email }}</small>
                                    </td>
                                    <td><strong>{{ number_format($order->total, 0, ',', ' ') }} F</strong></td>
                                    <td>
                                        <span class="flat-badge flat-badge-{{ $order->payment_status_color }}">
                                            {{ $order->payment_status_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="flat-badge flat-badge-{{ $order->status_color }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ $order->created_at->format('d/m/Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="flat-btn flat-btn-sm flat-btn-primary flat-btn-icon" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-shopping-bag"></i>
                                            <h4>Aucune commande</h4>
                                            <p>Les commandes apparaîtront ici</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="row">
    <div class="col-12">
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-clock mr-2 text-primary"></i> Derniers Produits
                </h5>
                <a href="{{ route('admin.products.index') }}" class="flat-btn flat-btn-sm flat-btn-outline">
                    Voir tout
                </a>
            </div>
            <div class="flat-card-body p-0">
                <div class="table-responsive">
                    <table class="flat-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($derniers_produits as $produit)
                                <tr>
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
                                        @if($produit->stock > 0)
                                            <span class="flat-badge flat-badge-success">{{ $produit->stock }} en stock</span>
                                        @else
                                            <span class="flat-badge flat-badge-danger">Rupture</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.products.edit', $produit) }}" class="flat-btn flat-btn-sm flat-btn-primary flat-btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-motorcycle"></i>
                                            <h4>Aucun produit</h4>
                                            <p>Ajoutez votre premier produit pour commencer</p>
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
    </div>
</div>
@endsection
