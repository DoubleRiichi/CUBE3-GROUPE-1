<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RecommendationController extends Controller
{
    public function showForm()
    {
        // Afficher la vue pour le formulaire d'entrée du genre de film
        return view('recommendation-form');
    }

    public function recommend(Request $request)
    {
        $genre = $request->input('genre');

        // URL de l'API Hugging Face et headers requis
        $apiUrl = 'https://api-inference.huggingface.co/models/meta-llama/Meta-Llama-3-8B-Instruct';
        $headers = [
            'Authorization' => 'Bearer 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', // Remplacez YOUR_API_KEY par votre clé d'API Hugging Face valide
            'Content-Type' => 'application/json',
        ];

        // Données JSON à envoyer à l'API Hugging Face
        $requestData = [
            'inputs' => "Donne-moi quelques recommandations de films dans le genre '$genre', en français, s'il te plaît.",
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

            // Vérifier la présence des recommandations
            if (!isset($recommendations[0]['generated_text'])) {
                throw new \Exception('Aucune recommandation trouvée.');
            }

            // Récupérer les recommandations
            $recommendationText = $recommendations[0]['generated_text'];

            // Afficher la vue avec les recommandations
            return view('recommendation-result', ['recommendationText' => $recommendationText]);

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
        } catch (\Exception $e) {
            // Gérer les autres exceptions
            dd($e->getMessage());
        }
    }
}
