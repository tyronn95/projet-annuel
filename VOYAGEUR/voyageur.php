


<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // L'utilisateur est connecté
    $userId = $_SESSION['id']; // Récupérer l'ID de l'utilisateur


    // Effectuer d'autres opérations comme des requêtes de base de données
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des Utilisateurs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light header-bg">
    <a class="navbar-brand" href="/">
        <img src="logo.png" alt="Votre Logo" style="height: 200px; width: auto;">
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

    // Fonction pour charger les réservations initiales et après le filtrage
    function loadReservations(queryUrl = 'http://localhost:5000/reservations') {
        fetch(queryUrl)
            .then(response => response.json())
            .then(reservations => displayReservations(reservations))
            .catch(error => console.error('Erreur lors de la récupération des réservations:', error));
    }

    // Affichage des réservations dans la page
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

    // Gestionnaire pour le formulaire de filtrage
    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const destination = document.getElementById('destination-filter').value;
        const start = document.getElementById('arrival-date-filter').value;
        const end = document.getElementById('departure-date-filter').value;
        const priceOrder = document.getElementById('price-order-filter').value;
        let query = `http://localhost:5000/reservations/filter?destination=${encodeURIComponent(destination)}&start=${start}&end=${end}&priceOrder=${priceOrder}`;
        loadReservations(query);
    });

    // Fonction pour réserver une réservation
    window.reserve = function(reservationId) {
        const userId = 1; // Supposé que l'ID de l'utilisateur soit 1 pour cet exemple
        fetch('http://localhost:5000/reservations/reserve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: reservationId, userId: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert('Réservation confirmée!');
                loadReservations(); // Recharge les réservations pour mettre à jour l'affichage
            } else {
                alert('Erreur lors de la réservation');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la communication avec l’API');
        });
    };

    // Charge les réservations initialement
    loadReservations();
});
</script>

</body>
</html>
