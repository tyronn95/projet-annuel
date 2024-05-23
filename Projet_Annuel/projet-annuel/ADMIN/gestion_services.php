<!-- 
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // L'utilisateur est connecté
    $userId = $_SESSION['id']; // Récupérer l'ID de l'utilisateur


    // Effectuer d'autres opérations comme des requêtes de base de données
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("location: ../PAGE/connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Services</title>
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
          <a class="nav-link active" aria-current="page" href="admin.php">Gestion Utilisateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_reservation.php">Reservation/Prestation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_prestation.php">Suivi Prestation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="suivi_abonnement.php">Suivi abonnement</a>
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
<br><br> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="mb-4 text-center">Gestion des Services</h1>    
    <form id="serviceForm">
        <input type="text" id="serviceName" placeholder="Nom du Service" required />
        <textarea id="serviceDescription" placeholder="Description" required></textarea>
        <input type="number" id="servicePrice" placeholder="Prix" required />
        <button type="submit">Ajouter un service</button>
    </form>
    <div id="servicesList"></div>
</div>

<script>
document.getElementById('serviceForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const name = document.getElementById('serviceName').value;
    const description = document.getElementById('serviceDescription').value;
    const price = parseFloat(document.getElementById('servicePrice').value);

    if (isNaN(price) || price < 0) {
        alert('Veuillez entrer un prix valide.');
        return;
    }

    const serviceData = {
        name: name,
        description: description,
        price: price
    };

    try {
        const response = await axios.post('http://localhost:5000/api/services/add', serviceData);
        const addedService = response.data;
        const serviceElement = document.createElement('div');
        serviceElement.innerHTML = `<h3>${addedService.name}</h3><p>${addedService.description}</p><p>Prix: ${addedService.price} €</p>`;
        document.getElementById('servicesList').appendChild(serviceElement);
        document.getElementById('serviceForm').reset();
        alert('Service ajouté avec succès!');
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l’ajout du service: ' + error.response.data.message);
    }
});
</script>
</body>
</html>
