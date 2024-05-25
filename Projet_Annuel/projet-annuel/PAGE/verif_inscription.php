<?php
session_start();
require_once '../GLOBAL/db/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification et assainissement des entrées
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nom = $conn->real_escape_string(trim($_POST['lastName']));
    $prenom = $conn->real_escape_string(trim($_POST['firstName']));
    $password = $_POST['password']; 
    $telephone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $type = isset($_POST['type']) ? (int)$_POST['type'] : 0; // Cast en entier pour sécurité

    // Validation des données
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'adresse email est invalide.");
    }
    if (!in_array($type, [1, 2, 3])) {
        die("Type de compte invalide.");
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparation de la requête SQL
    $stmt = $conn->prepare("INSERT INTO user (email, nom, prenom, password, ban, telephone, type) VALUES (?, ?, ?, ?, 0, ?, ?)");
    $stmt->bind_param("ssssii", $email, $nom, $prenom, $hashed_password, $telephone, $type);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
