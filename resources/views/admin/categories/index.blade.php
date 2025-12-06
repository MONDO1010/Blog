@extends('admin.layouts.app')

@section('page-title', 'Gestion des Catégories')
@section('page-description', 'Organisez vos produits par catégories')

@section('content')
<!-- Header Actions -->
<div class="row mb-4">
    <div class="col-12 text-right">
        <button class="flat-btn flat-btn-success" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Nouvelle Catégorie
        </button>
    </div>
</div>

<!-- Categories Table -->
<div class="flat-card">
    <div class="flat-card-header">
        <h5 class="flat-card-title">Liste des catégories</h5>
        <span class="flat-badge flat-badge-info">{{ $categories->count() }} catégories</span>
    </div>
    <div class="flat-card-body p-0">
        <div class="table-responsive">
            <table class="flat-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Nom</th>
                        <th>Produits</th>
                        <th>Statut</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="text-muted">{{ $category->id }}</td>
                            <td><strong>{{ $category->nom }}</strong></td>
                            <td>
                                <span class="flat-badge flat-badge-info">{{ $category->produits_count }} produit(s)</span>
                            </td>
                            <td>
                                @if($category->is_online)
                                    <span class="flat-badge flat-badge-success">En ligne</span>
                                @else
                                    <span class="flat-badge flat-badge-warning">Hors ligne</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="flat-btn flat-btn-sm flat-btn-icon flat-btn-primary" data-toggle="modal" data-target="#editModal{{ $category->id }}" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr? Cette action est irréversible.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flat-btn flat-btn-sm flat-btn-icon flat-btn-danger" title="Supprimer" {{ $category->produits_count > 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border-radius: var(--admin-radius); border: none;">
                                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header" style="background: var(--admin-primary); color: white; border-radius: var(--admin-radius) var(--admin-radius) 0 0;">
                                            <h5 class="modal-title">Modifier la Catégorie</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="flat-label">Nom de la catégorie <span class="text-danger">*</span></label>
                                                <input type="text" class="flat-input" name="nom" value="{{ $category->nom }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="flat-label">Statut</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name="is_online" value="0">
                                                    <input type="checkbox" class="custom-control-input" id="is_online_{{ $category->id }}" name="is_online" value="1" {{ $category->is_online ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="is_online_{{ $category->id }}">Catégorie visible sur le site</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="flat-btn flat-btn-outline" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="flat-btn flat-btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <h4>Aucune catégorie</h4>
                                    <p>Créez votre première catégorie pour organiser vos produits</p>
                                    <button class="flat-btn flat-btn-primary" data-toggle="modal" data-target="#createModal">
                                        <i class="fas fa-plus"></i> Créer une catégorie
                                    </button>
                                </div>
                            </td>
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
        <div class="modal-content" style="border-radius: var(--admin-radius); border: none;">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background: var(--admin-success); color: white; border-radius: var(--admin-radius) var(--admin-radius) 0 0;">
                    <h5 class="modal-title">Nouvelle Catégorie</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="flat-label">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text" class="flat-input" name="nom" placeholder="Ex: Motos Sport" required>
                    </div>
                    <div class="mb-3">
                        <label class="flat-label">Statut</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="is_online" value="0">
                            <input type="checkbox" class="custom-control-input" id="is_online_create" name="is_online" value="1" checked>
                            <label class="custom-control-label" for="is_online_create">Catégorie visible sur le site</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="flat-btn flat-btn-outline" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="flat-btn flat-btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
