<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="styles.css" rel="stylesheet">
    <?php require_once "verif.php";
    verifierSessionUtilisateur(); ?>
</head>
<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light header-bg">
            <a class="navbar-brand" href="/">
                <img src="logo.png" alt="Votre Logo" style="height: 200px; width: auto;">
            </a>
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" src="pdf.php">À propos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Abonnements</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <a href="connexion.html">
                    <span class="fas fa-user" aria-hidden="true"></span> <!-- Icône (nécessite FontAwesome) -->
                </a>
            </div>
        </div>
        </nav>
            <div class="container" id="cDocument">
                <div id="choisirBien">
                    <p style = "font-weight: bold; text-decoration: underline;">• Veuillez choisir le bien concerné : </p><a class="btn btn-primary" >Choisir le bien</a>
                </div>
                <p style = "font-weight: bold; text-decoration: underline;">• Vous voulez avoir accès : </p>
                <div id=pdf>
                    <div id="etatLieux">
                        <p style = "text-decoration: underline;">• Aux documents relatifs à l’état des lieux : </p><a href="état-des-lieux.pdf" download="état_des_lieux.pdf" class="btn btn-primary" >Cliquez ici</a>
                    </div>
                    <div id="intervention">
                        <p style = "text-decoration: underline;">• Suivi d’intervention des prestataires :</p><a href="fiche-d'intervention.pdf" download="fiche_d'intervention.pdf" class="btn btn-primary" >Cliquez ici</a>
                    </div>
                    <div id="finance">
                        <p style = "text-decoration: underline;">• Récapitulatif des finances : </p><a href="pdf.pdf" download="récapitulatif.pdf" class="btn btn-primary">Cliquez ici</a>
                    </div>
                </div>
                <div id = "devis">
                    <p style = "font-weight: bold; text-decoration: underline;">• Vous voulez faire un devis ?  </p><a href="devis.pdf" download="devis.pdf" class="btn btn-primary">Cliquez ici</a>
                </div>
            </div>
    </main>    
</body>