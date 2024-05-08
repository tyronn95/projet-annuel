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
            
            <div class="d-flex align-items-center">
                <span class="fas fa-user" aria-hidden="true"></span>
            </div>           
            <h2 class="btn-primary" id="vosNotes">Vos notes</h2>
            <p> </p> 
            
            <form method="POST" action="notation.php">
                <input name = "noteU" type="number">
                <input type="submit">
            </form>
            <div id = "valeur">
                <?php 

                    include('../global/include/BDDLocal.php');

                    $sql = "SELECT note FROM logements WHERE id = 1";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        echo $row["note"];
                    } else {
                        echo "Aucun résultat trouvé pour l'ID";
                    }
                ?>
            </div>
            
        </main>
        <!-- <? include '../GLOBAL/include/footer.html' ?> -->
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