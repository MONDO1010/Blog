<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_quarter',
        'subtotal',
        'shipping_fee',
        'total',
        'payment_method',
        'payment_status',
        'payment_reference',
        'paid_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Générer un numéro de commande unique
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'CMD';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));

        return "{$prefix}-{$date}-{$random}";
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les items de la commande
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Labels pour les statuts
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'En attente',
            'confirmed' => 'Confirmée',
            'processing' => 'En préparation',
            'shipped' => 'Expédiée',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
            default => $this->status,
        };
    }

    /**
     * Labels pour les statuts de paiement
     */
    public function getPaymentStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'En attente',
            'paid' => 'Payé',
            'failed' => 'Échoué',
            'refunded' => 'Remboursé',
            default => $this->payment_status,
        };
    }

    /**
     * Labels pour les méthodes de paiement
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'cash_on_delivery' => 'Paiement à la livraison',
            'mobile_money' => 'Mobile Money',
            'bank_transfer' => 'Virement bancaire',
            default => $this->payment_method,
        };
    }

    /**
     * Couleur du badge statut
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'processing' => 'primary',
            'shipped' => 'info',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Couleur du badge paiement
     */
    public function getPaymentStatusColorAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            'refunded' => 'info',
            default => 'secondary',
        };
    }
}
