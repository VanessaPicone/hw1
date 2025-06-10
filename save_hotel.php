<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    addHotel();

    function addHotel() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "SELECT * FROM hotels WHERE user_id = '$userid' AND hotel_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        $query = "INSERT INTO hotels(user_id, hotel_id, content) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'name', '$name', 'rating', '$rating', 'address', '$address', 'image', '$image'))";
        error_log($query);
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }