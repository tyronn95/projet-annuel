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
    <h1 class="mb-4 text-center">À PROPOS</h1>
    <br><br>

    <div class="about-container">
        <!-- Bloc 1 : Image à gauche -->
        <div class="about-story-block image-left">
            <img src="../GLOBAL/img/history.jpg" alt="Histoire" class="about-icon">
            <div class="about-content">
                <h2 class="about-heading">Notre Histoire</h2>
                <br>
                <p class="about-text">Fondée en 1992, notre entreprise a démarré comme une petite startup dans le garage de notre fondateur, et s'est rapidement imposée comme un acteur majeur dans le domaine de la technologie. Depuis lors, nous avons élargi notre portée à l'international, avec des bureaux répartis sur quatre continents. Nous avons surmonté plusieurs défis économiques mondiaux, en adaptant constamment nos stratégies pour rester pertinents et compétitifs. Notre croissance a été guidée par notre passion pour l'excellence et notre dévotion à offrir des solutions innovantes qui répondent réellement aux besoins de nos clients.</p>
            </div>
        </div>
        <!-- Bloc 2 : Image à droite -->
        <div class="about-story-block image-right">
            <img src="../GLOBAL/img/img.jpg" alt="Missions" class="about-icon">
            <div class="about-content">
                <h2 class="about-heading">Nos Missions et Valeurs</h2>
                <br>
                <p class="about-text">Notre mission est de révolutionner l'industrie par des innovations qui améliorent non seulement la vie quotidienne de nos utilisateurs mais aussi l'environnement. Nos valeurs fondamentales sont l'intégrité, la responsabilité et le respect pour tous. Nous nous engageons à opérer de manière durable et éthique, en mettant toujours l'intérêt de nos clients et de l'environnement au premier plan. Chez nous, chaque membre de l'équipe est encouragé à prendre des initiatives et à s'exprimer, créant ainsi un environnement de travail dynamique et inclusif.</p>
            </div>
        </div>
        <!-- Bloc 3 : Image à gauche -->
        <div class="about-story-block image-left">
            <img src="../GLOBAL/img/engage.jpg" alt="Innovation" class="about-icon">
            <div class="about-content">
                <h2 class="about-heading">Engagement envers l'Innovation</h2>
                <br>
                <p class="about-text">Chez PCS Prestige, l'innovation est la pierre angulaire de tout ce que nous faisons. Nous investissons plus de 20% de nos bénéfices annuels dans la recherche et le développement. Nos équipes multidisciplinaires travaillent en collaboration pour développer des solutions avant-gardistes qui définissent les standards de demain. Nos projets récents incluent le développement de technologies d'intelligence artificielle qui aident à réduire l'empreinte carbone et améliorent l'efficacité énergétique des appareils électroniques. Notre approche holistique de l'innovation nous permet d'être à la pointe des tendances technologiques et de répondre proactivement aux attentes du marché.</p>
            </div>
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
</body>
</html>