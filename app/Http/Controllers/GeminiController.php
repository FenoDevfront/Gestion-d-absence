<?php

// app/Http/Controllers/GeminiController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function test()
    {
        $key = env('GEMINI_API_KEY');
        $model = env('GEMINI_MODEL');

        $response = Http::post("https://generativelanguage.googleapis.com/v1/{$model}:generateContent?key={$key}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => 'Hello Gemini from Laravel']
                    ]
                ]
            ]
        ]);
        
        $response = $gemini->generateText('Bonjour Gemini depuis Laravel Service');
        return response()->json($response);

        return response()->json($response->json());
    }
}

