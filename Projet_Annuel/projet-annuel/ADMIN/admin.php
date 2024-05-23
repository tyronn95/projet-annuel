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
    <title>Admin</title>
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
    <h1 class="mb-4 text-center">Liste des Utilisateurs</h1>

    <br>

<br>

<div class="d-flex align-items-center justify-content-center mb-3">
    <div class="search-container">
    <input type="text" id="searchBar" class="form-control-search" placeholder="Rechercher par email..." onkeyup="searchUser()">
</div>

&nbsp; &nbsp;

        <!-- Bouton pour ajouter un nouvel utilisateur -->
        <button class="btn" onclick="toggleCreateForm()" style="margin: 0;">Ajouter un nouvel utilisateur</button>
        <!-- Sélecteur de filtres -->
        &nbsp;

        <div class="filter-container ml-2">
            <select id="typeFilter" class="form-control" onchange="filterByType()">
                <option value="">Tous les types</option>
                <option value="0">Admin</option>
                <option value="1">Propriétaire</option>
                <option value="2">Locataire</option>
                <option value="3">Prestataire</option>
            </select>
        </div>
    </div>

    <div id="createForm" class="form-container" style="display: none;">
        <h2 class="create-form">Ajouter un nouvel utilisateur</h2>
        <form id="userCreateForm">
            <div class="form-group">
                <input type="email" id="createEmail" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" id="createNom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="text" id="createPrenom" class="form-control" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <input type="text" id="createTelephone" class="form-control" placeholder="Téléphone" required>
            </div>
            <div class="form-group">
            <select id="createType" class="form-control" required>
                <option value="">Sélectionner un type</option>
                <option value="0">Admin</option>
                <option value="1">Voyageur</option>
                <option value="2">Prestataire</option>
                <option value="3">Proprietaire</option>
            </select>

            </div>
            <button type="submit" class="btn btn-primary btn-centered">Ajouter</button>
        </form>
        <br><br>
    </div>

    <br><br><br>

<!-- 
    <div class="filter-container mb-3">
    <select id="typeFilter" class="form-control" onchange="filterByType()">
        <option value="">Tous les types</option>
        <option value="Bailleur">Bailleur</option>
        <option value="Locataire">Locataire</option>
        <option value="Prestataire">Prestataire</option>
    </select>
</div> -->
    
    <div class="table-responsive table-container">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userList"></tbody>
        </table>
    </div>

    <div id="updateForm" class="form-container" style="display: none;">
    <br><br>

        <h2 class="update-form">Modifier un utilisateur</h2>
        <form id="userUpdateForm">
            <input type="hidden" id="updateId">
            <div class="form-group">
                <input type="email" id="updateEmail" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" id="updateNom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="text" id="updatePrenom" class="form-control" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <input type="text" id="updateTelephone" class="form-control" placeholder="Téléphone" required>
            </div>
            <div class="form-group">
            <select id="updateType" class="form-control" required>
    <option value="0">Admin</option>
    <option value="1">Voyageur</option>
    <option value="2">Prestataire</option>
    <option value="3">Proprietaire</option>
</select>

            </div>
            <button type="submit" class="btn btn-primary btn-centered">Mettre à jour</button>
        </form>
        <br><br>

    </div>
</div>

<footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

<script>
var allUsers = [];

function fetchUsers() {
    fetch('http://localhost:5000/user')
    .then(response => response.json())
    .then(users => {
        allUsers = users;
        displayUsers(users);
    })
    .catch(error => console.error('Erreur lors de la récupération des utilisateurs:', error));
}

function displayUsers(users) {
    const userList = document.getElementById('userList');
    userList.innerHTML = users.map(user => `
        <tr>
            <td>${user.email}</td>
            <td>${user.nom}</td>
            <td>${user.prenom}</td>
            <td>${user.telephone}</td>
            <td>${user.type}</td>
            <td>
            <button class="btn-custom" onclick="toggleUpdateForm('${user.id}', '${user.email}', '${user.nom}', '${user.prenom}', '${user.telephone}', '${user.type}')">Modifier</button>
            <button class="btn-custom" onclick="deleteUser('${user.id}')">Supprimer</button>
            <button class="btn-custom" onclick="banUser('${user.id}', '${user.type}')">Bannir</button>


            </td>
        </tr>
    `).join('');
}

function toggleCreateForm() {
    var createForm = document.getElementById('createForm');
    createForm.style.display = createForm.style.display === 'none' ? 'block' : 'none';
    document.getElementById('updateForm').style.display = 'none';
}

function toggleUpdateForm(id, email, nom, prenom, telephone, type) {
    var updateForm = document.getElementById('updateForm');
    // Vérifie si le formulaire de mise à jour est déjà ouvert pour le même utilisateur
    if(updateForm.style.display === 'block' && document.getElementById('updateId').value === id) {
        updateForm.style.display = 'none'; // Cache le formulaire si c'est le même utilisateur
    } else {
        // Sinon, met à jour les champs du formulaire avec les données de l'utilisateur et affiche le formulaire
        document.getElementById('updateId').value = id;
        document.getElementById('updateEmail').value = email;
        document.getElementById('updateNom').value = nom;
        document.getElementById('updatePrenom').value = prenom;
        document.getElementById('updateTelephone').value = telephone;
        document.getElementById('updateType').value = type;
        updateForm.style.display = 'block';
        document.getElementById('createForm').style.display = 'none'; // Cache le formulaire de création au cas où il est ouvert
    }
}


document.getElementById('userCreateForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('createEmail').value;
    const nom = document.getElementById('createNom').value;
    const prenom = document.getElementById('createPrenom').value;
    const telephone = document.getElementById('createTelephone').value;
    const type = document.getElementById('createType').value;

    fetch('http://localhost:5000/user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, nom, prenom, telephone, type }),
    })
    .then(response => response.json())
    .then(data => {
        fetchUsers();
        document.getElementById('createForm').style.display = 'none';
    })
    .catch(error => console.error('Erreur lors de la création de l\'utilisateur:', error));
});

document.getElementById('userUpdateForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const id = document.getElementById('updateId').value;
    const email = document.getElementById('updateEmail').value;
    const nom = document.getElementById('updateNom').value;
    const prenom = document.getElementById('updatePrenom').value;
    const telephone = document.getElementById('updateTelephone').value;
    const type = document.getElementById('updateType').value;

    fetch(`http://localhost:5000/user/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, nom, prenom, telephone, type }),
    })
    .then(response => response.json())
    .then(data => {
        fetchUsers();
        document.getElementById('updateForm').style.display = 'none';
    })
    .catch(error => console.error('Erreur lors de la mise à jour de l\'utilisateur:', error));
});

function filterByType() {
    const type = document.getElementById("typeFilter").value;

    // Construire l'URL en fonction de la sélection de l'utilisateur
    let url = 'http://localhost:5000/user';
    if (type) {
        url += '/filter/' + type; // Filtrer si un type spécifique est sélectionné
    }

    fetch(url)
    .then(response => response.json())
    .then(users => {
        displayUsers(users);
    })
    .catch(error => console.error('Erreur lors de la récupération des utilisateurs:', error));
}





function deleteUser(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
        fetch(`http://localhost:5000/user/${id}`, {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse réseau non OK');
            }
            fetchUsers();
        })
        .catch(error => console.error('Erreur lors de la suppression de l\'utilisateur:', error));
    }
}

function searchUser() {
    var input, filter, userList, tr, td, i, txtValue;
    input = document.getElementById('searchBar');
    filter = input.value.toUpperCase();
    userList = document.getElementById('userList');
    tr = userList.getElementsByTagName('tr');

    // Boucle à travers toutes les lignes du tableau et cache celles qui ne correspondent pas à la recherche
    for (i = 0; i < tr.length; i++) {
        // Modifier l'index 0 en fonction de la colonne que vous voulez rechercher, ici 0 pour email
        td = tr[i].getElementsByTagName('td')[0]; // Choisissez l'index de la colonne email
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }       
    }
}


document.addEventListener('DOMContentLoaded', fetchUsers);
</script>
</body>
</html>
