<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::with(['category', 'tags']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('marque', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $produits = $query->latest()->paginate(10);

        return view('admin.products.index', compact('produits'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'photo_principale' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('photo_principale')) {
            $path = $request->file('photo_principale')->store('produits', 'public');
            $validated['photo_principale'] = basename($path);
        }

        $produit = Produit::create($validated);

        if ($request->has('tags')) {
            $produit->tags()->attach($request->tags);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit créé avec succès!');
    }

    public function show(Produit $product)
    {
        $product->load(['category', 'tags']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Produit $product)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.products.edit', compact('product', 'categories', 'tags'));
    }

    public function update(Request $request, Produit $product)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'couleur' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'photo_principale' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('photo_principale')) {
            // Delete old image
            if ($product->photo_principale) {
                Storage::disk('public')->delete('produits/' . $product->photo_principale);
            }

            $path = $request->file('photo_principale')->store('produits', 'public');
            $validated['photo_principale'] = basename($path);
        }

        $product->update($validated);

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        } else {
            $product->tags()->detach();
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit mis à jour avec succès!');
    }

    public function destroy(Produit $product)
    {
        // Delete image
        if ($product->photo_principale) {
            Storage::disk('public')->delete('produits/' . $product->photo_principale);
        }

        $product->tags()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès!');
    }
}
