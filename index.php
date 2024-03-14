<?php
// Database connection configuration
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $ownerName = $_POST["owner_name"];
        $address = $_POST["address"];

        $targetDirectory = "uploads/"; // Directory where the file will be uploaded
        $targetFile = $targetDirectory . basename($_FILES["file"]["name"]); // Path of the uploaded file

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "File already exists.";
        } else {
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                // File uploaded successfully, perform further actions if needed

                // Prepare and execute the SQL statement to insert data into the database
                $sql = "INSERT INTO owner_info (owner_name, address, file_name) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $ownerName, $address, $targetFile);
                $stmt->execute();

                $stmt->close();
                $conn->close();

                echo "File uploaded successfully and data stored in the database.";
            } else {
                echo "Error uploading file.";
            }
        }
    } else {
        echo "Error: " . $_FILES["file"]["error"];
    }
}
?>

<!-- HTML form to upload a file -->
<form method="POST" enctype="multipart/form-data">
    <label for="owner_name">Owner Name:</label>
    <input type="text" name="owner_name" id="owner_name"><br>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address"><br>

    <input type="file" name="file"><br>

    <input type="submit" value="Upload">
</form>