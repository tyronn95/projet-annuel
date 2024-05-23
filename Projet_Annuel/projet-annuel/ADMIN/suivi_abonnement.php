<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Abonnement</title>
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
    <h1 class="mb-4 text-center">Liste des Abonnés</h1>
</div>
    <br>

<br>

<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Abonnement</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Les données seront affichées ici -->
        </tbody>
    </table>
</div>

<footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    &nbsp;    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;

    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
    // Fonction pour charger les données des abonnés depuis l'API
    function loadSubscribedTravelers() {
        $.get("http://localhost:5000/subscribed-travelers", function(data, status){
            if (status === "success") {
                displaySubscribedTravelers(data);
            } else {
                console.error("Erreur lors de la récupération des données:", data.error);
            }
        });
    }

    // Fonction pour afficher les données des abonnés dans le tableau
    function displaySubscribedTravelers(data) {
        var tableBody = $("#table-body");
        tableBody.empty(); // Vide le contenu du tableau

        data.forEach(function(traveler) {
            var row = $("<tr>");
            row.append($("<td>").text(traveler.id));
            row.append($("<td>").text(traveler.email));
            row.append($("<td>").text(traveler.nom));
            row.append($("<td>").text(traveler.prenom));
            row.append($("<td>").text(traveler.abonnement));

            var startDate = new Date(traveler.date_debut);
            var formattedStartDate = startDate.toLocaleDateString('fr-FR');
            row.append($("<td>").text(formattedStartDate));

            var endDate = new Date(traveler.date_expiration);
            var formattedEndDate = endDate.toLocaleDateString('fr-FR');
            row.append($("<td>").text(formattedEndDate));

            // Bouton Supprimer
            var actions = $("<td>").addClass("actions-container");
            var deleteButton = $("<button>").text("SUPPRIMER").addClass("btn btn-danger");
            deleteButton.click(function() {
                deleteSubscription(traveler.id);
            });

            actions.append(deleteButton);
            row.append(actions);

            tableBody.append(row);
        });
    }

    // Fonction pour supprimer un abonnement
    function deleteSubscription(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')) {
            fetch(`http://localhost:5000/souscription/${id}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorInfo => Promise.reject(errorInfo));
                }
                loadSubscribedTravelers(); // Recharger la liste des abonnements après la suppression
            })
            .catch(error => console.error('Erreur lors de la suppression de l\'abonnement:', error));
        }
    }

    // Chargement initial des données des abonnés
    loadSubscribedTravelers();
});

</script>

</body>
</html>
