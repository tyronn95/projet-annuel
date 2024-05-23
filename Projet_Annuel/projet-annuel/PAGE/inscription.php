<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- CSS de Bootstrap 5 -->
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


<br><br>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="registration-box shadow rounded">
        <br><br>
        <h2 class="inscription-title">Inscription</h2><br>
        <form action="verif_inscription.php" method="POST">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="firstName" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required placeholder="Écrivez votre nom ...">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lastName" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="Écrivez votre prénom ...">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="age" class="form-label">Âge :</label>
                    <input type="number" class="form-control" id="age" name="age" required placeholder="JJ/MM/AAAA">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="address" class="form-label">Adresse :</label>
                    <input type="text" class="form-control" id="address" name="address" required placeholder="Écrivez votre adresse ..."> 
                </div>
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">Ville :</label>
                    <input type="text" class="form-control" id="city" name="city" required placeholder="Écrivez votre ville ...">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="country" class="form-label">Pays :</label>
                    <input type="text" class="form-control" id="country" name="country" required placeholder="Écrivez votre pays ...">
                </div>
            </div>
            <div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="phone" class="form-label">Numéro de téléphone :</label>
        <input type="text" class="form-control" id="phone" name="phone" required placeholder="Écrivez votre numéro de téléphone ...">
    </div>
    <div class="col-md-6 mb-3">
        <label for="type" class="form-label">Type de compte :</label>
        <select class="form-control" id="type" name="type" required>
            <option value="1">Voyageur</option>
            <option value="2">Prestataire</option>
            <option value="3">Bailleur</option>
        </select>
    </div>
</div>


            <div class="center-input"> 
                    <label for="email" class="form-label" style="margin-right:450px;">Email :</label>
                    <input type="email" class="form-control custom-email" id="email" name="email" required placeholder="Entrez votre email ...">
            </div>
            <div class="center-input"> 
                <div class="mb-6">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control small-input" id="password" name="password" required placeholder="Écrivez votre mots de passe ...">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-custom">S'inscrire</button>
        </form>
        <div class="text-center mt-4">
            <span class="link-text-bold">Vous avez déjà un compte ?&nbsp;</span> 
            <a href="#" class="custom-link">Connectez-vous</a>
        </div>
    </div>
</div>

  <footer>

    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>
</body>
</html>