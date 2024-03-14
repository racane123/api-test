<?php
include("dbconn.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = $_POST["owner_name"];
    $address = $_POST["address"];
    $file_name = $_FILES["file"]["name"];
    $file_data = file_get_contents($_FILES["file"]["tmp_name"]);

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO owner_info (owner_name, address, file_name, file_data) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssb", $owner_name, $address, $file_name, $file_data);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "<script>alert(New record created successfully)</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
