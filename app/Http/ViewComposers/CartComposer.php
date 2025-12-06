<?php

namespace App\Http\ViewComposers;

use App\Models\Cart;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CartComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $cartCount = $this->getCartCount();
        $view->with('cartCount', $cartCount);
    }

    /**
     * Get cart count for current user/session
     */
    private function getCartCount(): int
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->count();
        }

        $sessionId = session('cart_session_id');
        if (!$sessionId) {
            return 0;
        }

        return Cart::where('session_id', $sessionId)->count();
    }
}
