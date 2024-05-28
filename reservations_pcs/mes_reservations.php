<?php
include 'db.php';

// Récupération des réservations
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
} else {
    echo "Aucune réservation trouvée.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Voir mes réservations/Services associés</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/">
            <img src="logo.png" alt="Votre Logo">
        </a>
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="voyageur.php">Réserver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_reservation.php">Mes Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="chatbot.php">Questions</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="connexion.php">
                <span class="fas fa-user" aria-hidden="true"></span>
            </a>
        </div>
    </nav>

    <br><br>

    <div class="container reservations-container">
        <?php foreach ($reservations as $reservation) : ?>
        <div class="reservation-item d-flex justify-content-between align-items-center">
            <div class="reservation-details">
                <h3>Réservation n°<?= $reservation['id'] ?> :</h3>
                <p><strong>Type de bien :</strong> <?= $reservation['type_bien'] ?><br>
                    <strong>Date :</strong> <?= $reservation['date'] ?><br>
                    <strong>Durée :</strong> <?= $reservation['duree'] ?><br>
                    <strong>Prix :</strong> <?= $reservation['prix'] ?> euros
                </p>
            </div>
            <div class="services-details text-right">
                <h4><strong>Services associés :</strong></h4>
                <ul>
                    <?php foreach (explode(',', $reservation['services']) as $service) : ?>
                    <li><?= trim($service) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn-evaluer"
                    onclick="openModal(<?= htmlspecialchars(json_encode($reservation), ENT_QUOTES, 'UTF-8') ?>)">Évaluer</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="evaluationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Évaluer la Réservation</h2>
            <form id="evaluationForm">
                <input type="hidden" id="reservationId">
                <div class="form-group">
                    <label for="rating">Note :</label>
                    <select id="rating" class="form-control">
                        <option value="5">5 étoiles</option>
                        <option value="4">4 étoiles</option>
                        <option value="3">3 étoiles</option>
                        <option value="2">2 étoiles</option>
                        <option value="1">1 étoile</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Commentaire :</label>
                    <textarea id="comment" class="form-control" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="submitEvaluation()">Envoyer</button>
            </form>
        </div>
    </div>

    <footer>
        <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV</h1>
        <div class="social-icons">
            <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
            <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script>
    const modal = document.getElementById("evaluationModal");
    const form = document.getElementById("evaluationForm");

    function openModal(reservation) {
        document.getElementById("reservationId").value = reservation.id;
        modal.style.display = "block";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function submitEvaluation() {
        const reservationId = document.getElementById("reservationId").value;
        const rating = document.getElementById("rating").value;
        const comment = document.getElementById("comment").value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_review.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Évaluation envoyée avec succès!");
                closeModal();
            }
        };
        xhr.send("reservation_id=" + reservationId + "&rating=" + rating + "&comment=" + comment);
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>

</html>