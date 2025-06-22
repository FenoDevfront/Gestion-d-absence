<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retard;
use App\Models\User;

class RetardController extends Controller
{
    public function index(Request $request)
    {
        $retards = Retard::when($request->has('date'), function ($q) use ($request) {
            $q->whereDate('date_retard', $request->date);
        })
        ->with('employee')
        ->orderBy('date_retard', 'desc')
        ->paginate(10);

        return view('retards.index', compact('retards'));
    }

    public function create()
    {
        return view('retards.create');
    }

    public function store(RetardStoreRequest $request)
    {
        Retard::create($request->validated());

        return redirect()->route('retards.index')
            ->with('success', 'Retard enregistré avec succès');
    }

    public function show(Retard $retard)
    {
        return view('retards.show', compact('retard'));
    }

    public function edit(Retard $retard)
    {
        return view('retards.edit', compact('retard'));
    }

    public function update(RetardUpdateRequest $request, Retard $retard)
    {
        $retard->update($request->validated());

        return redirect()->route('retards.index')
            ->with('success', 'Retard mis à jour avec succès');
    }

    public function destroy(Retard $retard)
    {
        $retard->delete();
        return redirect()->route('retards.index')
            ->with('success', 'Retard supprimé avec succès');
    }
}
