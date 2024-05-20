<? include '../GLOBAL/include/header.php' ?>
    <main>
            <div class="container" id="cDocument">
                <div id="choisirBien">
                    <p style = "font-weight: bold; text-decoration: underline;">• Veuillez choisir le bien concerné : </p><a class="btn btn-primary" >Choisir le bien</a>
                </div>
                <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=pcs', 'root', 'root');

                    $requete = $bdd->prepare('SELECT * FROM logements WHERE proprietaire = :utilisateur_id');
                    $requete->bindParam(':utilisateur_id', $utilisateur_id);
                    $utilisateur_id = 'test';
                    $requete->execute();
                    $logements = $requete->fetchAll();
                    echo "Vos logements";
                    ?>
                    <ul>
                    <?php foreach ($logements as $bien): ?>
                        <? echo '<form action = "" method = "POST">'?>
                            <li><?php echo '<input type="text" name="choix">', $bien['id'] ,'</button>' ?></li>
                    <?php endforeach; ?>
                    </form>
                    </ul>
                <!-- <button id="burger-menu">☰ Menu</button>
                <div id="menu">
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div> -->
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
                    <p style = "font-weight: bold; text-decoration: underline;">• Vous voulez faire un devis ?  </p><a href="exportPDF/pdf0.php" class="btn btn-primary">Cliquez ici</a>
                </div>
                <?try{
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
$sql = 'SELECT * FROM users WHERE username = :username';
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetchAll();

echo $user[0][0];

?>
            </div>
    </main>    
</body>