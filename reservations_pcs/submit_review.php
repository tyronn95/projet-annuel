<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (reservation_id, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $reservation_id, $rating, $comment);

    if ($stmt->execute()) {
        echo "Évaluation envoyée avec succès!";
    } else {
        echo "Erreur lors de l'envoi de l'évaluation.";
    }

    $stmt->close();
    $conn->close();
}
?>