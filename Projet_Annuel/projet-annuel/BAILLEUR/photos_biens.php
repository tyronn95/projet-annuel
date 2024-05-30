<?php
include '../GLOBAL/includes/session_verif.php';
$propriete_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$propriete_id) {
    echo "ID de propriété invalide.";
    exit;
}

// Connexion à la base de données
include '../GLOBAL/db/db_config.php';

// Récupérer les détails de la propriété, y compris les photos
$query = "SELECT photos FROM proprietes WHERE propriete_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $propriete_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $property = $result->fetch_assoc();
    $photos = explode(',', $property['photos']);
} else {
    echo "Propriété non trouvée.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos de la Propriété</title>
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
    <h2 class="mb-4 text-center">Photos de la Propriété</h2>
    <div class="row">
        <?php if (empty($photos)): ?>
            <div class="col-12 text-center">
                <p>Aucune photo trouvée pour cette propriété.</p>
            </div>
        <?php else: ?>
            <?php foreach ($photos as $photo): ?>
                <div class="col-md-4 mb-3">
                    <img src="<?php echo htmlspecialchars('../GLOBAL/img/' . $photo); ?>" alt="Photo du bien" class="img-fluid">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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
</body>
</html>
