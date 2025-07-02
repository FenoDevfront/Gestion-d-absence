@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des retards</h1>
    <a href="{{ route('retards.create') }}" class="btn btn-primary">Nouveau retard</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Date</th>
                <th>Durée (minutes)</th>
                <th>Motif</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($retards as $retard)
            <tr>
                <td>{{ $retard->employee->name }}</td>
                <td>{{ $retard->date_retard }}</td>
                <td>{{ $retard->duree }}</td>
                <td>{{ $retard->motif }}</td>
                <td>{{ $retard->status }}</td>
                <td>
                    <a href="{{ route('retards.show', $retard) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('retards.edit', $retard) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('retards.destroy', $retard) }}" method="POST" style="display:inline;">
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