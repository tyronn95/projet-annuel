<?php 
try {
    // Configuration des paramètres de connexion
    $dsn = 'mysql:host=localhost;dbname=pcs;charset=utf8';
    $username = 'root';
    $password = 'root';

    // Création d'une nouvelle instance de PDO
    $bdd = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (Exception $e) {
    // Gestion des erreurs de connexion
    die('Erreur PDO : ' . $e->getMessage());
}
?>
