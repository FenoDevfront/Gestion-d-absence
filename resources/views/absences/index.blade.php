@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des absences</h1>
    <a href="{{ route('absences.create') }}" class="btn btn-primary">Nouvelle absence</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Date</th>
                <th>Motif</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absences as $absence)
            <tr>
                <td>{{ $absence->employee->name }}</td>
                <td>{{ $absence->date_absence }}</td>
                <td>{{ $absence->motif }}</td>
                <td>{{ $absence->status }}</td>
                <td>
                    <a href="{{ route('absences.show', $absence) }}" class="btn btn-info">Voir</a>
                    <a href="{{ route('absences.edit', $absence) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('absences.destroy', $absence) }}" method="POST" style="display:inline;">
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