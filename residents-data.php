<?php

require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $sql = "SELECT * FROM users";

    $results = mysqli_query($conn,$sql);


    $row = mysqli_fetch_array($results);

    echo json_encode($row);
}




