@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du congé</h1>
    <div class="card">
        <div class="card-header">
            Congé du {{ $conge->date_debut }} au {{ $conge->date_fin }}
        </div>
        <div class="card-body">
            <p><strong>Employé:</strong> {{ $conge->employee->name }}</p>
            <p><strong>Date de début:</strong> {{ $conge->date_debut }}</p>
            <p><strong>Date de fin:</strong> {{ $conge->date_fin }}</p>
            <p><strong>Motif:</strong> {{ $conge->motif }}</p>
            <p><strong>Statut:</strong> {{ $conge->status }}</p>
        </div>
    </div>
    <a href="{{ route('conges.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
