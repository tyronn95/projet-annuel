

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
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
          <a class="nav-link active" aria-current="page" href="admin.php">Gestion Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="calendar.php">Gestion Reservation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="suivi_abonnement.php">Suivi abonnement</a>
        </li>
      </ul>        </div>
        <div class="d-flex align-items-center">
            <a href="login.php">
            <span class="fas fa-user" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</nav>
<br><br><br>
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

<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (optional) -->

<script>
$(document).ready(function(){
    // Fonction pour charger les données des voyageurs abonnés depuis l'API
    function loadSubscribedTravelers() {
        $.get("http://localhost:5000/subscribed-travelers", function(data, status){
            if (status === "success") {
                displaySubscribedTravelers(data);
            } else {
                console.error("Erreur lors de la récupération des données:", data.error);
            }
        });
    }

    // Fonction pour afficher les données des voyageurs abonnés dans le tableau
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
            // Formater la date de début pour afficher uniquement la date
            var startDate = new Date(traveler.date_debut);
            var formattedStartDate = startDate.toLocaleDateString('fr-FR');
            row.append($("<td>").text(formattedStartDate));
            // Formater la date de fin pour afficher uniquement la date
            var endDate = new Date(traveler.date_expiration);
            var formattedEndDate = endDate.toLocaleDateString('fr-FR');
            row.append($("<td>").text(formattedEndDate));
            // Boutons Modifier et Supprimer
            var actions = $("<td>").addClass("actions-container"); // Ajout de la classe "actions-container"
            var editButton = $("<button>").text("Modifier").addClass("btn");
editButton.click(function() {
    toggleUpdateSubscriptionForm(traveler.id, traveler.email, traveler.nom, traveler.prenom, traveler.abonnement, traveler.date_debut, traveler.date_expiration);
});
var deleteButton = $("<button>").text("Supprimer").addClass("btn");
deleteButton.click(function() {
    deleteSubscription(traveler.id);
});
            actions.append(editButton);
            actions.append(deleteButton);

            row.append(actions);

            tableBody.append(row);
        });
    }

    // Chargement initial des données des voyageurs abonnés
    loadSubscribedTravelers();

    function editSubscription(id) {
    // Récupérer les données de l'abonnement à partir de l'API
    fetch(`http://localhost:5000/subscription/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse réseau non OK');
            }
            return response.json();
        })
        .then(data => {
            // Remplir le formulaire de modification avec les données de l'abonnement
            document.getElementById('updateId').value = id;
            document.getElementById('updateEmail').value = data.email;
            document.getElementById('updateNom').value = data.nom;
            document.getElementById('updatePrenom').value = data.prenom;
            document.getElementById('updateAbonnement').value = data.abonnement;
            document.getElementById('updateDateDebut').value = data.dateDebut;
            document.getElementById('updateDateExpiration').value = data.dateExpiration;

            // Afficher le formulaire de modification
            document.getElementById('updateForm').style.display = 'block';
            document.getElementById('createForm').style.display = 'none'; // Cacher le formulaire de création
        })
        .catch(error => console.error('Erreur lors de la récupération de l\'abonnement à modifier:', error));
}


    // Fonction pour afficher le formulaire de mise à jour des abonnements
function toggleUpdateSubscriptionForm(id, email, nom, prenom, abonnement, dateDebut, dateExpiration) {
    var updateForm = document.getElementById('updateForm');
    // Vérifie si le formulaire de mise à jour est déjà ouvert pour le même utilisateur
    if(updateForm.style.display === 'block' && document.getElementById('updateId').value === id) {
        updateForm.style.display = 'none'; // Cache le formulaire si c'est le même utilisateur
    } else {
        // Sinon, met à jour les champs du formulaire avec les données de l'abonnement et affiche le formulaire
        document.getElementById('updateId').value = id;
        document.getElementById('updateEmail').value = email;
        document.getElementById('updateNom').value = nom;
        document.getElementById('updatePrenom').value = prenom;
        document.getElementById('updateAbonnement').value = abonnement;
        document.getElementById('updateDateDebut').value = dateDebut;
        document.getElementById('updateDateExpiration').value = dateExpiration;
        updateForm.style.display = 'block';
        document.getElementById('createForm').style.display = 'none'; // Cache le formulaire de création au cas où il est ouvert
    }
}
// Fonction pour supprimer un abonnement
function deleteSubscription(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')) {
        fetch(`http://localhost:5000/subscription/${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse réseau non OK');
            }
            fetchSubscriptions(); // Recharger la liste des abonnements après la suppression
        })
        .catch(error => console.error('Erreur lors de la suppression de l\'abonnement:', error));
    }
}

});
</script>

</body>
</html>
