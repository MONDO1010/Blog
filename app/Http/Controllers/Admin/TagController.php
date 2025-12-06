<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('produits')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag créé avec succès!');
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:tags,nom,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag mis à jour avec succès!');
    }

    public function destroy(Tag $tag)
    {
        $tag->produits()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag supprimé avec succès!');
    }
}
