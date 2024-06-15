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
            $response = $huggingFaceService->getRecommendation($prompt);
            $recommendation = $response[0]['generated_text'] ?? 'No recommendation available';
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return view('recommend', [
            'movies' => $movies,
            'recommendation' => $recommendation,
        ]);
    }
}
