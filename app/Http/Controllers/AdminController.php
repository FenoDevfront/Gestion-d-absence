<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:employe,superviseur,rh,directeur,admin',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour avec succès.');
    }
}
