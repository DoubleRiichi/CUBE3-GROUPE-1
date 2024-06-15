<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Services\HuggingFaceService;

class RecommendationController extends Controller
{
    public function recommend()
    {
        $movies = Movie::inRandomOrder()->limit(5)->get();
        $movieTitles = $movies->pluck('title')->toArray();
        $prompt = "Here are some movie titles: " . implode(', ', $movieTitles) . ". Can you recommend a movie based on these?";

        try {
            $huggingFaceService = new HuggingFaceService();
            $recommendation = $huggingFaceService->getRecommendation($prompt);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // Passer la réponse brute à la vue
        return view('recommend', [
            'movies' => $movies,
            'recommendation' => $recommendation,
        ]);
    }
}
