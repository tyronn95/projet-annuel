
<?php
include '../GLOBAL/includes/session_verif.php';
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des Utilisateurs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="../GLOBAL/CSS/styles.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light header-bg">
    <a class="navbar-brand" href="/">
    <img src="../GLOBAL/img/logo.png" alt="Votre Logo" style="height: 200px; width: auto;">
    </a>
    <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="voyageur.php">Réserver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PAGE/services.php">Services</a>
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
            <a href="../PAGE/connexion.php">
            <span class="fas fa-user" aria-hidden="true"></span>
            </a>
        </div>
</nav>

<br><br>
<h1 class="mb-4 text-center">Faire une réservation</h1>
<hr class="custom-hr">

<form id="filter-form" class="filter-bar">
    <span class="filter-text">Filtrer par :</span>
    <input type="text" id="destination-filter" placeholder="DESTINATION" />
    <input type="date" id="arrival-date-filter" placeholder="DATE D'ARRIVÉE" />
    <input type="date" id="departure-date-filter" placeholder="DATE DE DÉPART" />
    <select id="price-order-filter">
        <option value="">PRIX</option>
        <option value="asc">Croissant</option>
        <option value="desc">Décroissant</option>
    </select>
    <button type="submit" id="apply-filters">Appliquer</button>
</form>
<hr class="custom-hr">

<div id="reservation-container" class="card-container"></div>

<footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reservationContainer = document.getElementById('reservation-container');
    const filterForm = document.getElementById('filter-form');

    function loadReservations() {
        const userId = <?php echo json_encode($userId); ?>; // Récupérer l'ID de l'utilisateur depuis PHP
        fetch(`http://localhost:5000/reservations/user/${userId}`)
            .then(response => response.json())
            .then(reservations => displayReservations(reservations))
            .catch(error => console.error('Erreur lors de la récupération des réservations:', error));
    }

    function displayReservations(reservations) {
        reservationContainer.innerHTML = '';
        reservations.forEach(reservation => {
            const reservationCard = document.createElement('div');
            reservationCard.classList.add('card-container');
            reservationCard.innerHTML = `
                <div class="details">
                    <h2>Réservation n°${reservation.id} :</h2>
                    <ul>
                        <li>Type du bien : ${reservation.property_type}</li>
                        <li>Date d'arrivée : ${new Date(reservation.start).toLocaleDateString()}</li>
                        <li>Date de départ : ${new Date(reservation.end).toLocaleDateString()}</li>
                        <li>Destination : ${reservation.destination}</li>
                        <li>Prix = ${reservation.price} euros</li>
                    </ul>
                    <button onclick="reserve(${reservation.id})">Réserver</button>
                </div>
                <div class="image-stack">
                    <img src="${reservation.image_top}" alt="Image du haut" class="top">
                    <img src="${reservation.image_bottom}" alt="Image du bas" class="bottom">
                </div>
            `;
            reservationContainer.appendChild(reservationCard);
        });
    }

    // Initialisation des réservations à la charge de la page
    loadReservations();
});

</script>

</body>
</html>
