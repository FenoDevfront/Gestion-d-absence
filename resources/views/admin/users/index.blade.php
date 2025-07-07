@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="h3 mb-0">Gestion des utilisateurs</h1>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 150px;">
                                        <option value="employe" @if($user->role == 'employe') selected @endif>Employé</option>
                                        <option value="superviseur" @if($user->role == 'superviseur') selected @endif>Superviseur</option>
                                        <option value="rh" @if($user->role == 'rh') selected @endif>RH</option>
                                        <option value="directeur" @if($user->role == 'directeur') selected @endif>Directeur</option>
                                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
