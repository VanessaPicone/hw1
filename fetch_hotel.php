<?php 
    /*******************************************************
        Preleva gli ultimi 10 post o tutti, se ce ne sono 
        meno di 10
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    
    // Se devo mostrare contenuti a partire da un certo numero, creo la stringa della query associata
    $next = isset($_GET['from']) ? 'AND hotels.id < '.mysqli_real_escape_string($conn, $_GET['from']).' ' : '';

        // Prendo tutti i post e tutti i like che l'utente loggato ha messo ai post ritornati

        // Seleziono tutti gli attributi che mi interessano
        // (EXISTS) Mi faccio ritornare i like se ce ne sono
        // (FROM) Dall'unione tra i post e gli utenti (tutti gli utenti che hanno pubblicato post)

        $query = "SELECT id, user_id, hotel_id, content from hotels where user_id = $userid ORDER BY id DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $hotelArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        // Scorro i risultati ottenuti e creo l'elenco di post
        $hotelArray[] = array('userid' => $entry['user_id'],
                            'hotelid' => $entry['hotel_id'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($hotelArray);
    
    exit;


?>