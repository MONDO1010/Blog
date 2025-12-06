@extends('layouts.master')

@section('title', 'Commande confirmée - Ets Modeste')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <!-- Steps Progress -->
    <div class="neu-card mb-4">
        <div class="checkout-steps">
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span class="step-label">Livraison</span>
            </div>
            <div class="step-line completed"></div>
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span class="step-label">Paiement</span>
            </div>
            <div class="step-line completed"></div>
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span class="step-label">Confirmation</span>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div class="neu-card text-center mb-4">
        <div class="py-4">
            <div class="confirmation-animation">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="confirmation-title">Merci pour votre commande !</h2>
            <p class="confirmation-subtitle">Votre commande a été enregistrée avec succès</p>

            <div class="order-number-display">
                <div class="label">Numéro de commande</div>
                <div class="number">{{ $order->order_number }}</div>
            </div>

            @if($order->payment_status === 'paid')
                <div class="alert alert-success d-inline-block">
                    <i class="fas fa-check-circle mr-2"></i> Paiement confirmé
                </div>
            @elseif($order->payment_method === 'cash_on_delivery')
                <div class="alert alert-info d-inline-block">
                    <i class="fas fa-truck mr-2"></i> Paiement à effectuer à la livraison
                </div>
            @else
                <div class="alert alert-warning d-inline-block">
                    <i class="fas fa-clock mr-2"></i> En attente de confirmation du paiement
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8 mb-4">
            <div class="neu-card">
                <h5 class="mb-4 text-gradient">
                    <i class="fas fa-box mr-2"></i> Détails de la commande
                </h5>

                <!-- Order Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="address-summary mb-3">
                            <h6><i class="fas fa-hashtag mr-2"></i>Numéro de commande</h6>
                            <p><strong style="font-size: 18px;">{{ $order->order_number }}</strong></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="address-summary mb-3">
                            <h6><i class="fas fa-calendar mr-2"></i>Date</h6>
                            <p><strong>{{ $order->created_at->format('d/m/Y à H:i') }}</strong></p>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <h6 class="text-gradient mb-3">
                    <i class="fas fa-shopping-bag mr-2"></i> Articles commandés
                </h6>

                <div class="mb-4">
                    @foreach($order->items as $item)
                        <div class="order-summary-item">
                            @if($item->produit)
                                <img src="{{ asset('storage/produits/' . $item->produit->photo_principale) }}"
                                     alt="{{ $item->product_name }}"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            @else
                                <div style="width: 55px; height: 55px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-meta">
                                    <span class="item-qty">x{{ $item->quantity }} @ {{ number_format($item->unit_price, 0, ',', ' ') }} F</span>
                                    <span class="item-price">{{ number_format($item->subtotal, 0, ',', ' ') }} F</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="checkout-totals">
                    <div class="total-row">
                        <span class="total-label">Sous-total</span>
                        <span class="total-value">{{ number_format($order->subtotal, 0, ',', ' ') }} F</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Livraison</span>
                        <span class="total-value">
                            @if($order->shipping_fee > 0)
                                {{ number_format($order->shipping_fee, 0, ',', ' ') }} F
                            @else
                                <span class="text-success">Gratuite</span>
                            @endif
                        </span>
                    </div>
                    <div class="total-row final">
                        <span class="total-label">Total</span>
                        <span class="total-value">{{ number_format($order->total, 0, ',', ' ') }} F</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="checkout-actions">
                    <a href="{{ route('home') }}" class="btn-back">
                        <i class="fas fa-home"></i> Retour à l'accueil
                    </a>
                    <a href="{{ route('shop.index') }}" class="btn-continue" style="text-decoration: none;">
                        <i class="fas fa-shopping-bag"></i> Continuer mes achats
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <!-- Shipping -->
            <div class="neu-card mb-4">
                <h5 class="mb-3 text-gradient">
                    <i class="fas fa-truck mr-2"></i> Livraison
                </h5>
                <div class="address-summary" style="margin: 0;">
                    <p><strong>{{ $order->customer_name }}</strong></p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>
                        {{ $order->shipping_quarter ? $order->shipping_quarter . ', ' : '' }}
                        {{ $order->shipping_city }}
                    </p>
                    <p><i class="fas fa-phone mr-1"></i> {{ $order->customer_phone }}</p>
                    <p><i class="fas fa-envelope mr-1"></i> {{ $order->customer_email }}</p>
                </div>
            </div>

            <!-- Payment -->
            <div class="neu-card mb-4">
                <h5 class="mb-3 text-gradient">
                    <i class="fas fa-credit-card mr-2"></i> Paiement
                </h5>
                <div class="checkout-totals" style="margin-top: 0;">
                    <div class="total-row">
                        <span class="total-label">Méthode</span>
                        <strong>{{ $order->payment_method_label }}</strong>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Statut</span>
                        <span class="badge badge-{{ $order->payment_status_color }}" style="padding: 6px 12px;">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>
                    @if($order->payment_reference)
                        <div class="total-row">
                            <span class="total-label">Référence</span>
                            <code style="font-size: 12px;">{{ $order->payment_reference }}</code>
                        </div>
                    @endif
                </div>

                @if($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
                    <div class="simulation-alert mt-3" style="font-size: 13px;">
                        <strong><i class="fas fa-university mr-1"></i> Informations bancaires :</strong><br>
                        <small>
                            Banque: Ecobank Togo<br>
                            IBAN: TG53 0149 0001 0123 4567 8901<br>
                            Référence: {{ $order->order_number }}
                        </small>
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div class="neu-card mb-4">
                <h5 class="mb-3 text-gradient">
                    <i class="fas fa-info-circle mr-2"></i> Statut de la commande
                </h5>
                <div class="text-center py-3">
                    <span class="badge badge-{{ $order->status_color }}" style="font-size: 16px; padding: 12px 24px; border-radius: 25px;">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>

            <!-- Contact -->
            <div class="neu-card text-center">
                <h6 class="mb-3"><i class="fas fa-question-circle mr-2 text-gradient"></i>Une question ?</h6>
                <p class="mb-2">
                    <a href="tel:+22890000000" class="text-gradient" style="font-size: 18px; font-weight: 600;">
                        <i class="fas fa-phone mr-1"></i> +228 90 00 00 00
                    </a>
                </p>
                <small class="text-muted">Du lundi au samedi, 8h - 18h</small>
            </div>
        </div>
    </div>
</div>
@endsection
