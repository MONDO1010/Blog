<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Afficher la page de checkout (informations de livraison)
     */
    public function index(Request $request)
    {
        $cartItems = $this->getCartItems($request);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->produit->prix);
        $shippingFee = $this->calculateShipping($subtotal);
        $total = $subtotal + $shippingFee;

        $user = Auth::user();

        return view('shop.checkout', compact('cartItems', 'subtotal', 'shippingFee', 'total', 'user'));
    }

    /**
     * Afficher la page de paiement
     */
    public function payment(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_quarter' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Stocker les infos en session
        $request->session()->put('checkout_info', $validated);

        $cartItems = $this->getCartItems($request);
        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->produit->prix);
        $shippingFee = $this->calculateShipping($subtotal);
        $total = $subtotal + $shippingFee;

        return view('shop.payment', compact('cartItems', 'subtotal', 'shippingFee', 'total', 'validated'));
    }

    /**
     * Traiter le paiement (simulation)
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash_on_delivery,mobile_money,bank_transfer',
        ]);

        // Récupérer les infos de checkout depuis la session
        $checkoutInfo = $request->session()->get('checkout_info');

        if (!$checkoutInfo) {
            return redirect()->route('checkout.index')
                ->with('error', 'Session expirée. Veuillez recommencer.');
        }

        $cartItems = $this->getCartItems($request);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        // Vérifier le stock
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->produit->stock) {
                return redirect()->route('cart.index')
                    ->with('error', "Stock insuffisant pour {$item->produit->marque} {$item->produit->type}.");
            }
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->produit->prix);
        $shippingFee = $this->calculateShipping($subtotal);
        $total = $subtotal + $shippingFee;

        $paymentMethod = $request->input('payment_method');

        try {
            DB::beginTransaction();

            // Simuler le paiement
            $paymentResult = $this->simulatePayment($paymentMethod, $total);

            // Créer la commande
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'customer_name' => $checkoutInfo['customer_name'],
                'customer_email' => $checkoutInfo['customer_email'],
                'customer_phone' => $checkoutInfo['customer_phone'],
                'shipping_address' => $checkoutInfo['shipping_address'],
                'shipping_city' => $checkoutInfo['shipping_city'],
                'shipping_quarter' => $checkoutInfo['shipping_quarter'] ?? null,
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'total' => $total,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentResult['status'],
                'payment_reference' => $paymentResult['reference'],
                'paid_at' => $paymentResult['status'] === 'paid' ? now() : null,
                'status' => $paymentResult['status'] === 'paid' ? 'confirmed' : 'pending',
                'notes' => $checkoutInfo['notes'] ?? null,
            ]);

            // Créer les items de la commande
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'produit_id' => $item->produit_id,
                    'product_name' => $item->produit->marque . ' ' . $item->produit->type,
                    'unit_price' => $item->produit->prix,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->produit->prix,
                ]);

                // Décrémenter le stock
                $item->produit->decrement('stock', $item->quantity);
            }

            // Vider le panier
            $this->clearCart($request);

            // Supprimer les infos de checkout de la session
            $request->session()->forget('checkout_info');

            DB::commit();

            return redirect()->route('checkout.confirmation', $order)
                ->with('success', 'Commande passée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('checkout.index')
                ->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    /**
     * Afficher la page de confirmation
     */
    public function confirmation(Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.produit');

        return view('shop.confirmation', compact('order'));
    }

    /**
     * Simuler le paiement selon la méthode choisie
     */
    private function simulatePayment(string $method, float $total): array
    {
        // Simuler un délai de traitement (effet réaliste)
        usleep(500000); // 0.5 seconde

        $reference = 'PAY-' . strtoupper(uniqid());

        switch ($method) {
            case 'mobile_money':
                // Simulation: 90% de succès
                $success = rand(1, 100) <= 90;
                return [
                    'status' => $success ? 'paid' : 'failed',
                    'reference' => $success ? $reference : null,
                    'message' => $success
                        ? 'Paiement Mobile Money effectué avec succès'
                        : 'Échec du paiement Mobile Money. Veuillez réessayer.',
                ];

            case 'bank_transfer':
                // Simulation: toujours en attente (le client doit effectuer le virement)
                return [
                    'status' => 'pending',
                    'reference' => $reference,
                    'message' => 'En attente de confirmation du virement bancaire',
                ];

            case 'cash_on_delivery':
            default:
                // Paiement à la livraison: toujours en attente
                return [
                    'status' => 'pending',
                    'reference' => $reference,
                    'message' => 'Paiement à effectuer à la livraison',
                ];
        }
    }

    /**
     * Calculer les frais de livraison
     */
    private function calculateShipping(float $subtotal): float
    {
        // Livraison gratuite au-dessus de 500000 FCFA
        if ($subtotal >= 500000) {
            return 0;
        }

        // Frais de livraison fixe
        return 5000;
    }

    /**
     * Obtenir les items du panier
     */
    private function getCartItems(Request $request)
    {
        if (Auth::check()) {
            return Cart::with('produit')->where('user_id', Auth::id())->get();
        }

        $sessionId = $request->session()->get('cart_session_id');
        if (!$sessionId) {
            return collect();
        }

        return Cart::with('produit')->where('session_id', $sessionId)->get();
    }

    /**
     * Vider le panier
     */
    private function clearCart(Request $request): void
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            $sessionId = $request->session()->get('cart_session_id');
            if ($sessionId) {
                Cart::where('session_id', $sessionId)->delete();
            }
        }
    }
}
