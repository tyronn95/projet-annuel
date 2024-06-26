<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>

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
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">À propos</a>
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
    <a href="login.php">
            <span class="fas fa-user" aria-hidden="true"></span>
            </a>   
  </div>
</nav>

<div class="text-center mt-5">
    <h1>PCS PRESTIGE</h1>
    <div class="compact-text">
        <p>"Bienvenue chez Paris TakeCare Service Prestige, votre partenaire de confiance pour une expérience de location saisonnière exceptionnelle au cœur de Paris. Fondée en 2018, notre chaîne de conciergeries immobilières se distingue par son engagement envers l'excellence, offrant une gamme complète de services de gestion locative qui simplifient la vie des propriétaires et enrichissent le séjour des voyageurs."</p>
    </div>
</div>


<script>

document.addEventListener('DOMContentLoaded', (event) => {
    let index = 0; // L'index du slide actuellement visible
    const slides = document.querySelectorAll('.col-md-3');
    const totalSlides = slides.length;

    // Fonction pour mettre à jour l'affichage des slides
    function updateSlides(position) {
        // Cacher tous les slides
        slides.forEach(slide => {
            slide.style.display = 'none';
        });

        // Afficher le slide actuel
        slides[position].style.display = 'flex';
    }

    // Afficher le premier slide
    updateSlides(index);

    // Gérer le clic sur le bouton 'précédent'
    document.getElementById('prevBtn').addEventListener('click', () => {
        index = index - 1 < 0 ? totalSlides - 1 : index - 1;
        updateSlides(index);
    });

    // Gérer le clic sur le bouton 'suivant'
    document.getElementById('nextBtn').addEventListener('click', () => {
        index = (index + 1) % totalSlides;
        updateSlides(index);
    });
});

  
    </script>


<div class="container-fluid mt-5">

  <div class="row g-4">
    <div class="col-md-3 d-flex">
      <div class="content-container p-3 d-flex flex-column">
        <img src="mouvement.png" alt="Réactivité" class="icon">
        <h3>RÉACTIVITÉ</h3>
        <p>Chez PCS Prestige, votre tranquillité d'esprit est notre priorité absolue. Nous répondons avec célérité et efficacité, assurant une prise en charge instantanée de chaque demande, à tout moment.</p>
      </div>
    </div>
        <div class="col-md-3 d-flex">
          <div class="content-container p-3 d-flex flex-column">
            <img src="humanitaire.png" alt="Réactivité" class="icon">
            <h3>HUMAIN</h3>
            <p>Notre approche, fondée sur la proximité et l'écoute, fait de PCS Prestige une entreprise où chaque relation est cultivée avec soin, garantissant une expérience unique et sur-mesure, aussi personnelle que votre demeure.</p>
          </div>
        </div>
            <div class="col-md-3 d-flex">
              <div class="content-container p-3 d-flex flex-column">
                <img src="confort.png" alt="Réactivité" class="icon">
                <h3>CONFORT</h3>
                <p>Nous anticipons et orchestrons chaque détail pour vous. PCS Prestige s'engage à alléger votre quotidien en gérant avec finesse l'ensemble des aspects de votre propriété, vous libérant ainsi pour savourer la vie sans les contraintes de gestion.</p>
              </div>
            </div>
                <div class="col-md-3 d-flex">
                  <div class="content-container p-3 d-flex flex-column">
                    <img src="mouvement.png" alt="Réactivité" class="icon">
                    <h3>LONG TERME</h3>
                    <p>Avec PCS Prestige, bénéficiez d'une vision à long terme. Nos concierges, formés à l'excellence, prévoient et résolvent toute éventualité, vous assurant sérénité et bien-être au quotidien.</p>
                  </div>
          </div>
    </div>
  </div>
  <br><br>
  <div class="text-center mt-5">

<h1>OÙ SOMMES-NOUS ?</h1> 
</div>
<br><br>
  <div class="container_paris">
    <div class="content">
      <h2>Sur Paris et ses arrondissements</h2>
      <div class="img_paris">
        <img src="tour-eiffel.jpg" alt="Image Paris">
      </div>
    </div>
    <div class="text-container">
      <span class="underline">Agence Principale :</span> <br> - 23 rue Montorgueil situé dans le 2ème arrondissement <br><br>
        
      <span class="underline">Autres agences à Paris :</span> <br>
        
        - 1er, 3ème, 4ème, 5ème, 6ème, et 18ème arrondissements
        
        
        </p><br><br>
      <a href="en_savoir_plus.html" class="en-savoir-plus">En savoir +</a>
    </div>
  </div>

  <br><br>  
 <!-- Container Plage -->
  <div class="container_plage">
    <div class="content">
      <h2>Les plages ensoleillées</h2>
      <div class="img_plage">
        <img src="plage.jpg" alt="Image Plage">
      </div>
    </div>
    <div class="text-container">
      <p><span class="underline">Troyes</span> : <br>
        - 14 Rue de la République <br> </p>
      
      <p><span class="underline">Nice</span> : <br>
        - 26 Boulevard Gambetta <br></p>
      
      <p><span class="underline">Biarritz</span> : <br>
        - 3 Avenue de l'Impératrice <br></p>
      
    
    
      <a href="en_savoir_plus.html" class="en-savoir-plus">En savoir +</a>
    </div>
  </div>
  <br><br>  <br><br>
  <br><br>


 
  <footer>
    
    <h1 class="h1-footer">©2024 PCS Prestige | Mentions légales | CGV </h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <div class="social-icons">
      <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
      <a href="https://snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
      <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
  </div>
  </footer>


<!-- JavaScript Bundle avec Popper pour Bootstrap 5 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha384-8q9NftF8LQmgz2YiILHv/ZJ5yy2BZXz4WS3gh0w8AYV3T7445jfgPJiGGDUIw5P7" crossorigin="anonymous"></script>

</body>
</html>
