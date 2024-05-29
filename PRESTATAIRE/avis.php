<? include '../GLOBAL/include/header.php' ?>
        <main>
            <div class="text-center mt-5">
                <h1 style="text-decoration: underline;">AVIS</h1>
            </div>
            <br><br>
            <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
            <br><br>
            <div id="containerAvis">
                <!-- Avis <div class="star" id="star"></div><div class="star" id="star"></div><div class="star" id="star"></div><div class="star" id="star"></div><div class="star" id="star"></div><div class="trapeze"></div> -->
                <div id = "etoile">
                    <p>Avis</p><div class = "star">&#x2605;</div><div class = "star">&#x2605;</div><div class = "star">&#x2605;</div><div class = "star">&#x2605;</div><div class = "star">&#x2605;</div>
                </div>    
                <div class="notes"> <p>5 étoiles</p> <div class="barre-noire"></div></div>
                <div class="notes"> <p>4 étoiles</p> <div class="barre-noire"></div></div>
                <div class="notes"> <p>3 étoiles</p> <div class="barre-noire"></div></div>
                <div class="notes"> <p>2 étoiles</p> <div class="barre-noire"></div></div>
                <div class="notes"> <p>1 étoiles</p> <div class="barre-noire"></div></div>

            </div>           
            <h2 class="btn-primary" id="vosNotes">Vos notes</h2>
            <? 
                $bdd = new PDO('mysql:host=localhost;dbname=pcs', 'root', 'root');

                $requete = $bdd->prepare('SELECT avis,client FROM avis WHERE prestataire = :utilisateur_id');
                $requete->bindParam(':utilisateur_id', $id);
                $id = $_SESSION['username'];
                $requete->execute();
                $avis = $requete->fetchAll();
                ?>
                <ul>
                <?php foreach ($avis as $commentaire): ?>
                    <div class = "avisPhoto">
                        <img src = "../GLOBAL/img/default-profil.png" alt="image de profil" style="height: 75px; width: auto;">
                        <div class="avis">
                            <h3><?php echo "Client",  $commentaire['client'] ?></h3>
                            <li><?php echo  $commentaire['avis'] ?></li>
                        </div>
                    </div>
                <?php endforeach; ?>
                </ul>
            <div class = "avisPhoto">
                <img src = "../GLOBAL/img/default-profil.png" alt="image de profil" style="height: 75px; width: auto;">
                <div class="avis">
                    <h3>Client n°1: Philipe</h3>
                    <p>Service horrible</p> 
                </div>
            </div>    

            <form method="POST" action="notation.php">
                <input name = "noteU" type="number">
                <input type="submit">
            </form>
            <div id = "valeur">
                <?php 
                    include('../global/include/BDDLocal.php');


                    $id = $_SESSION['username'];
                    $sql = "SELECT note FROM users WHERE username = :utilisateur_id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->bindParam(':utilisateur_id', $id); 
                    $stmt->execute();
                    $note = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($note) {
                        echo "<p>", $note["note"], "</p>";
                    } else {
                        echo "Aucun résultat trouvé pour l'ID";
                    }
                ?>
            </div>
            
        </main>
        <br><br><br>
        <? include '../GLOBAL/include/footer.html' ?>
    </body>
    <script>
        var valeurDiv = document.getElementById("valeur");
        var elementsDiv = document.getElementsByClassName("star");
        function modifierClasses() {
            var valeur = parseInt(valeurDiv.textContent);
            for (var i = 0; i < valeur; i++) {
                var element = elementsDiv[i];
                element.style.color = "yellow";
            }
        }
        
        modifierClasses();
    </script>
</html>