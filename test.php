<?php
include('dbconn.php');

$sql = "SELECT * FROM owner_info";
$result = $conn->query($sql);

// Prepare the data in an array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as JSON
header("Content-Type: application/json");
echo json_encode($data);


?>