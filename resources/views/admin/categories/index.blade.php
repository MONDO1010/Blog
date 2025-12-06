@extends('admin.layouts.app')

@section('page-title', 'Gestion des Catégories')

@section('content')
<div class="row mb-3">
    <div class="col-md-12 text-right">
        <button class="btn btn-success" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Nouvelle Catégorie
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Nombre de Produits</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><strong>{{ $category->nom }}</strong></td>
                            <td>
                                <span class="badge badge-primary">{{ $category->produits_count }} produit(s)</span>
                            </td>
                            <td>
                                @if($category->is_online)
                                    <span class="badge badge-success">En ligne</span>
                                @else
                                    <span class="badge badge-secondary">Hors ligne</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $category->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr? Cette action est irréversible.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" {{ $category->produits_count > 0 ? 'disabled title=Impossible de supprimer une catégorie contenant des produits' : '' }}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Modifier la Catégorie</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nom">Nom de la catégorie <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nom" value="{{ $category->nom }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Statut</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_online" value="0">
                                                    <input type="checkbox" class="custom-control-input" id="is_online_{{ $category->id }}" name="is_online" value="1" {{ $category->is_online ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_online_{{ $category->id }}">Catégorie en ligne</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune catégorie trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Nouvelle Catégorie</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="is_online" value="0">
                            <input type="checkbox" class="custom-control-input" id="is_online_create" name="is_online" value="1" checked>
                            <label class="custom-control-label" for="is_online_create">Catégorie en ligne</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
