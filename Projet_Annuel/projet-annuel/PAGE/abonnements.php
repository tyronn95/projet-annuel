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
    <h1 class="mb-4 text-center">Nos Abonnements - Voyageur</h1>
    <br><br>
    <div class="vip-subscription-container">
    <div class="vip-plan free-tier">
        <div class="icon-container">
            <img src="../GLOBAL/img/free-icon.png" alt="Free Icon" class="vip-plan-icon">
        </div>
        <h2 class="vip-plan-title">Free</h2>
        <p class="vip-plan-price">Gratuit</p>
        <ul class="vip-plan-features">
            <li>Présence de publicités dans le contenu consulté</li>
            <li>Commenter, publier des avis</li>
            <li>Pas de réduction permanente</li>
            <li>Pas de prestations offertes</li>
            <li>Pas d'accès prioritaire</li>
            <li>Pas de bonus au renouvellement</li>
        </ul>
        <br>
        <button class="btn subscribe-btn" data-plan-id="1">S'abonner</button>
    </div>

    <div class="vip-plan bag-packer-tier">
        <div class="icon-container">
            <img src="../GLOBAL/img/bag-packer-icon.png" alt="Bag Packer Icon" class="vip-plan-icon">
        </div>
        <h2 class="vip-plan-title">Bag Packer</h2>
        <p class="vip-plan-price">9,90€ / mois ou 113€ / an</p>
        <ul class="vip-plan-features">
            <li>Pas de publicités</li>
            <li>Commenter, publier des avis</li>
            <li>Pas de réduction permanente</li>
            <li>1 prestation offerte par an jusqu'à 80€</li>
            <li>Pas d'accès prioritaire</li>
            <li>Pas de bonus au renouvellement</li>
        </ul>
        <br>
        <button class="btn subscribe-btn" data-plan-id="2">S'abonner</button>
    </div>

    <div class="vip-plan explorator-tier">
        <div class="icon-container">
            <img src="../GLOBAL/img/explorator-icon.png" alt="Explorator Icon" class="vip-plan-icon">
        </div>
        <h2 class="vip-plan-title">Explorator</h2>
        <p class="vip-plan-price">19€ / mois ou 220€ / an</p>
        <ul class="vip-plan-features">
            <li>Pas de publicités</li>
            <li>Commenter, publier des avis</li>
            <li>Réduction de 5% sur les prestations</li>
            <li>1 prestation offerte par semestre, sans limite de montant</li>
            <li>Accès prioritaire aux prestations VIP</li>
            <li>Réduction de 10% sur le renouvellement annuel</li>
        </ul>
        <button class="btn subscribe-btn" data-plan-id="3">S'abonner</button>
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
    // Passer l'ID de l'utilisateur connecté à JavaScript
    var userId = <?php echo json_encode($_SESSION['id']); ?>;
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const subscribeButtons = document.querySelectorAll('.subscribe-btn');

    subscribeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const planId = this.dataset.planId;
            const today = new Date();
            const nextYear = new Date(today.getFullYear() + 1, today.getMonth(), today.getDate());

            fetch('http://localhost:5000/subscription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    utilisateur_id: userId,
                    abonnement_id: planId,
                    date_debut: today.toISOString().slice(0, 10),
                    date_expiration: nextYear.toISOString().slice(0, 10)
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.error) {
                    alert('Erreur lors de la souscription : ' + data.error);
                } else {
                    alert('Abonnement souscrit avec succès !');
                }
            })
            .catch(error => {
                console.error('Erreur lors de la souscription :', error);
                alert('Erreur lors de la souscription : ' + error.message);
            });
        });
    });
});
</script>

</body>
</html>
