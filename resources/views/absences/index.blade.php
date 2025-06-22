@extends('layouts.app')

@section('title', 'Liste des Absences')

@section('content')
<h2>Liste des Absences</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Motif</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absences as $absence)
            <tr>
                <td>{{ $absence->user->name ?? 'Inconnu' }}</td>
                <td>{{ $absence->date }}</td>
                <td>{{ $absence->motif }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Ajouter une absence</h4>
<form action="{{ route('absences.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Employé (ID):</label>
        <input type="number" name="user_id" class="form-control">
    </div>
    <div class="mb-2">
        <label>Date:</label>
        <input type="date" name="date" class="form-control">
    </div>
    <div class="mb-2">
        <label>Motif:</label>
        <input type="text" name="motif" class="form-control">
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
@endsection
