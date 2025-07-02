<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function generateText(string $prompt)
    {
        $key = env('GEMINI_API_KEY');
        $model = env('GEMINI_MODEL');

        $response = Http::post("https://generativelanguage.googleapis.com/v1/{$model}:generateContent?key={$key}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        return $response->json();
    }
}
