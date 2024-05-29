<?php
include('../global/include/BDDLocal.php');


if(isset($_POST['noteU'])) {
    $noteU = $_POST['noteU'];
}

$sql = "SELECT note, nbNote FROM users WHERE id =  :utilisateur_id";
$requete->bindParam(':utilisateur_id', $id);
$stmt = $bdd->prepare($sql);

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$nbNote = $row['nbNote'];
$note = ($nbNote * ($row['note']) + $noteU) / ($nbNote + 1);
$nbNote++;
$sql = "UPDATE logements SET note = :note, nbNote = :nbNote WHERE id = 1";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':note', $note, PDO::PARAM_INT);
$stmt->bindParam(':nbNote', $nbNote, PDO::PARAM_INT);

$stmt->execute();

$bdd = null;
?>