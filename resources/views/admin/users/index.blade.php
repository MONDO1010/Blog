@extends('admin.layouts.app')

@section('page-title', 'Gestion des Utilisateurs')
@section('page-description', 'Gérez les comptes et les rôles des utilisateurs')

@section('content')
<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $users->total() }}</h3>
                <p>Total Utilisateurs</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $users->where('is_admin', true)->count() }}</h3>
                <p>Administrateurs</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $users->where('is_admin', false)->count() }}</h3>
                <p>Utilisateurs Standard</p>
            </div>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="flat-card">
    <div class="flat-card-header">
        <h5 class="flat-card-title">Liste des utilisateurs</h5>
        <span class="flat-badge flat-badge-info">{{ $users->total() }} utilisateurs</span>
    </div>
    <div class="flat-card-body p-0">
        <div class="table-responsive">
            <table class="flat-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscription</th>
                        <th style="width: 160px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="text-muted">{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="admin-user-avatar mr-2" style="width: 36px; height: 36px; font-size: 13px;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="flat-badge flat-badge-danger">Administrateur</span>
                                @else
                                    <span class="flat-badge flat-badge-info">Utilisateur</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small>
                            </td>
                            <td>
                                @if(auth()->user()->id !== $user->id)
                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur?');">
                                        @csrf
                                        @if($user->is_admin)
                                            <button type="submit" class="flat-btn flat-btn-sm flat-btn-danger">
                                                <i class="fas fa-user-minus"></i> Retirer Admin
                                            </button>
                                        @else
                                            <button type="submit" class="flat-btn flat-btn-sm flat-btn-success">
                                                <i class="fas fa-user-shield"></i> Promouvoir
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <span class="flat-badge flat-badge-warning">
                                        <i class="fas fa-user-check"></i> C'est vous
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h4>Aucun utilisateur</h4>
                                    <p>Les utilisateurs inscrits apparaîtront ici</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($users->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $users->links() }}
</div>
@endif

<!-- Info Card -->
<div class="flat-card mt-4" style="background: rgba(66, 165, 245, 0.1); border-left: 4px solid var(--admin-info);">
    <div class="flat-card-body">
        <div class="d-flex align-items-start">
            <i class="fas fa-info-circle text-info mr-3" style="font-size: 20px;"></i>
            <div>
                <strong>Information</strong>
                <p class="mb-0 text-muted" style="font-size: 14px;">Vous ne pouvez pas modifier votre propre statut administrateur. Les utilisateurs standard ne peuvent pas accéder à cette zone d'administration.</p>
            </div>
        </div>
    </div>
</div>
@endsection
