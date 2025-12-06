@extends('layouts.master')

@section('title', 'Paiement - Ets Modeste')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <div class="neu-breadcrumb mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Panier</a></li>
                <li class="breadcrumb-item"><a href="{{ route('checkout.index') }}">Livraison</a></li>
                <li class="breadcrumb-item active">Paiement</li>
            </ol>
        </nav>
    </div>

    <!-- Steps Progress -->
    <div class="neu-card mb-4">
        <div class="checkout-steps">
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span class="step-label">Livraison</span>
            </div>
            <div class="step-line completed"></div>
            <div class="step active">
                <span class="step-number">2</span>
                <span class="step-label">Paiement</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-number">3</span>
                <span class="step-label">Confirmation</span>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Payment Methods -->
        <div class="col-lg-8 mb-4">
            <div class="neu-card">
                <h4 class="mb-4 text-gradient">
                    <i class="fas fa-credit-card mr-2"></i> Choisissez votre mode de paiement
                </h4>

                <form action="{{ route('checkout.process') }}" method="POST" id="paymentForm">
                    @csrf

                    <div class="payment-methods">
                        <!-- Cash on Delivery -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="cash_on_delivery" checked>
                            <div class="payment-content">
                                <div class="payment-icon" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Paiement à la livraison</strong>
                                    <p>Payez en espèces lors de la réception de votre commande</p>
                                    <small class="text-success"><i class="fas fa-shield-alt"></i> Sans frais supplémentaires</small>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Mobile Money -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="mobile_money">
                            <div class="payment-content">
                                <div class="payment-icon" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Mobile Money</strong>
                                    <p>TMoney, Flooz, ou tout autre service Mobile Money</p>
                                    <small class="text-primary"><i class="fas fa-bolt"></i> Paiement instantané</small>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="bank_transfer">
                            <div class="payment-content">
                                <div class="payment-icon" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="payment-info">
                                    <strong>Virement bancaire</strong>
                                    <p>Effectuez un virement vers notre compte bancaire</p>
                                    <small class="text-warning"><i class="fas fa-clock"></i> Confirmation sous 24-48h</small>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Simulation Notice -->
                    <div class="simulation-alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Mode démonstration :</strong> Les paiements sont simulés. Aucune transaction réelle ne sera effectuée.
                    </div>

                    <!-- Shipping Address Summary -->
                    <div class="address-summary">
                        <h6><i class="fas fa-map-marker-alt mr-2"></i> Adresse de livraison</h6>
                        <p><strong>{{ $validated['customer_name'] }}</strong></p>
                        <p>{{ $validated['shipping_address'] }}</p>
                        <p>
                            {{ $validated['shipping_quarter'] ? $validated['shipping_quarter'] . ', ' : '' }}
                            {{ $validated['shipping_city'] }}
                        </p>
                        <p><i class="fas fa-phone mr-1"></i> {{ $validated['customer_phone'] }}</p>
                        <a href="{{ route('checkout.index') }}" class="edit-link">
                            <i class="fas fa-edit"></i> Modifier l'adresse
                        </a>
                    </div>

                    <!-- Actions -->
                    <div class="checkout-actions">
                        <a href="{{ route('checkout.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn-continue" id="payBtn">
                            <i class="fas fa-lock"></i> Confirmer et payer
                            <span class="price-tag">{{ number_format($total, 0, ',', ' ') }} F</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="neu-card">
                <h5 class="mb-4 text-gradient">
                    <i class="fas fa-receipt mr-2"></i> Votre commande
                </h5>

                <!-- Items List -->
                <div style="max-height: 280px; overflow-y: auto;">
                    @foreach($cartItems as $item)
                        <div class="order-summary-item">
                            <img src="{{ asset('storage/produits/' . $item->produit->photo_principale) }}"
                                 alt="{{ $item->produit->marque }}"
                                 onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            <div class="item-details">
                                <div class="item-name">{{ $item->produit->marque }}</div>
                                <div class="item-meta">
                                    <span class="item-qty">x{{ $item->quantity }}</span>
                                    <span class="item-price">{{ number_format($item->quantity * $item->produit->prix, 0, ',', ' ') }} F</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="checkout-totals">
                    <div class="total-row">
                        <span class="total-label">Sous-total</span>
                        <span class="total-value">{{ number_format($subtotal, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Livraison</span>
                        <span class="total-value">
                            @if($shippingFee > 0)
                                {{ number_format($shippingFee, 0, ',', ' ') }} F
                            @else
                                <span class="text-success">Gratuite</span>
                            @endif
                        </span>
                    </div>
                    <div class="total-row final">
                        <span class="total-label">Total</span>
                        <span class="total-value">{{ number_format($total, 0, ',', ' ') }} F</span>
                    </div>
                </div>

                <!-- Security Badge -->
                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Paiement 100% sécurisé</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('payBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement en cours...';
});
</script>
@endpush
