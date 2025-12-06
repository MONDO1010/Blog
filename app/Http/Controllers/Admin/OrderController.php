<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Afficher la liste des commandes
     */
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show(Order $order)
    {
        $order->load('items.produit', 'user');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mettre à jour le statut d'une commande
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }

    /**
     * Mettre à jour le statut de paiement
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $data = ['payment_status' => $request->payment_status];

        if ($request->payment_status === 'paid' && !$order->paid_at) {
            $data['paid_at'] = now();
        }

        $order->update($data);

        return redirect()->back()->with('success', 'Statut de paiement mis à jour.');
    }
}
