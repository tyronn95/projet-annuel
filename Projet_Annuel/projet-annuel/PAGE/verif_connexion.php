<?php
// Démarrer ou reprendre une session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le script de connexion à la base de données
require_once '../GLOBAL/db/db_config.php';

// Fonction pour vérifier la complexité du mot de passe
function isPasswordStrong($password) {
    // Vérifie la longueur du mot de passe
    if (strlen($password) < 8) {
        return false;
    }

    // Vérifie la présence d'au moins un chiffre
    if (!preg_match('/\d/', $password)) {
        return false;
    }

    // Vérifie la présence d'au moins une lettre majuscule
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Vérifie la présence d'au moins une lettre minuscule
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Vérifie la présence d'au moins un caractère spécial
    if (!preg_match('/[^a-zA-Z\d]/', $password)) {
        return false;
    }

    return true;
}


// Vérifier que les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer et valider les entrées
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Gérer l'erreur si l'email n'est pas valide
        exit('Adresse email invalide.');
    }

    echo "Mot de passe reçu : '$password'<br>";
if (!isPasswordStrong($password)) {
    exit('Mot de passe pas assez sécurisé.');
}


    // Préparer la requête SQL pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT id, password, type FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Exécuter la requête
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $type);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $type;

            switch ($type) {
                case 0:
                    header("location: ../ADMIN/admin.php");
                    exit;
                case 1:
                    header("location: ../VOYAGEUR/voyageur.php");
                    exit;
                case 2:
                    header("location: ../PRESTATAIRE/calendar_presta.php");
                    exit;
                case 3:
                    header("location: ../BAILLEUR/calendrier_bailleur.php");
                    exit;
            }
        } else {
            // Gérer l'erreur si le mot de passe est incorrect
            exit('Le mot de passe est incorrect.');
        }
    } else {
        // Gérer l'erreur si le nom d'utilisateur n'existe pas
        exit('Aucun utilisateur trouvé avec cet email.');
    }

    $stmt->close();
}

$conn->close();
?>
