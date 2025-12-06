<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\MotoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;

// Public Routes
Route::get('/', [MotoController::class, 'home'])->name('home');

Route::get('/categorie/{id}', [MotoController::class, 'viewByCategory'])->name('voir_produit_par_cat');
Route::get('/tag/{id}', [MotoController::class, 'viewByTag'])->name('voir_produit_par_tag');
Route::get('/produit/{id}', [MotoController::class, 'produit'])->name('voir_produit');

// Cart Routes
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/panier/modifier/{cart}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/panier/retirer/{cart}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');

// Shop Routes
Route::get('/boutique', [MotoController::class, 'index'])->name('shop.index');

// Checkout Routes
Route::get('/commander', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/commander/paiement', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/commander/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
Route::get('/commander/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products CRUD
    Route::resource('products', ProductController::class);

    // Categories CRUD
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

    // Tags CRUD
    Route::resource('tags', TagController::class)->except(['create', 'show', 'edit']);

    // Users Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggle-admin');

    // Orders Management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('orders/{order}/payment', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment');
});







