<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "<script>var userId = " . json_encode($_SESSION['id']) . ";</script>";
} else {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Propos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="../GLOBAL/CSS/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light header-bg">
        <a class="navbar-brand" href="/">
          <img src="../GLOBAL/img/logo.png" alt="Votre Logo" style="height: 200px; width: auto;">
        </a>
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="a_propos.php">À propos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="abonnements.php">Abonnements</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
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

    <div class="availability-container mt-5">
    <h2 class="availability-title text-center">Gestion des Disponibilités du Prestataire</h2>
    <form id="availabilityForm" class="availability-form">
        <div class="availability-form-group">
            <label for="startDate" class="availability-form-label">Date de début :</label>
            <input type="date" id="startDate" class="availability-form-input" required>
        </div>
        <div class="availability-form-group">
            <label for="endDate" class="availability-form-label">Date de fin :</label>
            <input type="date" id="endDate" class="availability-form-input" required>
        </div>
        <div class="availability-form-group">
            <label for="prestationNom" class="availability-form-label">Nom de la prestation :</label>
            <input type="text" id="prestationNom" class="availability-form-input" required>
        </div>
        <div class="availability-form-group">
            <label for="prestationDescription" class="availability-form-label">Description de la prestation :</label>
            <textarea id="prestationDescription" class="availability-form-input" required></textarea>
        </div>
        <div class="availability-form-group">
            <label for="prestationPrix" class="availability-form-label">Prix de la prestation :</label>
            <input type="number" id="prestationPrix" class="availability-form-input" required>
        </div>
        <button type="submit" class="availability-form-submit">Définir Disponibilité</button>
    </form>
</div>


    <div class="calendar-container mt-5">
        <div class="calendar-header">
            <h3 id="month-and-year"></h3>
            <br>
            <div class="calendar-navigation">
                <button id="previous">&lt;</button>
                <button id="today">Aujourd'hui</button>
                <button id="next">&gt;</button>
            </div>
        </div>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Dim</th>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <!-- Le calendrier sera généré par JavaScript -->
            </tbody>
        </table>
    </div>

    <br><br><br>

    <footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

    <!-- Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reservationModalLabel">Détails de la prestation</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="reservationDetails"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const calendarBody = document.getElementById('calendar-body');
    const monthAndYear = document.getElementById('month-and-year');
    const previousButton = document.getElementById('previous');
    const todayButton = document.getElementById('today');
    const nextButton = document.getElementById('next');
    const availabilityForm = document.getElementById('availabilityForm');

    let currentMonth = new Date();

    if (previousButton) {
        previousButton.addEventListener('click', () => {
            currentMonth.setMonth(currentMonth.getMonth() - 1);
            generateCalendar(currentMonth);
        });
    }

    if (todayButton) {
        todayButton.addEventListener('click', () => {
            currentMonth = new Date();
            generateCalendar(currentMonth);
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            currentMonth.setMonth(currentMonth.getMonth() + 1);
            generateCalendar(currentMonth);
        });
    }

    if (availabilityForm) {
        availabilityForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const prestationNom = document.getElementById('prestationNom').value;
            const prestationDescription = document.getElementById('prestationDescription').value;
            const prestationPrix = document.getElementById('prestationPrix').value;
            setAvailability(startDate, endDate, prestationNom, prestationDescription, prestationPrix, userId);
        });
    }

    function setAvailability(start, end, prestationNom, prestationDescription, prestationPrix, userId) {
        fetch('http://localhost:5000/setAvailability', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ start, end, prestationNom, prestationDescription, prestationPrix, userId })
        })
        .then(response => response.json())
        .then(data => {
            alert('Disponibilité mise à jour avec succès.');
            generateCalendar(currentMonth);
        })
        .catch(error => console.error('Erreur:', error));
    }

    function fetchUnavailableDates() {
        return fetch('http://localhost:5000/getUnavailableDates', {
            method: 'GET'
        })
        .then(response => response.json())
        .catch(error => console.error('Erreur lors de la récupération des dates indisponibles:', error));
    }

    async function generateCalendar(d) {
        const unavailableDates = await fetchUnavailableDates();
        const firstDay = new Date(d.getFullYear(), d.getMonth(), 1);
        const lastDay = new Date(d.getFullYear(), d.getMonth() + 1, 0);
        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        monthAndYear.textContent = `${monthNames[d.getMonth()]} ${d.getFullYear()}`;
        calendarBody.innerHTML = '';

        let date = 1;
        let row = document.createElement('tr');

        for (let i = 0; i < firstDay.getDay(); i++) {
            let cell = document.createElement('td');
            cell.classList.add('empty');
            row.appendChild(cell);
        }

        while (date <= lastDay.getDate()) {
            if (row.children.length === 7) {
                calendarBody.appendChild(row);
                row = document.createElement('tr');
            }
            let cell = document.createElement('td');
            const currentDate = `${d.getFullYear()}-${('0' + (d.getMonth() + 1)).slice(-2)}-${('0' + date).slice(-2)}`;
            cell.textContent = date;
            cell.classList.add(unavailableDates.includes(currentDate) ? 'calendar-day-unavailable' : 'calendar-day-available');

            if (unavailableDates.includes(currentDate)) {
                cell.addEventListener('click', () => showReservationDetails(currentDate));
            }

            row.appendChild(cell);
            date++;
        }

        while (row.children.length < 7) {
            let cell = document.createElement('td');
            cell.classList.add('empty');
            row.appendChild(cell);
        }

        calendarBody.appendChild(row);
    }

    function showReservationDetails(date) {
        fetch(`http://localhost:5000/getUnavailableDetails?date=${date}`)
            .then(response => response.json())
            .then(data => {
                const detailsElement = document.getElementById('reservationDetails');
                if (data.length > 0) {
                    const reservation = data[0];
                    const startDate = new Date(reservation.date_debut).toLocaleDateString();
                    const endDate = new Date(reservation.date_fin).toLocaleDateString();
                    detailsElement.innerHTML = `Date de début : ${startDate}<br>Date de fin : ${endDate}<br>Prestation : ${reservation.prestation_nom}<br>Description : ${reservation.prestation_description}<br>Prix : ${reservation.prestation_prix}`;
                } else {
                    detailsElement.textContent = 'Aucune prestation trouvée pour cette date.';
                }
                $('#reservationModal').modal('show');
            })
            .catch(error => console.error('Erreur lors de la récupération des détails de la prestation:', error));
    }

    generateCalendar(currentMonth);
});

    </script>
</body>
</html>
