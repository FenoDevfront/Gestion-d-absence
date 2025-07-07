<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Absence;
use App\Models\Retard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $stats = [
            'conges' => [
                'en_cours' => Conge::where('status', 'en_cours')->count(),
            ],
            'absences' => [
                'en_cours' => Absence::where('status', 'en_cours')->count(),
            ],
            'retards' => [
                'total' => Retard::count(), // Gardons le total pour les retards
            ],
        ];

        // Listes des demandes en attente/en cours
        $recentConges = Conge::with('user')->where('status', 'en_cours')->latest()->limit(5)->get();
        $recentAbsences = Absence::with('user')->where('status', 'en_cours')->latest()->limit(5)->get();

        // Données pour le graphique
        $chartData = $this->getChartData();

        return view('home', compact('stats', 'recentConges', 'recentAbsences', 'chartData'));
    }

    private function getChartData()
    {
        $months = [];
        $congesData = [];
        $absencesData = [];
        $retardsData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('F');
            $months[] = $monthName;

            $congesData[] = Conge::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
            $absencesData[] = Absence::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
            $retardsData[] = Retard::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
        }

        return [
            'labels' => $months,
            'conges' => $congesData,
            'absences' => $absencesData,
            'retards' => $retardsData,
        ];
    }
}
