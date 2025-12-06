@extends('admin.layouts.app')

@section('page-title', 'Gestion des Tags')
@section('page-description', 'Étiquetez vos produits pour faciliter la recherche')

@section('content')
<!-- Header Actions -->
<div class="row mb-4">
    <div class="col-12 text-right">
        <button class="flat-btn flat-btn-success" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Nouveau Tag
        </button>
    </div>
</div>

<!-- Tags Table -->
<div class="flat-card">
    <div class="flat-card-header">
        <h5 class="flat-card-title">Liste des tags</h5>
        <span class="flat-badge flat-badge-info">{{ $tags->count() }} tags</span>
    </div>
    <div class="flat-card-body p-0">
        <div class="table-responsive">
            <table class="flat-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Nom</th>
                        <th>Produits associés</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td class="text-muted">{{ $tag->id }}</td>
                            <td>
                                <span class="flat-badge flat-badge-info" style="font-size: 13px;">
                                    <i class="fas fa-tag mr-1"></i> {{ $tag->nom }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $tag->produits_count }} produit(s)</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="flat-btn flat-btn-sm flat-btn-icon flat-btn-primary" data-toggle="modal" data-target="#editModal{{ $tag->id }}" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce tag? Les produits associés ne seront pas supprimés.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flat-btn flat-btn-sm flat-btn-icon flat-btn-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $tag->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border-radius: var(--admin-radius); border: none;">
                                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header" style="background: var(--admin-primary); color: white; border-radius: var(--admin-radius) var(--admin-radius) 0 0;">
                                            <h5 class="modal-title">Modifier le Tag</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="flat-label">Nom du tag <span class="text-danger">*</span></label>
                                                <input type="text" class="flat-input" name="nom" value="{{ $tag->nom }}" required>
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
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-tags"></i>
                                    <h4>Aucun tag</h4>
                                    <p>Créez des tags pour mieux organiser vos produits</p>
                                    <button class="flat-btn flat-btn-primary" data-toggle="modal" data-target="#createModal">
                                        <i class="fas fa-plus"></i> Créer un tag
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
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background: var(--admin-success); color: white; border-radius: var(--admin-radius) var(--admin-radius) 0 0;">
                    <h5 class="modal-title">Nouveau Tag</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="flat-label">Nom du tag <span class="text-danger">*</span></label>
                        <input type="text" class="flat-input" name="nom" placeholder="Ex: Sportive, Économique..." required>
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
