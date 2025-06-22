@extends('layout')

@section('content')
<h2>Liste des Retards</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Employé</th>
            <th>Date de retard</th>
            <th>Motif</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($retards as $retard)
            <tr>
                <td>{{ $retard->user->name ?? 'Inconnu' }}</td>
                <td>{{ $retard->date_retard }}</td>
                <td>{{ $retard->motif }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Ajouter un retard</h4>
<form action="{{ route('retards.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Employé (ID):</label>
        <input type="number" name="user_id" class="form-control">
    </div>
    <div class="mb-2">
        <label>Date de retard:</label>
        <input type="date" name="date_retard" class="form-control">
    </div>
    <div class="mb-2">
        <label>Motif:</label>
        <input type="text" name="motif" class="form-control">
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
@endsection
