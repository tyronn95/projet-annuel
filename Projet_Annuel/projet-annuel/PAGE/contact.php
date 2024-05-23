
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
    <h1 class="styled-title mb-4 text-center">CONTACTEZ-NOUS</h1>
    <br><br>
    <div class="contact-container">
    <div class="contact-section phone">
        <img class="contact-icon" src="../GLOBAL/img/phone-icon.png" alt="Phone">
        <h3 class="contact-title">Par téléphone</h3>
        <p class="contact-description">Appelez-nous au: +33 1 87 66 88 43 (du lundi au samedi de 10h à 19h)</p>
        <button class="contact-button">Une question ?</button>
    </div>
    <div class="contact-section chat">
        <img class="contact-icon" src="../GLOBAL/img/chat-icon.png" alt="Chat">
        <h3 class="contact-title">Par chat</h3>
        <p class="contact-description">Posez-nous toutes vos questions en cliquant sur le chat en bas à gauche de chaque page</p>
        <button class="contact-button">Commencez à chatter</button>
    </div>
    <div class="contact-section email">
        <img class="contact-icon" src="../GLOBAL/img/email-icon.png" alt="Email">
        <h3 class="contact-title">Par mail</h3>
        <p class="contact-description">Écrivez-nous sur l'adresse mail: contact@pcs_prestige.com</p>
        <button class="contact-button">Contactez-nous</button>
    </div>
</div>

<br>

<hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">

<br><br>

<h1 class="styled-title mb-4 text-center">UNE SUGGESTION ?</h1>


<div class="custom-form-container">
    <form class="custom-message-form">
        <div class="custom-form-group">
            <label for="customName">Votre Nom:</label>
            <input type="text" class="custom-form-control" id="customName" placeholder="Entrez votre nom">
        </div>
        <div class="custom-form-group">
            <label for="customEmail">Votre Email:</label>
            <input type="email" class="custom-form-control" id="customEmail" placeholder="Entrez votre email">
        </div>
        <div class="custom-form-group">
            <label for="customMessage">Message:</label>
            <textarea class="custom-form-control" id="customMessage" rows="5" placeholder="Votre message"></textarea>
        </div>
        <button type="button" class="custom-send-button">Envoyer</button>
    </form>
</div>



    <footer>
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1>
    <div class="social-icons">
        <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
        <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</footer>
</body>
</html>