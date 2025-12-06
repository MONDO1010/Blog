<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['marque', 'type', 'couleur', 'prix', 'stock', 'description', 'photo_principale', 'category_id'];

public function tags()
{
    return $this->belongsToMany(Tag::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
}

