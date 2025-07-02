@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'absence</h1>
    <div class="card">
        <div class="card-header">
            Absence du {{ $absence->date_absence }}
        </div>
        <div class="card-body">
            <p><strong>Employé:</strong> {{ $absence->employee->name }}</p>
            <p><strong>Date:</strong> {{ $absence->date_absence }}</p>
            <p><strong>Motif:</strong> {{ $absence->motif }}</p>
            <p><strong>Statut:</strong> {{ $absence->status }}</p>
            @if($absence->justificatif)
            <p><strong>Justificatif:</strong> <a href="{{ asset('storage/' . $absence->justificatif) }}" target="_blank">Voir le justificatif</a></p>
            @endif
        </div>
    </div>
    <a href="{{ route('absences.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
