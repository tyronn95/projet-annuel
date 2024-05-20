<?php
require_once('../../GLOBAL/include/verif.php'); 
verifierSessionUtilisateur();
try{
	$db = new PDO(
	'mysql:host=localhost;
	dbname=PCS;
	charset=utf8',
	'root',
	'root',
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)	//Permet de voir correctement les rapports d'erreur
	);

}catch(Exception $e){
    die('Erreur PDO :'. $e->getMessage());
}

use Dompdf\Dompdf;
use Dompdf\Options;



ob_start();

$sql = 'SELECT * FROM users WHERE username = :username';
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetchAll();

require_once 'contenu.php';
$html = ob_get_contents();
ob_end_clean();

require_once 'includes/dompdf/autoload.inc.php';

$options = new Options();
$options->set('defaultFont','Courier');

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4','portrait');

$dompdf->render();

$fichier = 'mon-pdf.pdf';

$dompdf->stream($fichier);

?>

