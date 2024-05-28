<?php
$servername = "192.168.10.47";
$username = "Aquarium";
$password = "AquariumSN24";
$dbname = "bdd_aquarium";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Donnees ORDER BY created_at";
$result = $conn->query($sql);

$dates = array();
while($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
}

echo json_encode($dates);

$conn->close();
?>
