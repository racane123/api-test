<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'testdb';
$port = 3308;



$conn = new mysqli($host, $username, $password, $dbname,$port);

if ($conn->connect_error) {
    die('Connect Error ('.mysqli_connect_error());
}

//echo "connection Established";