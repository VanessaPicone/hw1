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
cambioValuta();

function cambioValuta() {

    // Inserisci qui la tua API key LiteAPI
    $apiKey = '99101e1963ea4107e10a78a1';

    // Leggi i parametri GET
    $city = $_GET['valuta'] ?? '';
    if (!$city) {
        echo json_encode(['status' => false, 'message' => 'Parametro valuta mancante']);
        exit;
    }

    // Costruisci l’URL con parametri
    $url = "https://v6.exchangerate-api.com/v6/$apiKey/latest/EUR";

    // Inizializza cURL
    $ch = curl_init($url);

    // Imposta opzioni cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    

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

