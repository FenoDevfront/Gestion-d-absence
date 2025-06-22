@extends('layouts.app')

@section('title', 'Liste des conges')

@section('content')
<h2>Liste des Congés</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Employé</th>
            <th>Date de congé</th>
            <th>Motif</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($conges as $conge)
            <tr>
                <td>{{ $conge->user->name ?? 'Inconnu' }}</td>
                <td>{{ $conge->date_conge }}</td>
                <td>{{ $conge->motif }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Ajouter un congé</h4>
<form action="{{ route('conges.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Employé (ID):</label>
        <input type="number" name="user_id" class="form-control">
    </div>
    <div class="mb-2">
        <label>Date de congé:</label>
        <input type="date" name="date_conge" class="form-control">
    </div>
    <div class="mb-2">
        <label>Motif:</label>
        <input type="text" name="motif" class="form-control">
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
@endsection
