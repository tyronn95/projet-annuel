<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pcs";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$username = $_SESSION['username'];
$nom = $_POST['service'];

$sql = "INSERT INTO SERVICES (email, nom) VALUES ('$username', '$nom')";

if ($conn->query($sql) === TRUE) {
    echo "Service ajouté avec succès !";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>