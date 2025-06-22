<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $clientId = env('GOOGLE_CLIENT_ID');
        $redirectUri = env('GOOGLE_REDIRECT_URI');
        $scope = 'email profile';

        return redirect("https://accounts.google.com/o/oauth2/auth?client_id=$clientId&redirect_uri=$redirectUri&response_type=code&scope=$scope");
    }

    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');

        if (!$code) {
            return redirect('/')->withErrors(['error' => 'Code Google manquant']);
        }

        // Récupère le token d'accès
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        $tokens = $response->json();

        if (isset($tokens['access_token'])) {
            $userData = $this->getUserData($tokens['access_token']);
            $user = $this->findOrCreateUser($userData);
            Auth::login($user);
            return redirect('/');  // redirect vers la home
        }

        return redirect('/')->withErrors(['error' => 'Authentification Google échouée']);
    }

    private function getUserData($accessToken)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://www.googleapis.com/oauth2/v3/userinfo');

        return $response->json();
    }

    private function findOrCreateUser($data)
    {
        // Cherche utilisateur existant par google_id ou email
        $user = User::where('google_id', $data['sub'])
                    ->orWhere('email', $data['email'])
                    ->first();

        if ($user) {
            // Si l'utilisateur existe mais n'a pas google_id, on l'ajoute
            if (!$user->google_id) {
                $user->google_id = $data['sub'];
                $user->save();
            }
            return $user;
        }

        // Sinon crée un nouvel utilisateur
        return User::create([
            'google_id' => $data['sub'],
            'name' => $data['name'],
            'email' => $data['email'],
            'picture_url' => $data['picture'] ?? null,
            'password' => bcrypt(str()->random(16)), // mot de passe factice
        ]);
    }
}
