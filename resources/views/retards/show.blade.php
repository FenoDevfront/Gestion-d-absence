@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du retard</h1>
    <div class="card">
        <div class="card-header">
            Retard du {{ $retard->date_retard }}
        </div>
        <div class="card-body">
            <p><strong>Employé:</strong> {{ $retard->employee->name }}</p>
            <p><strong>Date:</strong> {{ $retard->date_retard }}</p>
            <p><strong>Durée:</strong> {{ $retard->duree }} minutes</p>
            <p><strong>Motif:</strong> {{ $retard->motif }}</p>
            <p><strong>Statut:</strong> {{ $retard->status }}</p>
        </div>
    </div>
    <a href="{{ route('retards.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
