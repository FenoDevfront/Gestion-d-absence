@extends('layouts.app')

@section('content')
<style>
    .card.border-left-primary { border-left: .25rem solid #4e73df !important; }
    .card.border-left-success { border-left: .25rem solid #1cc88a !important; }
    .card.border-left-info { border-left: .25rem solid #36b9cc !important; }
    .card.border-left-warning { border-left: .25rem solid #f6c23e !important; }
    .text-xs { font-size: .7rem; }
    .text-gray-300 { color: #dddfeb !important; }
    .text-gray-800 { color: #5a5c69 !important; }
    .font-weight-bold { font-weight: 700 !important; }
    .shadow { box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15) !important; }
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="bi bi-download me-2"></i>Générer un rapport</a>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Congés en cours</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['conges']['en_cours'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-check fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Absences en cours</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['absences']['en_cours'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-x fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total des retards</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $stats['retards']['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone de graphique -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Évaluation mensuelle des demandes</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Listes des demandes récentes -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers congés en cours</h6>
                    <a href="{{ route('conges.create') }}" class="btn btn-primary btn-sm">Nouvelle demande</a>
                </div>
                <div class="card-body">
                    @forelse ($recentConges as $conge)
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <div>
                                <strong>{{ $conge->user->name ?? 'Utilisateur inconnu' }}</strong><br>
                                <small class="text-muted">Du {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge bg-primary text-white rounded-pill">{{ $conge->status }}</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-folder2-open fs-1"></i>
                            <p class="mt-2">Aucun congé en cours.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dernières absences en cours</h6>
                    <a href="{{ route('absences.create') }}" class="btn btn-primary btn-sm">Nouvelle justification</a>
                </div>
                <div class="card-body">
                    @forelse ($recentAbsences as $absence)
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                             <div>
                                <strong>{{ $absence->user->name ?? 'Utilisateur inconnu' }}</strong><br>
                                <small class="text-muted">Date : {{ \Carbon\Carbon::parse($absence->date)->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge bg-success text-white rounded-pill">{{ $absence->status }}</span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-folder2-open fs-1"></i>
                            <p class="mt-2">Aucune absence en cours.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Données du graphique (à remplacer par les données réelles du backend)
        const chartData = {!! json_encode($chartData) !!};

        const ctx = document.getElementById('myAreaChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Congés',
                    data: chartData.conges,
                    backgroundColor: 'rgba(78, 115, 223, 0.5)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }, {
                    label: 'Absences',
                    data: chartData.absences,
                    backgroundColor: 'rgba(28, 200, 138, 0.5)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 1
                }, {
                    label: 'Retards',
                    data: chartData.retards,
                    backgroundColor: 'rgba(246, 194, 62, 0.5)',
                    borderColor: 'rgba(246, 194, 62, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
