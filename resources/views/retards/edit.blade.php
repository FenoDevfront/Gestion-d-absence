@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le retard</h1>
    <form action="{{ route('retards.update', $retard) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employé</label>
            <input type="text" class="form-control" value="{{ $retard->employee->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="date_retard">Date</label>
            <input type="date" name="date_retard" class="form-control" value="{{ $retard->date_retard }}" required>
        </div>
        <div class="form-group">
            <label for="duree">Durée (minutes)</label>
            <input type="number" name="duree" class="form-control" value="{{ $retard->duree }}" required>
        </div>
        <div class="form-group">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control" required>{{ $retard->motif }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" class="form-control">
                <option value="en_attente" @if($retard->status == 'en_attente') selected @endif>En attente</option>
                <option value="validee" @if($retard->status == 'validee') selected @endif>Validée</option>
                <option value="rejetee" @if($retard->status == 'rejetee') selected @endif>Rejetée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
