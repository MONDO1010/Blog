<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Category;
use App\Models\Tag;

class MotoController extends Controller
{
    public function bienvenu() {
        // SELECT * FROM produits:
         //$produits = Produit::with('category')->get();
         //dd($produits);
         //$categories = Category::where('is_online', 1)->get();
        return view('layouts.bienvenu');
    }
    public function index() {
        // SELECT * FROM produits:
         $produits = Produit::with('category')->get();
         //dd($produits);
         //$categories = Category::where('is_online', 1)->get();
        return view('Shop.index', compact('produits', ));
    }

    public function produit(Request $request, $id)
{
    // Récupère le produit en fonction de l'ID passé dans l'URL
    $produit = Produit::with(['Tags', 'category'])->findOrFail($id);
   $categories = Category::where('is_online', 1)->get();
    // Retourne la vue avec le produit récupéré
    return view('shop.produit', compact('produit', 'categories'));
    
}
public function viewByCategory($id)
{
    // Récupérer toutes les catégories en ligne
    $categories = Category::where('is_online', 1)->get();

    // Récupérer tous les produits de la catégorie demandée
    $produits = Produit::where('category_id', $id)->get();

    // Retourner la vue avec les produits et catégories
    return view('shop.categorie', compact('produits', 'categories'));
}

    public function viewByTag(Request $request){
        $Tag = Tag::find($request->id);
        $produits = $Tag->produits;
        return view('shop.categorie',compact('produits'));
    }

    // Méthode pour afficher un produit spécifique
   // public function produit($id)
    //{
        //$produit = Produit::with('tags')->findOrFail($id);
    
       // return view('shop.produit', compact('produit'));
  //  }
    

}
