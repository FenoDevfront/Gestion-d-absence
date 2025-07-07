@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="h4 mb-0">Justifier une absence</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('absences.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="date_absence" class="form-label">Date de l'absence</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-day"></i></span>
                        <input type="date" name="date_absence" id="date_absence" class="form-control" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="motif" class="form-label">Motif de l'absence</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                        <textarea name="motif" id="motif" class="form-control" rows="4" placeholder="Expliquez brièvement le motif de votre absence..." required></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <label for="justificatif" class="form-label">Justificatif (optionnel)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-paperclip"></i></span>
                        <input type="file" name="justificatif" id="justificatif" class="form-control">
                    </div>
                    <div class="form-text">
                        Vous pouvez joindre un certificat médical ou tout autre document pertinent.
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('absences.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Soumettre la justification</button>
            </div>
        </form>
    </div>
</div>
@endsection
