<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Disponibilités</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- Inclure ici votre PHP pour récupérer l'ID de l'utilisateur -->
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "<script>var userId = " . json_encode($_SESSION['id']) . ";</script>";
} else {
    header("location: login.php");
    exit;
}
?>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestion des Disponibilités du Prestataire</h2>
    <form id="availabilityForm">
        <div class="form-group">
            <label for="startDate">Date de début :</label>
            <input type="date" id="startDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="endDate">Date de fin :</label>
            <input type="date" id="endDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Définir Disponibilité</button>
    </form>
</div>

<div class="calendar-container mt-5">
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const availabilityForm = document.getElementById('availabilityForm');
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    const calendarBody = document.getElementById('calendar-body');

    availabilityForm.addEventListener('submit', function(event) {
        event.preventDefault();
        setAvailability(startDate.value, endDate.value, userId);
    });

    function setAvailability(start, end, userId) {
        fetch('http://localhost:5000/setAvailability', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ start, end, userId })
        })
        .then(response => response.json())
        .then(data => {
            alert('Disponibilité mise à jour avec succès.');
            generateCalendar(); // Régénérer le calendrier pour afficher les nouvelles disponibilités
        })
        .catch(error => console.error('Erreur:', error));
    }

    function generateCalendar() {
        const today = new Date();
        const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);
        const monthEnd = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        const daysInMonth = monthEnd.getDate();
        let day = monthStart.getDay();

        let html = '';
        for (let i = 0; i < day; i++) {
            html += '<td></td>'; // Remplir les cases vides au début du mois
        }

        for (let i = 1; i <= daysInMonth; i++) {
            if (day === 7) {
                day = 0;
                html += '</tr><tr>';
            }
            html += `<td>${i}</td>`;
            day++;
        }

        while (day > 0 && day < 7) {
            html += '<td></td>'; // Remplir les cases vides à la fin du mois
            day++;
        }

        calendarBody.innerHTML = `<tr>${html}</tr>`;
    }

    generateCalendar();
});
</script>
</body>
</html>
