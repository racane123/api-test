<?php
include('dbconn.php');
$sql = "SELECT * FROM owner_info";
$result = $conn->query($sql);

// Display the table
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Owner's Name</th>
            <th>Address</th>
            <th>File</th>
            <th>Action</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["owner_name"] . "</td>
            <td>" . $row["address"] . "</td>
            <td>" . $row["file_name"] . "</td>
            <td><a href='download.php?id=" . $row["id"] . "'>Download</a></td>
        </tr>";
}
echo "</table>";

$conn->close();
?>