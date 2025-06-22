@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container my-4">

    <h1 class="mb-4 text-center">Tableau de bord de gestion du personnel</h1>

    {{-- Statistiques --}}
    <div class="row mb-5">
        @foreach (['conges', 'absences', 'retards'] as $type)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white text-center 
                        @if($type == 'conges') bg-success 
                        @elseif($type == 'absences') bg-primary 
                        @else bg-warning @endif">
                        {{ ucfirst($type) }}
                    </div>
                    <div class="card-body">
                        <p><strong>Total:</strong> {{ $stats[$type]['total'] }}</p>
                        <p><span class="badge bg-info">En cours: {{ $stats[$type]['en_cours'] }}</span></p>
                        <p><span class="badge bg-secondary">En attente: {{ $stats[$type]['en_attente'] }}</span></p>
                        <p><span class="badge bg-danger">Refusé: {{ $stats[$type]['refuse'] }}</span></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Listes récentes --}}

    <div class="row">
        {{-- Congés --}}
        <div class="col-md-4 mb-4">
            <h3>Congés en cours</h3>
            @if($recentConges->isEmpty())
                <p>Aucun congé en cours.</p>
            @else
                <ul class="list-group">
                    @foreach($recentConges as $conge)
                        <li class="list-group-item">
                            <strong>{{ $conge->user->name ?? 'Utilisateur' }}</strong><br>
                            Du {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Absences --}}
        <div class="col-md-4 mb-4">
            <h3>Absences en cours</h3>
            @if($recentAbsences->isEmpty())
                <p>Aucune absence en cours.</p>
            @else
                <ul class="list-group">
                    @foreach($recentAbsences as $absence)
                        <li class="list-group-item">
                            <strong>{{ $absence->user->name ?? 'Utilisateur' }}</strong><br>
                            Date : {{ \Carbon\Carbon::parse($absence->date)->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Retards --}}
        <div class="col-md-4 mb-4">
            <h3>Retards en cours</h3>
            @if($recentRetards->isEmpty())
                <p>Aucun retard en cours.</p>
            @else
                <ul class="list-group">
                    @foreach($recentRetards as $retard)
                        <li class="list-group-item">
                            <strong>{{ $retard->user->name ?? 'Utilisateur' }}</strong><br>
                            Date : {{ \Carbon\Carbon::parse($retard->date)->format('d/m/Y') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection