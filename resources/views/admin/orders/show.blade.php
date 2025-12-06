@extends('admin.layouts.app')

@section('page-title', 'Commande ' . $order->order_number)
@section('page-description', 'Détails de la commande')

@section('content')
<div class="row">
    <!-- Détails commande -->
    <div class="col-lg-8 mb-4">
        <!-- Infos principales -->
        <div class="flat-card mb-4">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-receipt mr-2 text-primary"></i>{{ $order->order_number }}
                </h5>
                <span class="flat-badge flat-badge-{{ $order->status_color }}">{{ $order->status_label }}</span>
            </div>
            <div class="flat-card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-user mr-2"></i>Client</h6>
                        <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                        <p class="mb-1">{{ $order->customer_email }}</p>
                        <p class="mb-0">{{ $order->customer_phone }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-map-marker-alt mr-2"></i>Livraison</h6>
                        <p class="mb-1">{{ $order->shipping_address }}</p>
                        <p class="mb-0">
                            {{ $order->shipping_quarter ? $order->shipping_quarter . ', ' : '' }}
                            {{ $order->shipping_city }}
                        </p>
                    </div>
                </div>

                @if($order->notes)
                    <div class="mt-3 p-3" style="background: #f8f9fa; border-radius: var(--admin-radius);">
                        <h6 class="text-muted mb-2"><i class="fas fa-sticky-note mr-2"></i>Notes</h6>
                        <p class="mb-0">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Articles -->
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-box mr-2 text-primary"></i>Articles commandés
                </h5>
            </div>
            <div class="flat-card-body p-0">
                <table class="flat-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-right">Prix unitaire</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->produit)
                                            <img src="{{ asset('storage/produits/' . $item->produit->photo_principale) }}"
                                                 alt="{{ $item->product_name }}"
                                                 class="product-thumb mr-3"
                                                 onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                                        @endif
                                        <span>{{ $item->product_name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">{{ number_format($item->unit_price, 0, ',', ' ') }} F</td>
                                <td class="text-right"><strong>{{ number_format($item->subtotal, 0, ',', ' ') }} F</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Sous-total</td>
                            <td class="text-right">{{ number_format($order->subtotal, 0, ',', ' ') }} F</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Livraison</td>
                            <td class="text-right">
                                @if($order->shipping_fee > 0)
                                    {{ number_format($order->shipping_fee, 0, ',', ' ') }} F
                                @else
                                    Gratuite
                                @endif
                            </td>
                        </tr>
                        <tr style="background: #f8f9fa;">
                            <td colspan="3" class="text-right"><strong style="font-size: 16px;">Total</strong></td>
                            <td class="text-right"><strong style="font-size: 18px; color: var(--admin-success);">{{ number_format($order->total, 0, ',', ' ') }} F</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions et infos -->
    <div class="col-lg-4">
        <!-- Statut commande -->
        <div class="flat-card mb-4">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-truck mr-2 text-primary"></i>Statut
                </h5>
            </div>
            <div class="flat-card-body">
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <select name="status" class="flat-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En préparation</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrée</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    <button type="submit" class="flat-btn flat-btn-primary btn-block">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                </form>
            </div>
        </div>

        <!-- Paiement -->
        <div class="flat-card mb-4">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-credit-card mr-2 text-primary"></i>Paiement
                </h5>
            </div>
            <div class="flat-card-body">
                <div class="mb-3">
                    <small class="text-muted">Méthode</small>
                    <p class="mb-0"><strong>{{ $order->payment_method_label }}</strong></p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Référence</small>
                    <p class="mb-0"><code>{{ $order->payment_reference ?? 'N/A' }}</code></p>
                </div>

                <hr>

                <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="flat-label">Statut paiement</label>
                        <select name="payment_status" class="flat-select">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Payé</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Échoué</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Remboursé</option>
                        </select>
                    </div>
                    <button type="submit" class="flat-btn flat-btn-success btn-block">
                        <i class="fas fa-check"></i> Confirmer paiement
                    </button>
                </form>

                @if($order->paid_at)
                    <div class="mt-3 text-center">
                        <small class="text-success">
                            <i class="fas fa-check-circle"></i>
                            Payé le {{ $order->paid_at->format('d/m/Y à H:i') }}
                        </small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Infos -->
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-info-circle mr-2 text-primary"></i>Informations
                </h5>
            </div>
            <div class="flat-card-body">
                <div class="mb-2">
                    <small class="text-muted">Créée le</small>
                    <p class="mb-0">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div class="mb-2">
                    <small class="text-muted">Mise à jour</small>
                    <p class="mb-0">{{ $order->updated_at->format('d/m/Y à H:i') }}</p>
                </div>
                @if($order->user)
                    <div>
                        <small class="text-muted">Compte client</small>
                        <p class="mb-0">
                            <i class="fas fa-user"></i> {{ $order->user->name }}
                        </p>
                    </div>
                @else
                    <div>
                        <small class="text-muted">Compte client</small>
                        <p class="mb-0 text-warning">
                            <i class="fas fa-user-slash"></i> Client non inscrit
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Retour -->
        <a href="{{ route('admin.orders.index') }}" class="flat-btn flat-btn-outline btn-block mt-4">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
