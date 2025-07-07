@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Mes déclarations de retard</h2>
        <a href="{{ route('retards.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle-fill me-2"></i>Nouvelle déclaration
        </a>
    </div>
    <div class="card-body">
        @if($retards->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-folder2-open fs-1"></i>
                <p class="mt-3">Vous n'avez aucune déclaration de retard pour le moment.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date du retard</th>
                            <th>Durée (minutes)</th>
                            <th>Motif</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($retards as $retard)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($retard->date_retard)->format('d/m/Y') }}</td>
                            <td>{{ $retard->duree }}</td>
                            <td>{{ Str::limit($retard->motif, 50) }}</td>
                            <td>
                                @php
                                    $statusClass = '';
                                    switch ($retard->status) {
                                        case 'en_attente': $statusClass = 'bg-warning text-dark'; break;
                                        case 'approuve': $statusClass = 'bg-success'; break;
                                        case 'refuse': $statusClass = 'bg-danger'; break;
                                        default: $statusClass = 'bg-secondary'; break;
                                    }
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $retard->status)) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('retards.show', $retard) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @if($retard->status == 'en_attente')
                                    <a href="{{ route('retards.edit', $retard) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('retards.destroy', $retard) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette déclaration ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
