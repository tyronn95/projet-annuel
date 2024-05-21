<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root"; 
$password = "root";
$dbname = "pcs"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['resultat'])) {
    $number = $data['resultat'];
    $stmt = $conn->prepare("INSERT INTO services (cout) VALUES (?)");
    $stmt->bind_param("i", $number);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Cout sauvegarder"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid input"));
}

$conn->close();
?>