<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Obtenir l'identifiant de session pour les utilisateurs non authentifiés
     */
    private function getSessionId(Request $request): string
    {
        if (!$request->session()->has('cart_session_id')) {
            $request->session()->put('cart_session_id', uniqid('cart_', true));
        }
        return $request->session()->get('cart_session_id');
    }

    /**
     * Afficher le panier
     */
    public function index(Request $request)
    {
        $cartItems = $this->getCartItems($request);

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->produit->prix;
        });

        return view('shop.cart', compact('cartItems', 'total'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $produit = Produit::findOrFail($productId);
        $quantity = $request->input('quantity', 1);

        // Vérifier si le produit existe déjà dans le panier
        $cartItem = $this->findCartItem($request, $productId);

        if ($cartItem) {
            // Mettre à jour la quantité
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Créer un nouvel item dans le panier
            Cart::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : $this->getSessionId($request),
                'produit_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès!');
    }

    /**
     * Mettre à jour la quantité d'un produit
     */
    public function updateQuantity(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($cartId);

        // Vérifier que l'item appartient à l'utilisateur
        if (!$this->canAccessCartItem($request, $cartItem)) {
            abort(403);
        }

        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour!');
    }

    /**
     * Supprimer un produit du panier
     */
    public function remove(Request $request, $cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        // Vérifier que l'item appartient à l'utilisateur
        if (!$this->canAccessCartItem($request, $cartItem)) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier!');
    }

    /**
     * Vider le panier
     */
    public function clear(Request $request)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            Cart::where('session_id', $this->getSessionId($request))->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Panier vidé!');
    }

    /**
     * Obtenir les items du panier
     */
    private function getCartItems(Request $request)
    {
        if (Auth::check()) {
            return Cart::with('produit')->where('user_id', Auth::id())->get();
        } else {
            return Cart::with('produit')->where('session_id', $this->getSessionId($request))->get();
        }
    }

    /**
     * Trouver un item dans le panier
     */
    private function findCartItem(Request $request, $productId)
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())
                       ->where('produit_id', $productId)
                       ->first();
        } else {
            return Cart::where('session_id', $this->getSessionId($request))
                       ->where('produit_id', $productId)
                       ->first();
        }
    }

    /**
     * Vérifier si l'utilisateur peut accéder à cet item du panier
     */
    private function canAccessCartItem(Request $request, Cart $cartItem): bool
    {
        if (Auth::check()) {
            return $cartItem->user_id == Auth::id();
        } else {
            return $cartItem->session_id == $this->getSessionId($request);
        }
    }

    /**
     * Migrer le panier de session vers l'utilisateur connecté
     * (À appeler lors de la connexion)
     */
    public static function migrateSessionCart(Request $request)
    {
        if ($request->session()->has('cart_session_id')) {
            $sessionId = $request->session()->get('cart_session_id');

            Cart::where('session_id', $sessionId)->update([
                'user_id' => Auth::id(),
                'session_id' => null,
            ]);

            $request->session()->forget('cart_session_id');
        }
    }
}
