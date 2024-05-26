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
          <a class="nav-link" href="gestion_reservation.php">Reservation</a>
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
    <h1 class="mb-4 text-center">Liste des Reservations</h1>
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
<div class="modal fade" style="color: #000" id="reservationDetailsModal" tabindex="-1" aria-labelledby="reservationDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="color: #000">
    <div class="modal-content" style="border-color: #BAA06A; color: #000 !important; background-color: #BAA06A;">
      <div class="modal-header" style="background-color: #BAA06A; color: #000;">
        <h5 class="modal-title text-center" style = "color:black !important; text-align:center;" id="reservationDetailsModalLabel">Détails de la Réservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="reservationDetailsBody" style="background-color: #BAA06A; color:black;">
        <!-- Les détails de la réservation seront insérés ici -->
      </div>
      <div class="modal-footer" style="background-color: #000; color: #BAA06A;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editReservationModalLabel">Edit Reservation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editReservationForm">
            <div class="form-group">
                <label for="editPropertyType">Type</label>
                <input type="text" class="form-control" id="editPropertyType">
            </div>
            <div class="form-group">
                <label for="editStartDate">Start Date</label>
                <input type="date" class="form-control" id="editStartDate">
            </div>
            <div class="form-group">
                <label for="editEndDate">End Date</label>
                <input type="date" class="form-control" id="editEndDate">
            </div>
            <div class="form-group">
                <label for="editDestination">Destination</label>
                <input type="text" class="form-control" id="editDestination">
            </div>
            <div class="form-group">
                <label for="editPrice">Price</label>
                <input type="text" class="form-control" id="editPrice">
            </div>
            <div class="form-group">
                <label for="editStatus">Status</label>
                <select class="form-control" id="editStatus">
                    <option>reserved</option>
                    <option>not_reserved</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEdit()">Save Changes</button>
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
                    for (let i = 0; i < 7; i++) {  // Add extra cells for status and actions
                        cells.push(row.insertCell(i));
                    }

                    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                    cells[0].innerHTML = new Date(reservation.start).toLocaleDateString('fr-FR', options);
                    cells[1].innerHTML = new Date(reservation.end).toLocaleDateString('fr-FR', options);
                    cells[2].innerHTML = reservation.destination;
                    cells[3].innerHTML = reservation.price;
                    cells[4].innerHTML = reservation.property_type;
                    cells[5].innerHTML = reservation.status;  // Add the status

                    // Add 'View', 'Edit' and 'Delete' buttons
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
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(reservation => {
                if (reservation) {
                    displayReservationDetails(reservation);
                } else {
                    alert('No details found for this reservation');
                }
            })
            .catch(error => {
                console.error('Error fetching reservation details:', error);
                alert('Error fetching reservation details: ' + error.message);
            });
    };

    function displayReservationDetails(reservation) {
        const modalBody = document.getElementById('reservationDetailsBody');
        modalBody.innerHTML = `
            <p class="modal-paragraph"><strong>ID:</strong> ${reservation.id}</p>
            <p class="modal-paragraph"><strong>Type:</strong> ${reservation.property_type}</p>
            <p class="modal-paragraph"><strong>Start Date:</strong> ${new Date(reservation.start).toLocaleDateString()}</p>
            <p class="modal-paragraph"><strong>End Date:</strong> ${new Date(reservation.end).toLocaleDateString()}</p>
            <p class="modal-paragraph"><strong>Destination:</strong> ${reservation.destination}</p>
            <p class="modal-paragraph"><strong>Price:</strong> ${reservation.price}</p>
            <p class="modal-paragraph"><strong>Status:</strong> ${reservation.status}</p>
            <h5 class="modal-paragraph">Services:</h5>
            ${reservation.services.map(service => `
                <div class="modal-paragraph service-details">
                    <p><strong>Service Name:</strong> ${service.service_name}</p>
                    <p><strong>Description:</strong> ${service.service_description}</p>
                    <p><strong>Date:</strong> ${new Date(service.date_prestation).toLocaleDateString()}</p>
                    <p><strong>Price:</strong> ${service.prix} €</p>
                </div>
            `).join('')}
        `;
        $('#reservationDetailsModal').modal('show');
    }

    window.editReservation = function(reservationId) {
        fetch(`http://localhost:5000/reservations/${reservationId}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editPropertyType').value = data.property_type;
                document.getElementById('editStartDate').value = data.start.split('T')[0];
                document.getElementById('editEndDate').value = data.end.split('T')[0];
                document.getElementById('editDestination').value = data.destination;
                document.getElementById('editPrice').value = data.price;
                document.getElementById('editStatus').value = data.status;
                document.getElementById('editReservationForm').setAttribute('data-reservation-id', reservationId);
                $('#editReservationModal').modal('show');
            })
            .catch(error => {
                console.error('Failed to fetch reservation details:', error);
                alert('Error fetching reservation details: ' + error.message);
            });
    };

    window.submitEdit = function() {
        const form = document.getElementById('editReservationForm');
        const reservationId = form.getAttribute('data-reservation-id');
        const updatedData = {
            property_type: document.getElementById('editPropertyType').value,
            start: document.getElementById('editStartDate').value,
            end: document.getElementById('editEndDate').value,
            destination: document.getElementById('editDestination').value,
            price: document.getElementById('editPrice').value,
            status: document.getElementById('editStatus').value
        };

        // Validate required fields
        if (!updatedData.start || !updatedData.end) {
            alert('Start and End dates are required.');
            return;
        }

        console.log("Updating reservation with ID:", reservationId, " Data:", updatedData);

        fetch(`http://localhost:5000/reservations/${reservationId}/update`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedData)
        })
        .then(response => {
            if (!response.ok) throw new Error('Failed to update reservation, server responded with status ' + response.status);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                $('#editReservationModal').modal('hide');
                loadReservations();  // Reload the list of reservations to show the updated data
                alert('Reservation updated successfully!');
            } else {
                alert('Failed to update reservation.');
            }
        })
        .catch(error => {
            console.error('Error updating reservation:', error);
            alert('Error updating reservation: ' + error.message);
        });
    };

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
    };
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
