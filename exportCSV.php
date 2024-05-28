<?php
$servername = "192.168.10.47";
$username = "Aquarium";
$password = "AquariumSN24";
$dbname = "bdd_aquarium";

$date = $_GET['date'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=data_' . $date . '.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID'; 'Date'; 'Temperature'; 'pH'; 'Nitrate'));

$sql = "SELECT * FROM Donnees WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>
