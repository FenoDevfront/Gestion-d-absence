@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="h4 mb-0">Faire une demande de congé</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('conges.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="motif" class="form-label">Motif de la demande</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                        <textarea name="motif" id="motif" class="form-control" rows="4" placeholder="Expliquez brièvement le motif de votre demande de congé..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('conges.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
            </div>
        </form>
    </div>
</div>
@endsection
