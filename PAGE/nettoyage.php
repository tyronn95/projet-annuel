<?php
session_start();
include('BDDLocal.php');

$username = $_SESSION['username'];
$cout = $_POST['cout'];

$query = $bdd->prepare('INSERT INTO services (email, nom, cout) VALUES (?, "nettoyage", ?)');
$query->execute(array($username, $cout));
header('Location: services.php');
// echo "<div id="/myModal/" class="/modal/">
//     <!-- Contenu du modal -->
//     <div class="/modal-content/">
//       <span class="/close/">&times;</span>
//       <p>Ceci est un popup modal!</p>
//     </div>
//   </div>";

// ?>