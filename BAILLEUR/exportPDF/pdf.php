<?php
// Inclure la classe DOMPDF
//require_once 'vendor/autoload.php';
session_start();
http://localhost/Projet-Annuel/index.html
use Dompdf\Dompdf;

// Récupérer les données de la base de données (exemple avec PDO)
$pdo = new PDO('mysql:host=localhost;dbname=PCS', 'root', 'root');
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = :username";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}

// echo $data['username'];
// $contenu = "Contenu de votre echo:" . $result['username'];
// $chemin_fichier = 'erreur.php';
// file_put_contents($chemin_fichier, '<?php echo "' . $contenu . '"; ?/>');
// header('Location: '.$chemin_fichier);

// ob_start();
// require_once 'contenu.php';
// $html = ob_get_contents();
// ob_end_clean();

require_once 'includes/dompdf/autoload.inc.php';

// $html = '<html><body>';
// $html .= '<h1>Données de la base de données</h1>';
// $html .= '<table border="1"><tr><th>ID</th><th>Nom</th><th>Email</th></tr>';
// $html .= '<tr><td>' . $result['username'] . '</td></tr>';
// $html .= '</table></body></html>';

require_once 'includes/dompdf/autoload.inc.php';

$dompdf = new Dompdf();
$html = "<!DOCTYPE html>
<html>
<head>
	<meta charset=\"utf-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	<title>Vos données</title>
</head>
<body>
	<h1>Données de la base de données</h1>
	<table border=\"1\">
		<tr>
			<th>ID</th><th>Nom</th><th>Email</th>
		</tr>
		<tr><td>" . $result['username'] ."</td></tr>
	</table>
</body>
</html>";
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("donnees_base_de_donnees.pdf", array("Attachment" => false));

?>