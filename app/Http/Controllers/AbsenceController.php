<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\User;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        $absences = Absence::when($request->has('date'), function ($q) use ($request) {
            $q->whereDate('date_absence', $request->date);
        })
        ->with('employee')
        ->orderBy('date_absence', 'desc')
        ->paginate(10);

        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        return view('absences.create');
    }

    public function store(AbsenceStoreRequest $request)
    {
        Absence::create($request->validated());

        return redirect()->route('absences.index')
            ->with('success', 'Absence enregistrée avec succès');
    }

    public function show(Absence $absence)
    {
        return view('absences.show', compact('absence'));
    }

    public function edit(Absence $absence)
    {
        return view('absences.edit', compact('absence'));
    }

    public function update(AbsenceUpdateRequest $request, Absence $absence)
    {
        $absence->update($request->validated());

        return redirect()->route('absences.index')
            ->with('success', 'Absence mise à jour avec succès');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('absences.index')
            ->with('success', 'Absence supprimée avec succès');
    }
}
