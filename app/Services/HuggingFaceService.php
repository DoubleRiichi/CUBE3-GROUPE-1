<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HuggingFaceService
{
    public function getRecommendation($prompt)
    {
        $apiKey = env('HUGGINGFACE_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api-inference.huggingface.co/models/meta-llama/Meta-Llama-3-8B-Instruct', [
            'inputs' => $prompt,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch recommendation: ' . $response->body());
        }

        // Afficher la réponse brute pour vérifier sa structure
        return $response->json();
    }
}
