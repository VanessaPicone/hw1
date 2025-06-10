<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    removeHotel();

    function removeHotel() {
        global $dbconfig, $userid;

        error_log("POST ricevuto: " . print_r($_POST, true));
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['hotel_id']);


        $query = "SELECT * FROM hotels WHERE user_id = '$userid' AND hotel_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) === 0) {
            //hotel non presente, non rimuovo nulla
            echo json_encode(array('ok' => true));
            exit;
        }

        $query = "DELETE FROM hotels WHERE user_id = '$userid' AND hotel_id = '$id'";
        error_log($query);
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }
        

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }