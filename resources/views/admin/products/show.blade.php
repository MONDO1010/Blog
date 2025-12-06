@extends('admin.layouts.app')

@section('page-title', 'Détails du Produit')
@section('page-description', $product->marque . ' ' . $product->type)

@section('content')
<div class="row">
    <!-- Product Image -->
    <div class="col-lg-4 mb-4">
        <div class="flat-card">
            <div class="flat-card-body p-3">
                <img src="{{ asset('storage/produits/' . $product->photo_principale) }}"
                     alt="{{ $product->marque }}"
                     class="w-100"
                     style="border-radius: var(--admin-radius); object-fit: cover; max-height: 350px;"
                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flat-card mt-3">
            <div class="flat-card-body">
                <div class="d-flex flex-column" style="gap: 10px;">
                    <a href="{{ route('admin.products.edit', $product) }}" class="flat-btn flat-btn-primary">
                        <i class="fas fa-edit"></i> Modifier ce produit
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flat-btn flat-btn-outline">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="col-lg-8">
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-motorcycle mr-2 text-primary"></i> Produit #{{ $product->id }}
                </h5>
                @if($product->stock > 0)
                    <span class="flat-badge flat-badge-success">En stock</span>
                @else
                    <span class="flat-badge flat-badge-danger">Rupture</span>
                @endif
            </div>
            <div class="flat-card-body">
                <h2 class="mb-1" style="color: var(--admin-text);">{{ $product->marque }}</h2>
                <h5 class="text-muted mb-4">{{ $product->type }}</h5>

                <!-- Price -->
                <div class="mb-4 p-3" style="background: #f8f9fa; border-radius: var(--admin-radius);">
                    <small class="text-muted d-block">Prix</small>
                    <span style="font-size: 28px; font-weight: 700; color: var(--admin-success);">
                        {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                    </span>
                </div>

                <!-- Details Table -->
                <div class="mb-4">
                    <table style="width: 100%;">
                        <tr>
                            <td class="py-2" style="width: 140px; color: var(--admin-text-light);">
                                <i class="fas fa-folder-open mr-2"></i>Catégorie
                            </td>
                            <td class="py-2">
                                <span class="flat-badge flat-badge-info">{{ $product->category->nom }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2" style="color: var(--admin-text-light);">
                                <i class="fas fa-palette mr-2"></i>Couleur
                            </td>
                            <td class="py-2"><strong>{{ $product->couleur }}</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2" style="color: var(--admin-text-light);">
                                <i class="fas fa-boxes mr-2"></i>Stock
                            </td>
                            <td class="py-2">
                                @if($product->stock > 10)
                                    <span class="flat-badge flat-badge-success">{{ $product->stock }} unités</span>
                                @elseif($product->stock > 0)
                                    <span class="flat-badge flat-badge-warning">{{ $product->stock }} unités (stock faible)</span>
                                @else
                                    <span class="flat-badge flat-badge-danger">Rupture de stock</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2" style="color: var(--admin-text-light);">
                                <i class="fas fa-tags mr-2"></i>Tags
                            </td>
                            <td class="py-2">
                                @forelse($product->tags as $tag)
                                    <span class="flat-badge flat-badge-info" style="font-size: 12px;">{{ $tag->nom }}</span>
                                @empty
                                    <span class="text-muted">Aucun tag</span>
                                @endforelse
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 style="color: var(--admin-text);">
                        <i class="fas fa-align-left mr-2 text-primary"></i>Description
                    </h6>
                    <p class="text-muted" style="line-height: 1.7;">{{ $product->description }}</p>
                </div>

                <!-- Metadata -->
                <div class="pt-3" style="border-top: 1px solid #eee;">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar-plus mr-1"></i>
                                Créé le {{ $product->created_at->format('d/m/Y à H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <small class="text-muted">
                                <i class="fas fa-calendar-check mr-1"></i>
                                Modifié le {{ $product->updated_at->format('d/m/Y à H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
