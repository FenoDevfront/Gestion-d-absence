@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="h4 mb-0">Déclarer un retard</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('retards.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="date_retard" class="form-label">Date du retard</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-day"></i></span>
                        <input type="date" name="date_retard" id="date_retard" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="duree" class="form-label">Durée du retard (en minutes)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                        <input type="number" name="duree" id="duree" class="form-control" placeholder="Ex: 30" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="motif" class="form-label">Motif du retard</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                        <textarea name="motif" id="motif" class="form-control" rows="4" placeholder="Expliquez brièvement le motif de votre retard..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('retards.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Déclarer le retard</button>
            </div>
        </form>
    </div>
</div>
@endsection
