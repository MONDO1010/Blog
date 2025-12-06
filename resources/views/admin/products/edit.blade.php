@extends('admin.layouts.app')

@section('page-title', 'Modifier le Produit')
@section('page-description', 'Modifier les informations du produit #{{ $product->id }}')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-edit mr-2 text-primary"></i> Modifier le Produit
                </h5>
                <span class="flat-badge flat-badge-info">#{{ $product->id }}</span>
            </div>
            <div class="flat-card-body">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="flat-label">Marque <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('marque') is-invalid @enderror"
                                   name="marque" value="{{ old('marque', $product->marque) }}" required>
                            @error('marque')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="flat-label">Type <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('type') is-invalid @enderror"
                                   name="type" value="{{ old('type', $product->type) }}" required>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Couleur <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('couleur') is-invalid @enderror"
                                   name="couleur" value="{{ old('couleur', $product->couleur) }}" required>
                            @error('couleur')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Prix (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" class="flat-input @error('prix') is-invalid @enderror"
                                   name="prix" value="{{ old('prix', $product->prix) }}" min="0" step="1" required>
                            @error('prix')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="flat-input @error('stock') is-invalid @enderror"
                                   name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="flat-label">Catégorie <span class="text-danger">*</span></label>
                        <select class="flat-select @error('category_id') is-invalid @enderror" name="category_id" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="flat-label">Tags</label>
                        <select class="flat-select @error('tags') is-invalid @enderror" name="tags[]" multiple size="4">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $tag->nom }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Maintenez Ctrl pour sélectionner plusieurs tags</small>
                        @error('tags')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="flat-label">Description <span class="text-danger">*</span></label>
                        <textarea class="flat-input @error('description') is-invalid @enderror"
                                  name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="flat-label">Changer la Photo</label>
                        <input type="file" class="flat-input @error('photo_principale') is-invalid @enderror"
                               id="photo_principale" name="photo_principale" accept="image/*">
                        <small class="text-muted">Laissez vide pour conserver l'image actuelle. Formats: JPEG, PNG, JPG (max 2MB)</small>
                        @error('photo_principale')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                        <img id="preview" src="#" alt="Nouvelle image" style="max-width: 200px; display: none; margin-top: 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    </div>

                    <div class="d-flex" style="gap: 12px;">
                        <button type="submit" class="flat-btn flat-btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="flat-btn flat-btn-outline">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Current Image -->
        <div class="flat-card mb-4">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-image mr-2 text-info"></i> Photo Actuelle
                </h5>
            </div>
            <div class="flat-card-body text-center">
                <img src="{{ asset('storage/produits/' . $product->photo_principale) }}"
                     alt="{{ $product->marque }}"
                     style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder.svg') }}';">
            </div>
        </div>

        <!-- Product Info -->
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-info-circle mr-2 text-info"></i> Informations
                </h5>
            </div>
            <div class="flat-card-body">
                <table style="width: 100%; font-size: 14px;">
                    <tr>
                        <td class="text-muted py-2">Créé le</td>
                        <td class="text-right py-2">{{ $product->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Modifié le</td>
                        <td class="text-right py-2">{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Stock</td>
                        <td class="text-right py-2">
                            @if($product->stock > 0)
                                <span class="flat-badge flat-badge-success">{{ $product->stock }}</span>
                            @else
                                <span class="flat-badge flat-badge-danger">Rupture</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('photo_principale').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection
