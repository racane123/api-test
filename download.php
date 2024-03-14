<?php
// Database connection
include('dbconn.php');
$id = $_GET["id"];
$sql = "SELECT file_name FROM owner_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$filePath = $row["file_name"];

// Download the file
if (file_exists($filePath)) {
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . basename($filePath));
    readfile($filePath);
} else {
    echo "File not found.";
}

$stmt->close();
$conn->close();
?>
