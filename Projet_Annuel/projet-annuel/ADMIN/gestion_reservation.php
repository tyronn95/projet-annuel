<?php
include '../GLOBAL/includes/session_verif.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Réservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="../GLOBAL/CSS/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
          <a class="nav-link active" aria-current="page" href="admin.php">Gestion Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_reservation.php">Reservation/Prestation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_prestation.php">Suivi Prestation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="suivi_abonnement.php">Suivi abonnement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="verif_biens.php">Biens</a>
        </li>
      </ul>        
    </div>
        <div class="d-flex align-items-center">
            <a href="../PAGE/connexion.php">
            <span class="fas fa-user" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</nav>

<br><br>
<div class="container py-5" id="mainContainer">
    <h1 class="mb-4 text-center">Liste des Reservations/Prestations</h1>
    <br>
</div>

<table id="reservationsTable" class="table">
    <thead>
        <tr style="border: 2px solid #BAA06A; color: black;">
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Destination</th>
            <th>Prix</th>
            <th>Type de propriété</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Les réservations seront ajoutées ici -->
    </tbody>
</table>

<!-- Modal pour afficher les détails des réservations -->
<div class="modal fade" id="reservationDetailsModal" tabindex="-1" aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-color: #BAA06A; color: #000; background-color: #BAA06A;">
      <div class="modal-header" style="background-color: #BAA06A; color: #000;">
        <h5 class="modal-title text-center" id="reservationDetailsModalLabel">Détails de la Réservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="reservationDetailsBody" style="background-color: #BAA06A;">
        <!-- Les détails de la réservation seront insérés ici -->
      </div>
      <div class="modal-footer" style="background-color: #000; color: #BAA06A;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadReservations();

    function loadReservations() {
        fetch('http://localhost:5000/reservations/admin')
            .then(response => response.json())
            .then(reservations => {
                const tableBody = document.getElementById('reservationsTable').getElementsByTagName('tbody')[0];
                tableBody.innerHTML = ''; // Clear previous content
                reservations.forEach(reservation => {
                    let row = tableBody.insertRow();
                    let cells = [];
                    for (let i = 0; i < 7; i++) {  // Ajoute des cellules supplémentaires pour le statut et les actions
                        cells.push(row.insertCell(i));
                    }

                    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                    cells[0].innerHTML = new Date(reservation.start).toLocaleDateString('fr-FR', options);
                    cells[1].innerHTML = new Date(reservation.end).toLocaleDateString('fr-FR', options);
                    cells[2].innerHTML = reservation.destination;
                    cells[3].innerHTML = reservation.price;
                    cells[4].innerHTML = reservation.property_type;
                    cells[5].innerHTML = reservation.status;  // Ajouter le statut

                    // Ajouter les boutons 'Voir', 'Modifier' et 'Supprimer'
                    cells[6].innerHTML = `
                        <div class="action-buttons">
                            <button onclick="fetchReservationDetails(${reservation.id})" class="btn btn-view">Voir</button>
                            <button onclick="editReservation(${reservation.id})" class="btn btn-edit">Modifier</button>
                            <button onclick="deleteReservation(${reservation.id}, this)" class="btn btn-delete">Supprimer</button>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des réservations:', error));
    }

    window.fetchReservationDetails = function(reservationId) {
    fetch(`http://localhost:5000/reservations/${reservationId}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(reservation => {
            displayReservationDetails(reservation);
        })
        .catch(error => {
            console.error('Error fetching reservation details:', error);
            alert('Error fetching reservation details: ' + error.message);
        });
};


function displayReservationDetails(reservation) {
    const modalBody = document.getElementById('reservationDetailsBody');
    modalBody.innerHTML = ''; // Clear previous content
    const detailsHtml = `
        <p><strong>ID de la Réservation:</strong> ${reservation.id}</p>
        <p><strong>Date de début:</strong> ${new Date(reservation.start).toLocaleDateString()}</p>
        <p><strong>Date de fin:</strong> ${new Date(reservation.end).toLocaleDateString()}</p>
        <p><strong>Destination:</strong> ${reservation.destination}</p>
        <p><strong>Prix:</strong> ${reservation.price} €</p>
        <p><strong>Type de propriété:</strong> ${reservation.property_type}</p>
        <p><strong>Statut:</strong> ${reservation.status}</p>
    `;
    modalBody.innerHTML = detailsHtml;

    if (reservation.details && reservation.details.length > 0) {
        reservation.details.forEach(detail => {
            const detailElement = document.createElement('p');
            detailElement.innerHTML = `
                <strong>Service:</strong> ${detail.service_name}<br>
                <strong>Description:</strong> ${detail.description}<br>
                <strong>Date de prestation:</strong> ${new Date(detail.date_prestation).toLocaleDateString()}<br>
                <strong>Prix:</strong> ${detail.prix.toFixed(2)} €`;
            modalBody.appendChild(detailElement);
        });
    }
    $('#reservationDetailsModal').modal('show');  // Use jQuery to show the modal
}


    window.editReservation = function(reservationId) {
        // Logic to edit reservation
        alert('Fonctionnalité de modification à implémenter pour la réservation ID: ' + reservationId);
    }

    window.deleteReservation = function(reservationId, button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
            fetch(`http://localhost:5000/reservations/${reservationId}/delete`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    // Remove the row from the table
                    const row = button.closest('tr');
                    row.remove();
                } else {
                    alert('Erreur lors de la suppression de la réservation');
                }
            })
            .catch(error => console.error('Erreur lors de la suppression de la réservation:', error));
        }
    }
});
</script>

<footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>
</body>
</html>
