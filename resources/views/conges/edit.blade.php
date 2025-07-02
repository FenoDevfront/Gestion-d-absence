@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le congé</h1>
    <form action="{{ route('conges.update', $conge) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employé</label>
            <input type="text" class="form-control" value="{{ $conge->employee->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" class="form-control" value="{{ $conge->date_debut }}" required>
        </div>
        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" class="form-control" value="{{ $conge->date_fin }}" required>
        </div>
        <div class="form-group">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control" required>{{ $conge->motif }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" class="form-control">
                <option value="en_attente" @if($conge->status == 'en_attente') selected @endif>En attente</option>
                <option value="validee" @if($conge->status == 'validee') selected @endif>Validée</option>
                <option value="rejetee" @if($conge->status == 'rejetee') selected @endif>Rejetée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
