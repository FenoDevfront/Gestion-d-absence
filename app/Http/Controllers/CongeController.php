<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\User;

class CongeController extends Controller
{
    public function index(Request $request)
    {
        $conges = Conge::when($request->has('date'), function ($q) use ($request) {
            $q->whereDate('date_conge', $request->date);
        })
        ->with('employee')
        ->orderBy('date_conge', 'desc')
        ->paginate(10);

        return view('conges.index', compact('conges'));
    }

    public function create()
    {
        return view('conges.create');
    }

    public function store(CongeStoreRequest $request)
    {
        Conge::create($request->validated());

        return redirect()->route('conges.index')
            ->with('success', 'Congé enregistré avec succès');
    }

    public function show(Conge $conge)
    {
        return view('conges.show', compact('conge'));
    }

    public function edit(Conge $conge)
    {
        return view('conges.edit', compact('conge'));
    }

    public function update(CongeUpdateRequest $request, Conge $conge)
    {
        $conge->update($request->validated());

        return redirect()->route('conges.index')
            ->with('success', 'Congé mis à jour avec succès');
    }

    public function destroy(Conge $conge)
    {
        $conge->delete();
        return redirect()->route('conges.index')
            ->with('success', 'Congé supprimé avec succès');
    }
}
