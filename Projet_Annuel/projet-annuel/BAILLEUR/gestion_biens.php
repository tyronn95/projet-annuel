<?php
include '../GLOBAL/includes/session_verif.php';
$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
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
                    <a class="nav-link active" aria-current="page" href="calendrier_bailleur.php">Calendrier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="gestion_biens.php">Gestion des Biens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form_bien.php">Ajout de propriété</a>
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
    <h2 class="mb-4 text-center">Gestion des Biens</h2>
    <div class="row justify-content-center">
        <div class="col-auto">
            <button class="btn mb-4" onclick="showAddPropertyModal()" style="width:300px;">Ajouter une propriété</button>
        </div>
    </div>    <table class="table table-bordered" id="propertiesTable">
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
            <!-- Les propriétés seront chargées ici via JavaScript -->
        </tbody>
    </table>
</div>

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

<!-- Modal pour ajouter ou modifier une propriété -->
<div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="propertyModalLabel">Ajouter une Propriété</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="propertyForm">
                    <input type="hidden" id="propertyId">
                    <div class="form-group">
                        <label for="type_propriete">Type de propriété :</label>
                        <input type="text" id="type_propriete" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" id="titre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse :</label>
                        <input type="text" id="adresse" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville :</label>
                        <input type="text" id="ville" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="code_postal">Code Postal :</label>
                        <input type="text" id="code_postal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pays">Pays :</label>
                        <input type="text" id="pays" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phrase_accroche">Phrase d'accroche :</label>
                        <input type="text" id="phrase_accroche" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nombre_chambres">Nombre de Chambres :</label>
                        <input type="number" id="nombre_chambres" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_salles_de_bain">Nombre de Salles de Bain :</label>
                        <input type="number" id="nombre_salles_de_bain" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="superficie">Superficie (m²) :</label>
                        <input type="number" id="superficie" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="capacite">Capacité :</label>
                        <input type="number" id="capacite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date_disponibilite">Disponible à partir de :</label>
                        <input type="date" id="date_disponibilite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date_visite">Date de Visite :</label>
                        <input type="date" id="date_visite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="photos">Photos :</label>
                        <input type="file" id="photos" name="photos" class="form-control">
                    </div>
                    <button type="submit" class="btn">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV</h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    const userId = <?php echo json_encode($userId); ?>;
    if (!userId) {
        console.error('Erreur : ID utilisateur non défini');
        return;
    }
    console.log('ID utilisateur :', userId);
    fetchProperties(userId);

    function fetchProperties(userId) {
        $.ajax({
            url: `http://localhost:5000/api/proprietes/${userId}`,
            method: 'GET',
            success: function(data) {
                console.log('Données reçues :', data); // Log des données reçues pour déboguer
                let propertiesTable = $('#propertiesTable tbody');
                propertiesTable.empty();
                let hasPendingProperties = false;

                data.forEach(property => {
                    if (property.statut === 'valide') {
                        propertiesTable.append(`
                            <tr>
                                <td>${property.propriete_id}</td>
                                <td>${property.titre}</td>
                                <td>${property.type_propriete}</td>
                                <td>${property.adresse}</td>
                                <td>${property.ville}</td>
                                <td>${property.code_postal}</td>
                                <td>
                                    <button class="btn" onclick="viewDetails(${property.propriete_id})" style = "margin:5px;">Voir +</button>
                                    <button class="btn" onclick="showEditPropertyModal(${property.propriete_id})"style = "margin:5px;">Modifier</button>
                                    <button class="btn" onclick="deleteProperty(${property.propriete_id})"style = "margin:5px;">Supprimer</button>
                                </td>
                            </tr>
                        `);
                    } else {
                        hasPendingProperties = true;
                    }
                });

                if (propertiesTable.children().length === 0) {
                    propertiesTable.append('<tr><td colspan="7" class="text-center">Aucune propriété trouvée</td></tr>');
                }

                if (hasPendingProperties) {
                    $('#pendingPropertiesMessage').show();
                } else {
                    $('#pendingPropertiesMessage').hide();
                }
            },
            error: function(err) {
                console.error('Erreur lors de la récupération des propriétés:', err);
            }
        });
    }

    window.viewDetails = function(id) {
        $.ajax({
            url: `http://localhost:5000/api/proprietes/details/${id}`,
            method: 'GET',
            success: function(data) {
                console.log('Détails de la propriété reçus :', data); // Log des détails de la propriété pour déboguer
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

    window.showAddPropertyModal = function() {
        $('#propertyModalLabel').text('Ajouter une Propriété');
        $('#propertyForm').trigger('reset');
        $('#propertyId').val('');
        $('#propertyModal').modal('show');
    }

    window.showEditPropertyModal = function(id) {
        $.ajax({
            url: `http://localhost:5000/api/proprietes/details/${id}`,
            method: 'GET',
            success: function(data) {
                $('#propertyModalLabel').text('Modifier la Propriété');
                $('#propertyId').val(data.propriete_id);
                $('#type_propriete').val(data.type_propriete);
                $('#titre').val(data.titre);
                $('#adresse').val(data.adresse);
                $('#ville').val(data.ville);
                $('#code_postal').val(data.code_postal);
                $('#pays').val(data.pays);
                $('#phrase_accroche').val(data.phrase_accroche);
                $('#description').val(data.description);
                $('#nombre_chambres').val(data.nombre_chambres);
                $('#nombre_salles_de_bain').val(data.nombre_salles_de_bain);
                $('#superficie').val(data.superficie);
                $('#capacite').val(data.capacite);
                $('#date_disponibilite').val(data.date_disponibilite);
                $('#date_visite').val(data.date_visite);
                $('#photos').val(data.photos);
                $('#propertyModal').modal('show');
            },
            error: function(err) {
                console.error('Erreur lors de la récupération des détails de la propriété:', err);
            }
        });
    }

    $('#propertyForm').on('submit', function(event) {
        event.preventDefault();
        const propertyId = $('#propertyId').val();
        const url = propertyId ? `http://localhost:5000/api/proprietes/${propertyId}` : 'http://localhost:5000/api/proprietes';
        const method = propertyId ? 'PUT' : 'POST';
        const propertyData = {
            type_propriete: $('#type_propriete').val(),
            titre: $('#titre').val(),
            adresse: $('#adresse').val(),
            ville: $('#ville').val(),
            code_postal: $('#code_postal').val(),
            pays: $('#pays').val(),
            phrase_accroche: $('#phrase_accroche').val(),
            description: $('#description').val(),
            nombre_chambres: $('#nombre_chambres').val(),
            nombre_salles_de_bain: $('#nombre_salles_de_bain').val(),
            superficie: $('#superficie').val(),
            capacite: $('#capacite').val(),
            date_disponibilite: $('#date_disponibilite').val(),
            date_visite: $('#date_visite').val(),
            photos: $('#photos').val(),
            proprietaire_id: userId,
            statut: 'en_attente' // Ajout du statut
        };

        $.ajax({
            url: url,
            method: method,
            contentType: 'application/json',
            data: JSON.stringify(propertyData),
            success: function() {
                $('#propertyModal').modal('hide');
                alert('Votre propriété est en attente de validation par l\'administrateur.');
                fetchProperties(userId);
            },
            error: function(err) {
                console.error('Erreur lors de l\'enregistrement de la propriété:', err);
            }
        });
    });

    window.deleteProperty = function(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce bien ?')) {
            $.ajax({
                url: `http://localhost:5000/api/proprietes/${id}`,
                method: 'DELETE',
                success: function() {
                    alert('Propriété supprimée avec succès!');
                    fetchProperties(userId);
                },
                error: function(err) {
                    console.error('Erreur lors de la suppression de la propriété:', err);
                }
            });
        }
    }
});
</script>

<div id="pendingPropertiesMessage" class="alert text-center" style="display: none; background-color:#BAA06A; color:black; ">
    Certains de vos biens sont en attente de validation par l'administrateur et n'apparaîtront pas ici jusqu'à ce qu'ils soient validés.
</div>

</body>
</html>
