@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'absence</h1>
    <form action="{{ route('absences.update', $absence) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employé</label>
            <input type="text" class="form-control" value="{{ $absence->employee->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="date_absence">Date</label>
            <input type="date" name="date_absence" class="form-control" value="{{ $absence->date_absence }}" required>
        </div>
        <div class="form-group">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control" required>{{ $absence->motif }}</textarea>
        </div>
        <div class="form-group">
            <label for="justificatif">Justificatif</label>
            <input type="file" name="justificatif" class="form-control">
            @if($absence->justificatif)
            <a href="{{ asset('storage/' . $absence->justificatif) }}" target="_blank">Voir le justificatif</a>
            @endif
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" class="form-control">
                <option value="en_attente" @if($absence->status == 'en_attente') selected @endif>En attente</option>
                <option value="validee" @if($absence->status == 'validee') selected @endif>Validée</option>
                <option value="rejetee" @if($absence->status == 'rejetee') selected @endif>Rejetée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
