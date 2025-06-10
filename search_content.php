<?php 
/*******************************************************
    Ritorna un JSON con i risultati dell'API LiteAPI
********************************************************/
require_once 'auth.php';

// Se la sessione è scaduta, esco
if (!checkAuth()) exit;

// Imposto l'header della risposta
header('Content-Type: application/json');

// Esegui la funzione
tripadvisorHotel();

function tripadvisorHotel() {

    // Inserisci qui la tua API key LiteAPI
    $apiKey = 'sand_991e1527-97db-4810-abde-dce0ee48390a';

    // Leggi i parametri GET
    $city = $_GET['city'] ?? '';
    if (!$city) {
        echo json_encode(['status' => false, 'message' => 'Parametro city mancante']);
        exit;
    }

    // Costruisci l’URL con parametri
    $url = "https://api.liteapi.travel/v3.0/data/hotels?countryCode=IT&cityName=" . urlencode($city) . "&limit=15";

    // Inizializza cURL
    $ch = curl_init($url);

    // Imposta opzioni cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "X-API-Key: $apiKey"
    ]);

    // Esegui la richiesta
    $response = curl_exec($ch);

    // Controlla errori cURL
    if (curl_errno($ch)) {
        echo json_encode(['status' => false, 'message' => 'Errore nella chiamata API: ' . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Decodifica risposta JSON
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => false, 'message' => 'Risposta API non valida']);
        exit;
    }

    // Ritorna i dati in JSON
    echo json_encode(['status' => true, 'data' => $data]);
}

