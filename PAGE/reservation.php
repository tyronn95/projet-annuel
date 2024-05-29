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

if($nom == "maintenance/réparation"){
    $cout = 0;
}else if($nom == "tarification dynamique"){
    $cout = 40;
}

$sql = "INSERT INTO SERVICES (email, nom, cout) VALUES ('$username', '$nom', $cout)";

if ($conn->query($sql) === TRUE) {
    echo "Service ajouté avec succès !";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>