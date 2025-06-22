<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        // ... (code existant pour la validation du token)

        if (isset($tokens['access_token'])) {
            $accessToken = $tokens['access_token'];
            $userData = $this->getUserData($accessToken);
            $user = $this->findOrCreateUser($userData);
            
            auth()->login($user);
            
            // Redirection vers la page d'accueil après authentification
            return redirect()->intended('/home');
        }
    }

    private function getUserData($accessToken)
    {
        $response = Http::get('https://www.googleapis.com/oauth2/v3/userinfo', [
            'access_token' => $accessToken,
        ]);
        return $response->json();
    }

    private function findOrCreateUser($userData)
    {
        $user = \App\Models\User::where('google_id', $userData['sub'])->first();

        if (!$user) {
            $user = \App\Models\User::create([
                'google_id' => $userData['sub'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'picture_url' => $userData['picture'] ?? null,
            ]);
        }

        return $user;
    }
}