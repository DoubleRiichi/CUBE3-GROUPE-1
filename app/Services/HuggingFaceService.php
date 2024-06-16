<?php

// App\Http\Controllers\RecommendationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        $genre = $request->input('genre');

        // URL de l'API Hugging Face et headers requis
        $apiUrl = 'https://api-inference.huggingface.co/models/meta-llama/Meta-Llama-3-8B-Instruct';
        $headers = [
            'Authorization' => 'Bearer YOUR_API_KEY', // Remplacez YOUR_API_KEY par votre clé d'API Hugging Face valide
            'Content-Type' => 'application/json',
        ];

        // Données JSON à envoyer à l'API Hugging Face
        $requestData = [
            'inputs' => [
                'prompt' => "Voici quelques films dans le genre '$genre':...",
                'parameters' => [
                    'genre' => $genre,
                ],
            ],
        ];

        try {
            // Effectuer la requête POST à l'API Hugging Face
            $client = new Client();
            $response = $client->post($apiUrl, [
                'headers' => $headers,
                'json' => $requestData,
            ]);

            // Décoder la réponse JSON
            $recommendations = json_decode($response->getBody()->getContents(), true);

            // Valider les recommandations
            if (!isset($recommendations['outputs']) || !isset($recommendations['outputs']['text'])) {
                throw new \Exception('Aucune recommandation trouvée.');
            }

            // Récupérer les films recommandés
            $movies = $recommendations['outputs']['text'];

            // Afficher la vue avec les recommandations
            return view('recommendation-result', compact('movies'));

        } catch (RequestException $e) {
            // Capturer et gérer les exceptions de requête HTTP
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse();
                $errorMessage = $errorResponse->getBody()->getContents();
                // Logguer ou afficher l'erreur pour le débogage
                dd($errorMessage);
            } else {
                dd('Erreur inconnue lors de la requête à l\'API Hugging Face.');
            }
        }
    }
}
