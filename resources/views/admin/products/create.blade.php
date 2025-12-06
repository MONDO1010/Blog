@extends('admin.layouts.app')

@section('page-title', 'Nouveau Produit')
@section('page-description', 'Ajouter un nouveau produit au catalogue')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-plus mr-2 text-success"></i> Informations du Produit
                </h5>
            </div>
            <div class="flat-card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="flat-label">Marque <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('marque') is-invalid @enderror"
                                   name="marque" value="{{ old('marque') }}" placeholder="Ex: Honda" required>
                            @error('marque')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="flat-label">Type <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('type') is-invalid @enderror"
                                   name="type" value="{{ old('type') }}" placeholder="Ex: CBR 600RR" required>
                            @error('type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Couleur <span class="text-danger">*</span></label>
                            <input type="text" class="flat-input @error('couleur') is-invalid @enderror"
                                   name="couleur" value="{{ old('couleur') }}" placeholder="Ex: Rouge" required>
                            @error('couleur')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Prix (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" class="flat-input @error('prix') is-invalid @enderror"
                                   name="prix" value="{{ old('prix') }}" min="0" step="1" placeholder="Ex: 500000" required>
                            @error('prix')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="flat-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="flat-input @error('stock') is-invalid @enderror"
                                   name="stock" value="{{ old('stock') }}" min="0" placeholder="Ex: 10" required>
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
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
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
                                  name="description" rows="4" placeholder="Description détaillée du produit..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="flat-label">Photo Principale <span class="text-danger">*</span></label>
                        <input type="file" class="flat-input @error('photo_principale') is-invalid @enderror"
                               id="photo_principale" name="photo_principale" accept="image/*" required>
                        <small class="text-muted">Formats: JPEG, PNG, JPG (max 2MB)</small>
                        @error('photo_principale')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                        <img id="preview" src="#" alt="Aperçu" style="max-width: 200px; display: none; margin-top: 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    </div>

                    <div class="d-flex" style="gap: 12px;">
                        <button type="submit" class="flat-btn flat-btn-success">
                            <i class="fas fa-save"></i> Créer le Produit
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
        <div class="flat-card">
            <div class="flat-card-header">
                <h5 class="flat-card-title">
                    <i class="fas fa-info-circle mr-2 text-info"></i> Aide
                </h5>
            </div>
            <div class="flat-card-body">
                <p class="text-muted mb-3">Remplissez tous les champs obligatoires marqués d'un <span class="text-danger">*</span></p>

                <h6 class="mb-2">Conseils</h6>
                <ul class="text-muted" style="padding-left: 18px; font-size: 14px;">
                    <li class="mb-2">Utilisez une image de qualité (min 600x400px)</li>
                    <li class="mb-2">La description aide au référencement</li>
                    <li class="mb-2">Les tags facilitent la recherche</li>
                </ul>
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
