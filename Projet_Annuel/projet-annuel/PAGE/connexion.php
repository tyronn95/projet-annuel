<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Gestion des Utilisateurs</title>
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
    <div class="login-box shadow rounded">
        <br><br>
    <h2 class="text-center-black mb-4">Connexion</h2>
    <br><br>
    <form action="verif_connexion.php" method="post">
        <div class="mb-3">
          &nbsp; &nbsp;  <label for="email" class="form-label">Nom d'utilisateur:</label>
          <input type="text" class="form-control custom-input" id="username" name="email" placeholder="Écrivez votre nom d'utilisateur...">
        </div>
        <div class="mb-3">
        &nbsp; &nbsp; <label for="password" class="form-label">Mot de passe:</label>
        <input type="password" class="form-control custom-input" id="password" name="password" placeholder="Écrivez votre mot de passe...">
        </div>

        <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="rememberMe">
  <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
</div>

        <br>
        <button type="submit" class="btn custom-button w-100">SE CONNECTER</button>
        <br>
      </form>
      <div class="text-center mt-4">
  <span class="link-text-bold">Vous n'avez pas de compte ?&nbsp;</span> <a href="inscription.php" class="custom-link">Inscrivez-vous</a><br>
  <span class="link-text-bold">Vous ne vous souvenez plus du mot de passe ?&nbsp;</span> <a href="#" class="custom-link">Mots de passe oublié</a>
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