<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Informations client
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Adresse de livraison
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_quarter')->nullable(); // Quartier

            // Montants
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('total', 12, 2);

            // Paiement
            $table->enum('payment_method', ['cash_on_delivery', 'mobile_money', 'bank_transfer'])->default('cash_on_delivery');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_reference')->nullable();
            $table->timestamp('paid_at')->nullable();

            // Statut commande
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');

            // Notes
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
