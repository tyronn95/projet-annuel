<?php
include '../GLOBAL/includes/session_verif.php';
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

<div class="custom-form-container">
    <h1 class="custom-form-title">Formulaire d'Ajout de Propriété</h1>
    <form action="verif_form_bien.php" method="POST" enctype="multipart/form-data">
        <div class="custom-form-group">
            <label for="property-type" class="custom-form-label">Type de propriété :</label>
            <select id="property-type" name="property_type" class="custom-form-select" required>
                <option value="">Choisissez</option>
                <option value="house">Maison</option>
                <option value="apartment">Appartement</option>
                <option value="studio">Studio</option>
            </select>
            <?php if (!empty($errors['property_type'])) : ?>
                <div class="error-message"><?php echo $errors['property_type']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="title" class="custom-form-label">Titre de l'annonce :</label>
            <input type="text" id="title" name="title" class="custom-form-input" required>
            <?php if (!empty($errors['title'])) : ?>
                <div class="error-message"><?php echo $errors['title']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="address" class="custom-form-label">Adresse du Bien :</label>
            <input type="text" id="address" name="address" class="custom-form-input" required>
            <?php if (!empty($errors['address'])) : ?>
                <div class="error-message"><?php echo $errors['address']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-inline-group">
            <div class="custom-form-group">
                <label for="city" class="custom-form-label">Ville :</label>
                <input type="text" id="city" name="city" class="custom-form-input" required>
                <?php if (!empty($errors['city'])) : ?>
                    <div class="error-message"><?php echo $errors['city']; ?></div>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="postal-code" class="custom-form-label">Code postal :</label>
                <input type="text" id="postal-code" name="postal_code" class="custom-form-input" required>
                <?php if (!empty($errors['postal_code'])) : ?>
                    <div class="error-message"><?php echo $errors['postal_code']; ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="custom-form-group">
            <label for="country" class="custom-form-label">Pays :</label>
            <input type="text" id="country" name="country" class="custom-form-input" required>
            <?php if (!empty($errors['country'])) : ?>
                <div class="error-message"><?php echo $errors['country']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="catchphrase" class="custom-form-label">Phrase d'accroche :</label>
            <input type="text" id="catchphrase" name="catchphrase" class="custom-form-input" required>
            <?php if (!empty($errors['catchphrase'])) : ?>
                <div class="error-message"><?php echo $errors['catchphrase']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="description" class="custom-form-label">Description détaillée :</label>
            <textarea id="description" name="description" class="custom-form-textarea" rows="5" required></textarea>
            <?php if (!empty($errors['description'])) : ?>
                <div class="error-message"><?php echo $errors['description']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="photos" class="custom-form-label">Déposez vos photos ici :</label>
            <input type="file" id="photos" name="photos[]" class="custom-form-file" multiple required>
            <?php if (!empty($errors['photos'])) : ?>
                <div class="error-message"><?php echo $errors['photos']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-inline-group">
            <div class="custom-form-group">
                <label for="rooms" class="custom-form-label">Nombres de Chambres :</label>
                <select id="rooms" name="rooms" class="custom-form-select" required>
                    <option value="">Choisissez</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <?php if (!empty($errors['rooms'])) : ?>
                    <div class="error-message"><?php echo $errors['rooms']; ?></div>
                <?php endif; ?>
            </div>
            <div class="custom-form-group">
                <label for="bathrooms" class="custom-form-label">Nombres de salles de bains :</label>
                <input type="text" id="bathrooms" name="bathrooms" class="custom-form-input" required>
                <?php if (!empty($errors['bathrooms'])) : ?>
                    <div class="error-message"><?php echo $errors['bathrooms']; ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="custom-form-group">
            <label for="area" class="custom-form-label">Superficie (en m²) :</label>
            <input type="text" id="area" name="area" class="custom-form-input" required>
            <?php if (!empty($errors['area'])) : ?>
                <div class="error-message"><?php echo $errors['area']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="capacity" class="custom-form-label">Capacité d'Accueil :</label>
            <input type="text" id="capacity" name="capacity" class="custom-form-input" required>
            <?php if (!empty($errors['capacity'])) : ?>
                <div class="error-message"><?php echo $errors['capacity']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="availability-date" class="custom-form-label">Disponible à partir de :</label>
            <input type="date" id="availability-date" name="availability_date" class="custom-form-input" required>
            <?php if (!empty($errors['availability_date'])) : ?>
                <div class="error-message"><?php echo $errors['availability_date']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-group">
            <label for="visit-date" class="custom-form-label">Disponibilité pour une visite :</label>
            <input type="date" id="visit-date" name="visit_date" class="custom-form-input" required>
            <?php if (!empty($errors['visit_date'])) : ?>
                <div class="error-message"><?php echo $errors['visit_date']; ?></div>
            <?php endif; ?>
        </div>
        <div class="custom-form-checkbox-group">
            <input type="checkbox" id="not-robot" name="not_robot" class="custom-form-checkbox" required>
            <label for="not-robot" class="custom-form-label">Je ne suis pas un robot</label>
        </div>
        <div class="custom-form-note">
            Pour soumettre ce formulaire vous devez avoir lu et accepté notre politique de confidentialité
        </div>
        <div class="custom-form-group">
            <input type="submit" value="Envoyer" class="custom-form-submit">
        </div>
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
</body>
</html>
