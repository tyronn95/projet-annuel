
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
    header("location: ../PAGE/connexion.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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
          <a class="nav-link active" aria-current="page" href="#">Gestion des Biens</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form_bien.php">Ajout de propriété</a>
        </li>
      </ul>        </div>
        <div class="d-flex align-items-center">
            <a href="../PAGE/connexion.php">
            <span class="fas fa-user" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</nav>

    <div class="text-center mt-5">
        <h1>CALENDRIER</h1>
    </div>

<div class="container mt-5">
    <div class="calendar-container">
        <div class="calendar-header">
            <h3 id="month-and-year"></h3>
            <br>
            <div class="calendar-navigation">
                <button id="previous">&lt;</button>
                <button id="today">Today</button>
                <button id="next">&gt;</button>
            </div>
        </div>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <!-- Calendar is dynamically created here -->
            </tbody>
            
        </table>
        
</div>
    </div>
    <div class="calendar-legend-container">
  <div class="calendar-legend">
    <div class="legend-item">
      <span class="legend-color" style="background-color: #000;"></span> <span>Réservé</span>
    </div>
    <div class="legend-item">
      <span class="legend-color" style="background-color: #BAA06A;"></span> <span>Non réservé</span>
    </div>
  </div>
</div>


</div>

<br>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Vous pouvez rendre indisponible une date</h2>
    <form id="reservationForm">
        <div class="form-group">
            <label for="startDate">Date de début :</label>
            <input type="date" id="startDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="endDate">Date de fin :</label>
            <input type="date" id="endDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Réserver</button>
    </form>
</div>

<br><br><br>
    <footer>
        <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV</h1>
        <div class="social-icons">
            <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
            <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="../GLOBAL/script/calendar.js"></script>
</body>
</html>


