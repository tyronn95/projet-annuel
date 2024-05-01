<?php include('BDDLocal.php');


$username = $_POST['username'];
$password = $_POST['password'];

$query = $bdd->prepare('SELECT * FROM users WHERE username = ?');
$query->execute(array($username));
$user = $query->fetch();

if ($user) {
    echo "Ce nom d'utilisateur est déjà utilisé. Veuillez choisir un autre nom d'utilisateur.";
} else {
    $query = $bdd->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $query->execute(array($username, $password));
    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
}
?>
