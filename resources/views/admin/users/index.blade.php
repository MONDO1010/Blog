@extends('admin.layouts.app')

@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge badge-danger">Administrateur</span>
                                @else
                                    <span class="badge badge-secondary">Utilisateur</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if(auth()->user()->id !== $user->id)
                                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}">
                                            @if($user->is_admin)
                                                <i class="fas fa-user-minus"></i> Retirer Admin
                                            @else
                                                <i class="fas fa-user-shield"></i> Promouvoir Admin
                                            @endif
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted"><small>(Vous)</small></span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucun utilisateur trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

<div class="alert alert-info mt-3">
    <i class="fas fa-info-circle"></i> <strong>Note:</strong> Vous ne pouvez pas modifier votre propre statut administrateur. Les utilisateurs standard ne peuvent pas accéder à cette zone d'administration.
</div>
@endsection
