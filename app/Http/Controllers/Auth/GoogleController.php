<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // ✅ OBLIGATOIRE !
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
        $code = $request->get('code');

        if (!$code) {
            return redirect('/')->withErrors(['error' => 'Code Google manquant']);
        }

        // ⚙️ Échange le code contre un token d'accès
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        $tokens = $response->json();

        if (isset($tokens['access_token'])) {
            $accessToken = $tokens['access_token'];
            $userData = $this->getUserData($accessToken);
            $user = $this->findOrCreateUser($userData);
            
            auth()->login($user);
            
            return redirect()->intended('/');
        }

        return redirect('/')->withErrors(['error' => 'Authentification Google échouée']);
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
