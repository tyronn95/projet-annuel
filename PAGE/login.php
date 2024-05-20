<?php
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "PCS";
// $conn = new mysqli($servername, $username, $password, $dbname);

include('BDDLocal.php');

$username = $_POST['username'];
$password = $_POST['password'];

// Requête pour vérifier si le compte existe dans la base de données
$query = $bdd->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
//echo "Siuuuuu";
$query->execute(array($username, $password));
$user = $query->fetch();

if ($user) {
    // Compte trouvé, connexion réussie
    echo "Connexion réussie ! Bienvenue, ".$user['username'];
    session_start();
    $_SESSION['username'] = $user['username'];
} else {
    // Compte non trouvé, connexion échouée
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

if ($user) {
    $role = $user['role'];
    
    if ($role === 0) {
        header('Location: admin.php');
    } elseif ($role === 2 ) {
        header('Location: accueil.php');
    }elseif ($role === 3 ) {
        header('Location: accueil.php');
    }elseif ($role === 1 ) {
        header('Location: accueil.php');
    } else {
        //header('Location: verif.php');
        //header('Location: exportPDF/pdf.php');
        header('Location: /PCS');
    }
} else {
    // Compte non trouvé, redirection vers la page de connexion avec un message d'erreur
    header('Location: login.php?error=1');
}
?>
