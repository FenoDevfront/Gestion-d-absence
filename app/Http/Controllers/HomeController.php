<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Absence;
use App\Models\Retard;

class HomeController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $stats = [
            'conges' => [
                'total' => Conge::count(),
                'en_cours' => Conge::where('status', 'en_cours')->count(),
                'en_attente' => Conge::where('status', 'en_attente')->count(),
                'refuse' => Conge::where('status', 'refuse')->count(),
            ],
            'absences' => [
                'total' => Absence::count(),
                'en_cours' => Absence::where('status', 'en_cours')->count(),
                'en_attente' => Absence::where('status', 'en_attente')->count(),
                'refuse' => Absence::where('status', 'refuse')->count(),
            ],
            'retards' => [
                'total' => Retard::count(),
                'en_cours' => Retard::where('status', 'en_cours')->count(),
                'en_attente' => Retard::where('status', 'en_attente')->count(),
                'refuse' => Retard::where('status', 'refuse')->count(),
            ],
        ];

        // Listes récentes (par exemple les 5 derniers congés/absences/retards en cours)
        $recentConges = Conge::where('status', 'en_cours')->latest()->limit(5)->get();
        $recentAbsences = Absence::where('status', 'en_cours')->latest()->limit(5)->get();
        $recentRetards = Retard::where('status', 'en_cours')->latest()->limit(5)->get();

        return view('home', compact('stats', 'recentConges', 'recentAbsences', 'recentRetards'));
    }
}
