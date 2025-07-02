@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des congés</h1>
    <a href="{{ route('conges.create') }}" class="btn btn-primary">Nouveau congé</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Motif</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conges as $conge)
            <tr>
                <td>{{ $conge->employee->name }}</td>
                <td>{{ $conge->date_debut }}</td>
                <td>{{ $conge->date_fin }}</td>
                <td>{{ $conge->motif }}</td>
                <td>{{ $conge->status }}</td>
                <td>
                    <a href="{{ route('conges.show', $conge) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('conges.edit', $conge) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('conges.destroy', $conge) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection