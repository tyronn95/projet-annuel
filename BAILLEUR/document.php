<? include '../GLOBAL/include/header.php' ?>
    <main>
        <div class="container" id="cDocument">
            <div id="choisirBien">
                <p style = "font-weight: bold; text-decoration: underline;">• Veuillez choisir le bien concerné : </p><a class="btn btn-primary" >Choisir le bien</a>
                <form action = "" method = "POST">
                    <input type = "text" name = "chois">
                    <input type = "submit">
                </form>    
            </div>
            <?php
                $bdd = new PDO('mysql:host=localhost;dbname=pcs', 'root', 'root');

                $requete = $bdd->prepare('SELECT * FROM logements WHERE proprietaire = :utilisateur_id');
                $requete->bindParam(':utilisateur_id', $utilisateur_id);
                $utilisateur_id = $_SESSION['username'];
                $requete->execute();
                $logements = $requete->fetchAll();
                echo "Vos logements";
                ?>
                <ul>
                <?php foreach ($logements as $bien): ?>
                        <li><?php echo  $bien['id'] ?></li>
                <?php endforeach; ?>
                </ul>
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
                <p style = "font-weight: bold; text-decoration: underline;">• Vous voulez faire un devis ?  </p><a href="exportPDF/pdf.php" class="btn btn-primary">Cliquez ici</a>
            </div>
                <?
                // try{
                //     $db = new PDO(
                //     'mysql:host=localhost;
                //     dbname=PCS;
                //     charset=utf8',
                //     'root',
                //     'root',
                //     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)	
                //     );

                //     }catch(Exception $e){
                //         die('Erreur PDO :'. $e->getMessage());
                //     }

                //     if($_POST['chois']){
                //         $_SESSION['chois'] = $_POST['chois'];
                //     }else{
                //         echo "Aucun chois";
                //     }
                    
                //     $sql = 'SELECT * FROM logements WHERE id = :chois';
                //     $stmt = $db->prepare($sql);
                //     $stmt->bindParam(':chois', $_SESSION['chois'], PDO::PARAM_STR);
                //     $stmt->execute();
                //     $biens = $stmt->fetchAll();
                    
                    
                //     var_dump($biens);
                    ?>
            </div>
    </main>    
</body>