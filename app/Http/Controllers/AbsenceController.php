<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\User;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('user')->get();
        $users = User::all();
        return view('absences.index', compact('absences', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
        ]);

        Absence::create($request->all());

        return redirect()->route('absences.index');
    }
}
