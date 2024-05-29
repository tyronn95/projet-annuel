
<!DOCTYPE html>
<html>
<body>
	<h1>Devis</h1>
	<table style="background-color: gold">
		<thead>
            <th>pseudo</th>
			<th >id</th>
			<th>Adresse</th>
			<th>Date du devis</th>
			<th>salaire</td>		
		</thead>
		<tbody>
			<tr>
                <td><? echo $_SESSION['username'] ?></td>
				<td> <? echo $biens[0][0] ?></td>	
				<td> <? echo $biens[0][3], " ", $biens[0][4] ?></td>	
				<td> <? echo $biens[0][8] ?></td>
                <td> <? echo $biens[0][11] ?></td>
			<tr>
		</tbody>
	</table>
	<table>
		<thead>
            <th>pseudo</th>
			<th >Nom</th>
			<th>Prenom</th>	
		</thead>
		<tbody>
			<tr>
                <td><? echo $_SESSION['username'] ?></td>
				<td> <? echo $users[0][2] ?></td>	
				<td> <? echo $users[0][3] ?></td>
			<tr>
		</tbody>
	</table>
</body>
</html>
<!-- Exemple de Devis
En-tête du Devis
Nom de l'entreprise : Entreprise XYZ
Adresse : 123 Rue des Exemples, 75000 Paris, France
Téléphone : +33 1 23 45 67 89
Email : contact@xyz.fr
Numéro de SIRET : 123 456 789 00010
Date du devis : 20 mai 2024
Numéro du devis : DEVIS-2024-001
Informations du Client
Nom du client : Monsieur Jean Dupont
Adresse : 456 Rue des Clients, 75000 Paris, France
Téléphone : +33 6 12 34 56 78
Email : jean.dupont@example.com
Détails des Prestations
Référence	Description	Quantité	Prix Unitaire HT	Total HT
PROD-001	Design graphique	10 heures	50,00 €	500,00 €
PROD-002	Développement web	20 heures	60,00 €	1 200,00 €
PROD-003	Hébergement annuel	1 an	100,00 €	100,00 €
Totaux
Total HT : 1 800,00 €
TVA (20%) : 360,00 €
Total TTC : 2 160,00 €
Conditions de Réalisation
Délai de réalisation : 30 jours à compter de la validation du devis
Modalités de paiement : 50% à la commande, 50% à la livraison
Validité du devis : 30 jours à partir de la date d'émission
Mentions Légales
Ce devis est fourni à titre indicatif et ne constitue pas un engagement contractuel. Les prix et les conditions sont susceptibles de modification après une période de 30 jours.
En cas d'acceptation du devis, merci de retourner ce document signé avec la mention "Bon pour accord".
Signature
Entreprise XYZ :

Signature : ______________________

Nom : ______________________

Titre : ______________________

Client :

Signature : ______________________

Nom : ______________________ -->