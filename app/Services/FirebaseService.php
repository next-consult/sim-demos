<?php
namespace App\Services;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class FirebaseService
{
    public function getAccessToken()
    {
        $serviceAccount = json_decode(file_get_contents(storage_path('app/sim-next-firebase-adminsdk-r027d-b17247ef77.json')), true);

    $now_seconds = time();
    $payload = array(
        "iss" => $serviceAccount['client_email'],
        "sub" => $serviceAccount['client_email'],
        "aud" => "https://oauth2.googleapis.com/token",
        "iat" => $now_seconds,
        "exp" => $now_seconds + 3600, // Token expire in 1 hour
        "scope" => "https://www.googleapis.com/auth/cloud-platform https://www.googleapis.com/auth/firebase.messaging"
    );

    $jwt = JWT::encode($payload, $serviceAccount['private_key'], 'RS256');

    // Obtenir le token d'accès OAuth 2.0
    $client = new Client();
    $response = $client->post('https://oauth2.googleapis.com/token', [
        'form_params' => [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    return $data['access_token'];
    }

    // Vous pouvez ajouter ici d'autres méthodes liées à Firebase
}
