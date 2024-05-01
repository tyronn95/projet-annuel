<?php
function verifierSessionUtilisateur() {
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: connexion.html");
        exit();
    }
//    echo $_SESSION['username']
}
/*
session_start();
if (!$_SESSION['username'];){
    header(connexion.php);
    return false;
}
*/
?>

