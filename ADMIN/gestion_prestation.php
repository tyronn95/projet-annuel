<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            </ul>
        </div>
    </div>
</nav>
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

<div class="container">
    <h1 class="mb-4 text-center">Gestion des Services</h1>    
    <form id="serviceForm">
        <input type="text" id="serviceName" placeholder="Nom du Service" required />
        <textarea id="serviceDescription" placeholder="Description" required></textarea>
        <input type="number" id="servicePrice" placeholder="Prix" required />
        <button type="button" onclick="addService()">Ajouter un service</button>
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

function addService() {
    // Retrieve values from form inputs
    const name = document.getElementById('serviceName').value;
    const description = document.getElementById('serviceDescription').value;
    const price = document.getElementById('servicePrice').value;

    // Prepare the service data for sending
    const serviceData = {
        name: name,
        description: description,
        price: parseFloat(price)  // Convert the price to a float to ensure correct data type
    };

    // Check if all fields are filled
    if (!name || !description || isNaN(serviceData.price)) {
        alert('Please fill in all fields correctly.');
        return;
    }

    // Use Fetch API to send the POST request
    fetch('/api/services/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(serviceData)
    })
    .then(response => {
        if (!response.ok) {
            // If the server responds with a non-200 status, throw an error
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();  // Parse the JSON from the response
    })
    .then(data => {
        // Handle the response data from the server
        if (data.id) {
            // If the service was added successfully
            const serviceList = document.getElementById('servicesList');
            const serviceDiv = document.createElement('div');
            serviceDiv.classList.add('service');
            serviceDiv.innerHTML = `<h3>${name}</h3><p>${description}</p><p>Prix: ${price} €</p>`;
            serviceList.appendChild(serviceDiv);

            // Clear the form fields after successful addition
            document.getElementById('serviceName').value = '';
            document.getElementById('serviceDescription').value = '';
            document.getElementById('servicePrice').value = '';
            alert('Service added successfully!');
        } else {
            // If the server response does not include an id, handle it as an error
            throw new Error('Service was not added: ' + data.message);
        }
    })
    .catch(error => {
        // Handle any errors that occurred during the process
        console.error('Fetch error:', error);
        alert('An error occurred while sending data to the server: ' + error.message);
    });
}





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
