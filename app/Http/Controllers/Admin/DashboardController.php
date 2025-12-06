<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produits' => Produit::count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'produits_rupture' => Produit::where('stock', 0)->count(),
            'total_commandes' => Order::count(),
            'commandes_en_attente' => Order::where('status', 'pending')->count(),
            'chiffre_affaires' => Order::where('payment_status', 'paid')->sum('total'),
        ];

        $derniers_produits = Produit::with('category')
            ->latest()
            ->take(5)
            ->get();

        $dernieres_commandes = Order::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'derniers_produits', 'dernieres_commandes'));
    }
}
