
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vos données</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link href="../../GLOBAL/css/styles.css" rel="stylesheet">
</head>
<body>
<header>
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
                                <a class="nav-link active" aria-current="page" href="index.html">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="services.php">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="a_propos.html">À propos</a>
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
                        <span class="fas fa-user" aria-hidden="true"></span>
                    </div>
                </div>
            </nav>
        </header>
	<h1>Liste des utilisateurs</h1>
	<table>
		<thead>
			<th >Nom</th>
			<th>Adresse</th>
			<th>Date du devis</th>
			<th>Numéro du devis</th>
			<th>salaire</td>	
			<th>id</td>	
		</thead>
		<tbody>
			<tr>
				<td>Jean</td>
				<td>4 rue du du pont neuf</td>
				<td>27/12/04</td>
				<td>4f65f </td>
				<td>50e/h</td>
				<td> <? echo $biens[0][0] ?></td>	

				<td> <? echo $biens[0][1] ?></td>	
				<td> <? echo $biens[0][2] ?></td>	
				<td> <? echo $biens[0][3] ?></td>	
				<tr>
		</tbody>
	</table>
</body>
</html>
