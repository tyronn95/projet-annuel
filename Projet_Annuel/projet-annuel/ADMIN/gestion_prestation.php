<?php
include '../GLOBAL/includes/session_verif.php';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Prestation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="../GLOBAL/CSS/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
<div class="container-fluid py-5" id="mainContainer" style = "background-color:#000000;">
        <h1 class="mb-4 text-center">Suivi des Prestations</h1>
        <br><br><br>

        <table id="prestationsTable" class="table table-striped w-100">
    <thead>
        <tr style="border: 2px solid #BAA06A; color: black;">
            <th>Nom du Service</th>
            <th>Description</th>
            <th>Date de la Prestation</th>
            <th>Prix</th>
            <th>ID de la Réservation</th>
            <th>Destination</th>
            <th>Prestataire</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Les données seront ajoutées ici -->
    </tbody>
</table>

</div>

<!-- Modal pour afficher les détails des prestations -->
<div class="modal fade" id="prestationDetailsModal" tabindex="-1" aria-labelledby="prestationDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-color: #BAA06A; color: #000; background-color: #BAA06A;">
            <div class="modal-header" style="background-color: #BAA06A; color: #000;">
                <h5 class="modal-title text-center" id="prestationDetailsModalLabel">Détails de la Prestation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="prestationDetailsBody" style="background-color: #BAA06A;">
                <!-- Les détails de la prestation seront insérés ici -->
            </div>
            <div class="modal-footer" style="background-color: #000; color: #BAA06A;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<br><br>
      <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
      <br><br>

<div class="container">
    <h1 class="mb-4 text-center">Gestion des Services</h1>    
    <br><br>
    <form id="serviceForm">
        <input type="text" id="serviceName" placeholder="Nom du Service" required />
        <textarea id="serviceDescription" placeholder="Description" required></textarea>
        <input type="number" id="servicePrice" placeholder="Prix" required />
        <input type="text" id="serviceImage" placeholder="URL de l'image" required />
        <div class="button-container">
    <button type="submit">Ajouter un service</button>
</div>
    </form>
    <div id="servicesList"></div>
</div>



<script>

document.addEventListener('DOMContentLoaded', function() {
    axios.get('http://localhost:5000/api/prestations')
        .then(function (response) {
            const tableBody = document.getElementById('prestationsTable').getElementsByTagName('tbody')[0];
            response.data.forEach(function(item) {
                let row = tableBody.insertRow();
                let cells = [];
                for (let i = 0; i < 8; i++) {
                    cells.push(row.insertCell(i));
                }
                cells[0].innerHTML = item.service_name;
                cells[1].innerHTML = item.description;
                cells[2].innerHTML = new Date(item.date_prestation).toLocaleDateString('fr-FR');
                cells[3].innerHTML = item.prix.toFixed(2) + ' €';
                cells[4].innerHTML = item.reservation_id;
                cells[5].innerHTML = item.destination;
                cells[6].innerHTML = item.prestataire_nom + ' ' + item.prestataire_prenom;
                cells[7].innerHTML = `<button onclick="fetchPrestationDetails(${item.id})" class="btn btn-info">Voir Fiche d'intervention</button>`;
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des prestations:', error));
});

function fetchPrestationDetails(prestationId) {
    axios.get(`http://localhost:5000/api/prestations/${prestationId}/details`)
        .then(function (response) {
            const modalBody = document.getElementById('prestationDetailsBody');
            modalBody.innerHTML = ''; // Clear previous content
            const detail = response.data;
            modalBody.innerHTML = `<strong>Service:</strong> ${detail.service_name}<br>
                                   <strong>Description:</strong> ${detail.description}<br>
                                   <strong>Date de prestation:</strong> ${new Date(detail.date_prestation).toLocaleDateString('fr-FR')}<br>
                                   <strong>Prix:</strong> ${detail.prix.toFixed(2)} €`;
            $('#prestationDetailsModal').modal('show');
        })
        .catch(error => console.error('Erreur lors de la récupération des détails de la prestation:', error));
}

document.getElementById('serviceForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Empêcher le rechargement de la page

    // Récupérer les valeurs du formulaire
    const name = document.getElementById('serviceName').value;
    const description = document.getElementById('serviceDescription').value;
    const price = parseFloat(document.getElementById('servicePrice').value);

    // Vérifier que le prix est un nombre positif
    if (isNaN(price) || price < 0) {
        alert('Veuillez entrer un prix valide.');
        return;
    }

    // Préparer les données à envoyer à l'API
    const serviceData = {
        name: name,
        description: description,
        price: price
    };

    // Envoyer les données à l'API
    try {
        const response = await fetch('http://localhost:5000/api/services/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(serviceData)
        });
        const responseData = await response.json();

        if (response.ok) {
            // Ajouter le service à la liste sur la page
            const serviceElement = document.createElement('div');
            serviceElement.innerHTML = `
                <h3>${responseData.name}</h3>
                <p>${responseData.description}</p>
                <p>Prix: ${responseData.price} €</p>
            `;
            document.getElementById('servicesList').appendChild(serviceElement);

            // Réinitialiser le formulaire
            document.getElementById('serviceForm').reset();
            alert('Service ajouté avec succès!');
        } else {
            throw new Error(responseData.message || 'Erreur lors de l’ajout du service');
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l’ajout du service: ' + error.message);
    }
});

document.getElementById('serviceForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const name = document.getElementById('serviceName').value;
    const description = document.getElementById('serviceDescription').value;
    const price = parseFloat(document.getElementById('servicePrice').value);
    const imageUrl = document.getElementById('serviceImage').value;

    if (isNaN(price) || price < 0) {
        alert('Veuillez entrer un prix valide.');
        return;
    }

    const serviceData = {
        name: name,
        description: description,
        price: price,
        image_url: imageUrl
    };

    try {
        const response = await axios.post('http://localhost:5000/api/services/add', serviceData);
        const addedService = response.data;
        const serviceElement = document.createElement('div');
        serviceElement.classList.add('service-entry');
        serviceElement.innerHTML = `<h3>${addedService.name}</h3>
                                    <p>${addedService.description}</p>
                                    <p>Prix: ${addedService.price} €</p>
                                    <img src="${addedService.image_url}" alt="Image du service" style="max-width: 100%; height: auto;">`;
        document.getElementById('servicesList').appendChild(serviceElement);
        document.getElementById('serviceForm').reset();
        alert('Service ajouté avec succès!');
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l’ajout du service: ' + error.response.data.message);
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
