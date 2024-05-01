<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "prestataire_db";
$port = 8889;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
    $debut = htmlspecialchars($_POST['debut'], ENT_QUOTES, 'UTF-8');
    $fin = htmlspecialchars($_POST['fin'], ENT_QUOTES, 'UTF-8');
    $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
    $no_facture = htmlspecialchars($_POST['no_facture'], ENT_QUOTES, 'UTF-8');
    $no_client = filter_input(INPUT_POST, 'no_client', FILTER_SANITIZE_NUMBER_INT);
    $objet = htmlspecialchars($_POST['objet'], ENT_QUOTES, 'UTF-8');

    if (empty($no_client) || !is_numeric($no_client)) {
        echo "Erreur : Le numéro du client doit être un entier non vide.";
    } else {
        $stmt = $conn->prepare("INSERT INTO interventions (date, debut, fin, duree, no_facture, no_client, objet) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiiss", $date, $debut, $fin, $duree, $no_facture, $no_client, $objet);
        if ($stmt->execute()) {
            $last_id = $conn->insert_id;
            header("Location: view_intervention.php?id=$last_id"); // Redirection sécurisée
            exit;
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>