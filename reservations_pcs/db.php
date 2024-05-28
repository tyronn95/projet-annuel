<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "reservations_db";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
?>