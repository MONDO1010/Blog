<?php

//use Illuminate\Support\Facades\Route;
//Route::get('/', function () {
   // return view('home');
//});
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // Vue home.blade.php
})->name('home');
use App\Http\Controllers\Shop\MotoController;

Route::get('/categorie/{id}', [MotoController::class, 'viewByCategory'])->name('voir_produit_par_cat');
Route::get('/tag/{id}', [MotoController::class, 'viewByTag'])->name('voir_produit_par_tag');
//Route::get('/produit/{id}', [MotoController::class, 'show'])->name('voir_produit');
Route::get('/produit/{id}', [MotoController::class, 'produit'])->name('voir_produit');







