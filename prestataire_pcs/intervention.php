<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyez les données pour éviter les injections SQL
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $debut = filter_input(INPUT_POST, 'debut', FILTER_SANITIZE_STRING);
    $fin = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_STRING);
    $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
    $no_facture = filter_input(INPUT_POST, 'no_facture', FILTER_SANITIZE_STRING);
    // Ajoutez d'autres champs ici selon votre formulaire

    // Validez les données ici (vérifiez si elles ne sont pas vides, si elles sont dans le bon format, etc.)

    // Continuez avec la connexion à la base de données et l'insertion des données
}// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root"; // Par défaut dans MAMP
$password = "root"; // Par défaut dans MAMP
$dbname = "prestataire_db";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Préparez la requête SQL d'insertion
$stmt = $conn->prepare("INSERT INTO interventions (date, debut, fin, duree, no_facture) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $date, $debut, $fin, $duree, $no_facture); // 's' pour les chaînes, 'i' pour les entiers

// Exécutez la requête préparée
if ($stmt->execute()) {
    echo "Nouvelle intervention enregistrée avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermez le statement et la connexion
$stmt->close();
$conn->close();
?>