<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $produit= new \App\Models\Produit();
        $produit->marque = "KEVLA";
        $produit->type = "KV 125-8A";
        $produit->couleur = "noir";
        $produit->prix = "450000";
        $produit->stock = "50";
        $produit->description = "super marque";
        $produit->photo_principale = "motohomme.jpeg";
        $produit->category_id = 2;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "KEVLA";
        $produit->type = "KV 200";
        $produit->couleur = "trehille";
        $produit->prix = "11000000";
        $produit->stock = "5";
        $produit->description = "super moto a trois roue";
        $produit->photo_principale = "tricylcle.jpeg";
        $produit->category_id = 3;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "KEVLA";
        $produit->type = "KV 110-3";
        $produit->couleur = "cendre";
        $produit->prix = "550000";
        $produit->stock = "150";
        $produit->description = "super marque";
        $produit->photo_principale = "motohomme.jpeg";
        $produit->category_id = 1;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "SANYA";
        $produit->type = "SY 125-8";
        $produit->couleur = "BLEUE";
        $produit->prix = "510000";
        $produit->stock = "34";
        $produit->description = "super marque";
        $produit->photo_principale = "tricylcle.jpeg";
        $produit->category_id = 2;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "SANYA";
        $produit->type = "KV 125-10";
        $produit->couleur = "cafe";
        $produit->prix = "380000";
        $produit->stock = "40";
        $produit->description = "super marque";
        $produit->photo_principale = "motohomme.jpeg";
        $produit->category_id = 2;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "HAOJUE";
        $produit->type = "HJ 125-8";
        $produit->couleur = "rouge";
        $produit->prix = "630000";
        $produit->stock = "90";
        $produit->description = "super marque";
        $produit->photo_principale = "tricylcle.jpeg";
        $produit->category_id = 2;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "HAOJUE";
        $produit->type = "HJ 110-3";
        $produit->couleur = "blanc";
        $produit->prix = "700000";
        $produit->stock = "580";
        $produit->description = "super marque";
        $produit->photo_principale = "motohomme.jpeg";
        $produit->category_id = 1;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "HAOJUE";
        $produit->type = "DR 300";
        $produit->couleur = "noir";
        $produit->prix = "3450000";
        $produit->stock = "30";
        $produit->description = "super marque";
        $produit->photo_principale = "tricylcle.jpeg";
        $produit->category_id = 2;
        $produit->save();

        $produit= new \App\Models\Produit();
        $produit->marque = "APSONIC";
        $produit->type = "AP 200";
        $produit->couleur = "CENDRE";
        $produit->prix = "1450000";
        $produit->stock = "5";
        $produit->description = "super marque";
        $produit->photo_principale = "motohomme.jpeg";
        $produit->category_id = 4;
        $produit->save();

        
    }
}
