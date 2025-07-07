<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Absence;
use App\Models\Conge;
use Carbon\Carbon;

class UpdateStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mettre à jour le statut des absences et congés validés à "en_cours" si la date de début est atteinte.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Mettre à jour les absences
        $absences = Absence::where('status', 'validee')
                           ->where('date_debut', '<=', $today)
                           ->get();

        foreach ($absences as $absence) {
            $absence->status = 'en_cours';
            $absence->save();
        }

        // Mettre à jour les congés
        $conges = Conge::where('status', 'validee')
                         ->where('date_debut', '<=', $today)
                         ->get();

        foreach ($conges as $conge) {
            $conge->status = 'en_cours';
            $conge->save();
        }

        $this->info('Les statuts des absences et congés ont été mis à jour avec succès.');
    }
}