@extends('layouts.app')

@section('title', 'Liste des Absences')

@section('content')
<h2>Liste des Absences</h2>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Motif</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($absences as $absence)
            <tr>
                <td>{{ $absence->user->name ?? 'Inconnu' }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date)->format('d/m/Y') }}</td>
                <td>{{ $absence->motif }}</td>
                <td>
                    @if ($absence->status === 'en_cours')
                        <span class="badge bg-info">En cours</span>
                    @elseif ($absence->status === 'en_attente')
                        <span class="badge bg-secondary">En attente</span>
                    @elseif ($absence->status === 'refuse')
                        <span class="badge bg-danger">Refusé</span>
                    @else
                        <span class="badge bg-light text-dark">Inconnu</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Aucune absence enregistrée.</td></tr>
        @endforelse
    </tbody>
</table>

<h4 class="mt-4">Ajouter une absence</h4>
<form action="{{ route('absences.store') }}" method="POST" class="border p-3 rounded">
    @csrf
    <div class="mb-2">
        <label>Employé (ID):</label>
        <input type="number" name="user_id" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Date:</label>
        <input type="date" name="date" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Motif:</label>
        <input type="text" name="motif" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Statut:</label>
        <select name="status" class="form-control" required>
            <option value="en_attente">En attente</option>
            <option value="en_cours">En cours</option>
            <option value="refuse">Refusé</option>
        </select>
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
@endsection
