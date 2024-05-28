<?php
$servername = "192.168.10.47"; //voir pour l'adresse ip
$username = "Aquarium"; 
$password = "AquariumSN24";
$dbname = "bdd_aquarium"; 

$date = $_GET['date'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Donnees WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
