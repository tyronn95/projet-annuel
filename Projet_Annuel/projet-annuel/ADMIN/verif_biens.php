<?php
include '../GLOBAL/includes/session_verif.php';

// Connexion à la base de données
include '../GLOBAL/db/db_config.php';

// Récupérer les propriétés en attente de validation
$query = "SELECT * FROM proprietes WHERE statut = 'en_attente'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification des Biens</title>
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
                    <a class="nav-link active" aria-current="page" href="admin_dashboard.php">Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="verif_biens.php">Vérification des Biens</a>
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

<div class="container mt-5">
    <h2 class="mb-4 text-center">Vérification des Biens</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['propriete_id']; ?></td>
                    <td><?php echo $row['titre']; ?></td>
                    <td><?php echo $row['type_propriete']; ?></td>
                    <td><?php echo $row['adresse']; ?></td>
                    <td><?php echo $row['ville']; ?></td>
                    <td><?php echo $row['code_postal']; ?></td>
                    <td>
                        <button class="btn btn-info" onclick="viewDetails(<?php echo $row['propriete_id']; ?>)">Voir +</button>
                        <button class="btn btn-success" onclick="validateProperty(<?php echo $row['propriete_id']; ?>)">Valider</button>
                        <button class="btn btn-danger" onclick="rejectProperty(<?php echo $row['propriete_id']; ?>)">Rejeter</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
function viewDetails(id) {
    // Logique pour afficher les détails d'une propriété
    $.ajax({
        url: `http://localhost:5000/api/proprietes/details/${id}`,
        method: 'GET',
        success: function(data) {
            let detailsModal = $('#propertyDetails');
            detailsModal.empty();
            detailsModal.append(`
                <p><strong>ID:</strong> ${data.propriete_id}</p>
                <p><strong>Titre:</strong> ${data.titre}</p>
                <p><strong>Type:</strong> ${data.type_propriete}</p>
                <p><strong>Adresse:</strong> ${data.adresse}</p>
                <p><strong>Ville:</strong> ${data.ville}</p>
                <p><strong>Code Postal:</strong> ${data.code_postal}</p>
                <p><strong>Pays:</strong> ${data.pays}</p>
                <p><strong>Phrase d'accroche:</strong> ${data.phrase_accroche}</p>
                <p><strong>Description:</strong> ${data.description}</p>
                <p><strong>Nombre de Chambres:</strong> ${data.nombre_chambres}</p>
                <p><strong>Nombre de Salles de Bain:</strong> ${data.nombre_salles_de_bain}</p>
                <p><strong>Superficie (m²):</strong> ${data.superficie}</p>
                <p><strong>Capacité:</strong> ${data.capacite}</p>
                <p><strong>Disponible à partir de:</strong> ${data.date_disponibilite}</p>
                <p><strong>Date de Visite:</strong> ${data.date_visite}</p>
                <p><strong>Photos:</strong></p>
                <div>${data.photos.split(',').map(photo => `<img src="../GLOBAL/img/${photo}" alt="Photo du bien" style="width: 100px; height: auto;">`).join('')}</div>
            `);
            $('#detailsModal').modal('show');
        },
        error: function(err) {
            console.error('Erreur lors de la récupération des détails de la propriété:', err);
        }
    });
}

function validateProperty(id) {
    $.ajax({
        url: `http://localhost:5000/api/proprietes/${id}/validate`,
        method: 'POST',
        success: function() {
            alert('Propriété validée avec succès!');
            location.reload();
        },
        error: function(err) {
            console.error('Erreur lors de la validation de la propriété:', err);
        }
    });
}

function rejectProperty(id) {
    $.ajax({
        url: `http://localhost:5000/api/proprietes/${id}/reject`,
        method: 'POST',
        success: function() {
            alert('Propriété rejetée avec succès!');
            location.reload();
        },
        error: function(err) {
            console.error('Erreur lors du rejet de la propriété:', err);
        }
    });
}
</script>

<!-- Modal pour afficher les détails -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Détails de la Propriété</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="propertyDetails">
                <!-- Les détails de la propriété seront chargés ici via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
