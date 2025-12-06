@extends('layouts.master')

@section('title', 'Commander - Ets Modeste')

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
                <li class="breadcrumb-item active">Commander</li>
            </ol>
        </nav>
    </div>

    <!-- Steps Progress -->
    <div class="neu-card mb-4">
        <div class="checkout-steps">
            <div class="step active">
                <span class="step-number">1</span>
                <span class="step-label">Livraison</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
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
        <!-- Shipping Form -->
        <div class="col-lg-8 mb-4">
            <div class="neu-card">
                <h4 class="mb-4 text-gradient">
                    <i class="fas fa-truck mr-2"></i> Informations de livraison
                </h4>

                <form action="{{ route('checkout.payment') }}" method="POST" class="checkout-form">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom complet <span class="required">*</span></label>
                                <input type="text" name="customer_name"
                                       class="neu-input @error('customer_name') is-invalid @enderror"
                                       value="{{ old('customer_name', $user->name ?? '') }}"
                                       placeholder="Votre nom complet"
                                       required>
                                @error('customer_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" name="customer_email"
                                       class="neu-input @error('customer_email') is-invalid @enderror"
                                       value="{{ old('customer_email', $user->email ?? '') }}"
                                       placeholder="votre@email.com"
                                       required>
                                @error('customer_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Téléphone <span class="required">*</span></label>
                        <input type="tel" name="customer_phone"
                               class="neu-input @error('customer_phone') is-invalid @enderror"
                               value="{{ old('customer_phone') }}"
                               placeholder="Ex: +228 90 00 00 00"
                               required>
                        @error('customer_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ville <span class="required">*</span></label>
                                <select name="shipping_city"
                                        class="neu-input @error('shipping_city') is-invalid @enderror"
                                        required>
                                    <option value="">Sélectionnez une ville</option>
                                    <option value="Lomé" {{ old('shipping_city') == 'Lomé' ? 'selected' : '' }}>Lomé</option>
                                    <option value="Kara" {{ old('shipping_city') == 'Kara' ? 'selected' : '' }}>Kara</option>
                                    <option value="Sokodé" {{ old('shipping_city') == 'Sokodé' ? 'selected' : '' }}>Sokodé</option>
                                    <option value="Atakpamé" {{ old('shipping_city') == 'Atakpamé' ? 'selected' : '' }}>Atakpamé</option>
                                    <option value="Dapaong" {{ old('shipping_city') == 'Dapaong' ? 'selected' : '' }}>Dapaong</option>
                                    <option value="Autre" {{ old('shipping_city') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('shipping_city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Quartier</label>
                                <input type="text" name="shipping_quarter"
                                       class="neu-input @error('shipping_quarter') is-invalid @enderror"
                                       value="{{ old('shipping_quarter') }}"
                                       placeholder="Ex: Bè, Adidogomé...">
                                @error('shipping_quarter')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Adresse complète <span class="required">*</span></label>
                        <textarea name="shipping_address"
                                  class="neu-input @error('shipping_address') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Numéro, rue, repère..."
                                  required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Notes (optionnel)</label>
                        <textarea name="notes"
                                  class="neu-input"
                                  rows="2"
                                  placeholder="Instructions spéciales pour la livraison...">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="checkout-actions">
                        <a href="{{ route('cart.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Retour au panier
                        </a>
                        <button type="submit" class="btn-continue">
                            Continuer vers le paiement <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="neu-card">
                <h5 class="mb-4 text-gradient">
                    <i class="fas fa-shopping-bag mr-2"></i> Récapitulatif
                </h5>

                <!-- Items List -->
                <div style="max-height: 300px; overflow-y: auto;">
                    @foreach($cartItems as $item)
                        <div class="order-summary-item">
                            <img src="{{ asset('storage/produits/' . $item->produit->photo_principale) }}"
                                 alt="{{ $item->produit->marque }}"
                                 onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
                            <div class="item-details">
                                <div class="item-name">{{ $item->produit->marque }}</div>
                                <small class="text-muted">{{ $item->produit->type }}</small>
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

                @if($shippingFee > 0)
                    <div class="simulation-alert mt-3" style="font-size: 13px;">
                        <i class="fas fa-info-circle"></i>
                        Livraison gratuite à partir de 500 000 F
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
