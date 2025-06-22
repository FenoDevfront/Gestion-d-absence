<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // <- Import du modèle User

class UserController extends Controller
{
    public function autocomplete(Request $request)
    {
        $term = $request->get('term');

        $users = User::where('email', 'LIKE', "%{$term}%")
                    ->orWhere('name', 'LIKE', "%{$term}%")
                    ->take(10)
                    ->get();

        $result = $users->map(function($user) {
            return [
                'id' => $user->id,
                'label' => "{$user->name} ({$user->email})",
            ];
        });

        return response()->json($result);
    }
}
