@extends('admin.layouts.app')

@section('page-title', 'Gestion des Commandes')
@section('page-description', 'Suivez et gérez toutes les commandes')

@section('content')
<!-- Filtres -->
<div class="flat-card mb-4">
    <div class="flat-card-body">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex flex-wrap align-items-end" style="gap: 15px;">
            <div>
                <label class="flat-label">Recherche</label>
                <input type="text" name="search" class="flat-input" placeholder="N° commande, nom, email..."
                       value="{{ request('search') }}" style="width: 200px;">
            </div>
            <div>
                <label class="flat-label">Statut</label>
                <select name="status" class="flat-select" style="width: 150px;">
                    <option value="">Tous</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>En préparation</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livrée</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <div>
                <label class="flat-label">Paiement</label>
                <select name="payment_status" class="flat-select" style="width: 150px;">
                    <option value="">Tous</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Payé</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Échoué</option>
                </select>
            </div>
            <div>
                <button type="submit" class="flat-btn flat-btn-primary">
                    <i class="fas fa-search"></i> Filtrer
                </button>
                <a href="{{ route('admin.orders.index') }}" class="flat-btn flat-btn-outline">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Liste des commandes -->
<div class="flat-card">
    <div class="flat-card-header">
        <h5 class="flat-card-title">Commandes</h5>
        <span class="flat-badge flat-badge-info">{{ $orders->total() }} commandes</span>
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
                        <th style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->order_number }}</strong>
                            </td>
                            <td>
                                <strong>{{ $order->customer_name }}</strong>
                                <br>
                                <small class="text-muted">{{ $order->customer_email }}</small>
                            </td>
                            <td>
                                <strong>{{ number_format($order->total, 0, ',', ' ') }} F</strong>
                            </td>
                            <td>
                                <span class="flat-badge flat-badge-{{ $order->payment_status_color }}">
                                    {{ $order->payment_status_label }}
                                </span>
                                <br>
                                <small class="text-muted">{{ $order->payment_method_label }}</small>
                            </td>
                            <td>
                                <span class="flat-badge flat-badge-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $order->created_at->format('d/m/Y') }}</small>
                                <br>
                                <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
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

<!-- Pagination -->
@if($orders->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $orders->withQueryString()->links() }}
</div>
@endif
@endsection
