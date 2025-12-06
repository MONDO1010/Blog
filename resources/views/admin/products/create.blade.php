@extends('admin.layouts.app')

@section('page-title', 'Nouveau Produit')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-plus"></i> Ajouter un Nouveau Produit</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="marque">Marque <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('marque') is-invalid @enderror"
                                   id="marque" name="marque" value="{{ old('marque') }}" required>
                            @error('marque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                   id="type" name="type" value="{{ old('type') }}" required>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="couleur">Couleur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('couleur') is-invalid @enderror"
                                   id="couleur" name="couleur" value="{{ old('couleur') }}" required>
                            @error('couleur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="prix">Prix (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('prix') is-invalid @enderror"
                                   id="prix" name="prix" value="{{ old('prix') }}" min="0" step="0.01" required>
                            @error('prix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                   id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Catégorie <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control @error('tags') is-invalid @enderror"
                                id="tags" name="tags[]" multiple size="5">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                    {{ $tag->nom }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags</small>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo_principale">Photo Principale <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file @error('photo_principale') is-invalid @enderror"
                               id="photo_principale" name="photo_principale" accept="image/*" required>
                        <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG (max 2MB)</small>
                        @error('photo_principale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <img id="preview" src="#" alt="Aperçu" style="max-width: 200px; display: none; margin-top: 10px; border-radius: 5px;">
                    </div>

                    <hr>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Créer le Produit
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image preview
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
