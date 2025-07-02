@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des Utilisateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role" class="form-control">
                                <option value="employe" @if ($user->role == 'employe') selected @endif>Employé</option>
                                <option value="superviseur" @if ($user->role == 'superviseur') selected @endif>Superviseur</option>
                                <option value="rh" @if ($user->role == 'rh') selected @endif>RH</option>
                                <option value="directeur" @if ($user->role == 'directeur') selected @endif>Directeur</option>
                                <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
