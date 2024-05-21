<? include '../GLOBAL/include/header.php' ?>
        <div class="text-center mt-5">
            <h1 style="text-decoration: underline;">NOS SERVICES</h1>
        </div>
        <br><br>
        <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
        <br><br>


        <div class="container_paris">
            <div class="content">
            <div class="img_paris">
                <img src="../GLOBAL/img/organisation.jpg" alt="Image Paris">
            </div>
            </div>
            <div class="text-container">
            <span class="underline">Mise en valeur des publications : </span> <br> - Découvrez des logements mis en valeur à travers des annonces attrayantes, complétées par une communication fluide avec les voyageurs. <br><br> - Choisisez 1 pour un service de grande qualité où vous bénécifiererais d'une annonce prioritaire et retouche de photo et conseils <br> - 2 annonce prioritaire et retouche de photo <br>  - 3 retouche de photo <br>
            </p><br><br>
                <!-- <div class="text-center mt-3">
                    <button id="monBouton" class="btn">Réserver</button>
                </div>        -->

                <form id="numberForm">
                    <label for="number">Nombre :</label>
                    <input type="number" id="number" name="number" required>
                    <button type="submit">Envoyer</button>
                </form>
                <!-- <button type="submit" name="service" value="publicite" class="btn" onclick="publicite()">Réserver</button> -->
                <div id="resultat"></div>
            </div>
        </div>
        <br><br>
        <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
        <br><br>  
        <!-- Container Plage -->
        <div class="container_plage">
            <div class="content">
            <div class="img_plage">
                <img src="../GLOBAL/img/nettoyage.jpg" alt="Image Plage">
            </div>
            </div>
            <div class="text-container">
            <p><span class="underline">Nettoyage du logement :</span> : <br>
                - Profitez d'un espace propre et accueillant avec notre nettoyage professionnel avant et après chaque séjour. <br> </p>
                <form action="reservation.php" method="post">
                    <button type="submit" name="service" value="nettoyage" class="btn" onclick="nettoyage()">Réserver</button>
                </form>
                <button id="burger-menu">☰ Menu</button>
                <div id="menu">
                    <ul>
                        <li><a href="#">Maxi premium</a></li>
                        <li><a href="#">premium</a></li>
                        <li><a href="#">basique</a></li>
                    </ul>
                </div>
                
                <div id="resultatN">tarif</div>
            </div>
        </div> 
        <br><br>
        <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
        <br><br>
        <div class="container_paris">
            <div class="content">
            <div class="img_paris">
                <img src="../GLOBAL/img/service.png" alt="Image Paris">
            </div>
            </div>
            <div class="text-container">
            <span class="underline">Assistance Continue 24/24 :</span> <br> - Notre service client dévoué est là pour répondre à toutes vos questions et besoins, à n'importe quel moment. <br><br>
                </p><br><br>
                <form action="reservation.php" method="post">
                    <button type="submit" name="service" value="assistance" class="btn">Réserver</button>
                </form>         
            </div>
        </div>
        
        <br><br>
        <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
        <br><br>
            <!-- Container Plage -->
        <div class="container_plage">
            <div class="content">
            <div class="img_plage">
                <img src="../GLOBAL/img/argent.jpeg" alt="Image Plage">
            </div>
            </div>
            <div class="text-container">
            <p><span class="underline">Tarification Dynamique :</span> : <br>
                - Profitez d'un espace propre et accueillant avec notre nettoyage professionnel avant et après chaque séjour. <br> </p>
            
                <div class="text-center mt-3">
                    <a href="reservation.php" class="btn">Réserver</a>
                </div>         </div>
        </div> 
        <br><br>
        <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
        <br><br>
        <div class="container_paris">
        <div class="content">
            <div class="img_paris">
                <img src="../GLOBAL/img/maintenance.jpg" alt="Image Paris">
            </div>
        </div>
        <div class="text-container">
        <span class="underline">Maintenance et Réparation :</span> <br> - Des interventions rapides pour tout besoin de maintenance ou de petites réparations, assurant le parfait état de votre logement. <br><br>

            </p><br><br>
            <form action="reservation.php" method="post">
                <button type="submit" name="service" value="maintenance/réparation" class="btn">Réserver</button>
            </form>     
        </div>
    </div>

    <br><br>
    <hr style="border: none; border-top: 4px solid #BAA06A; margin: 0; width: 100%;">
    <br><br> <!-- Container Plage -->
    <div class="container_plage">
        <div class="content">
        <div class="img_plage">
            <img src="../GLOBAL/img/vtc.jpg" alt="Image Plage">
        </div>
        </div>
        <div class="text-container">
        <p><span class="underline">Transferts Aéroport :</span> : <br>
            - Commencez et concluez votre voyage en toute sérénité avec notre service de transport personnalisé de et vers l'aéroport. <br> </p>
    
            <form action="reservation.php" method="post">
                <button type="submit" name="service" value="transfert" class="btn">Réserver</button>
            </form>    
        </div>
    </div>
    <h1>Calculateur de distance</h1>
    <form method="POST">
        <label for="adresse_depart">Adresse de départ :</label><br>
        <label for="adresse_depart">Adresse d'arrivé' :</label><br>
        <input type="text" id="adresse_depart" name="adresse_depart"><br><br>
        <input type="submit" value="Calculer">
    </form>

    <h1>Résultat</h1>
    <br><br><br><br><br><br><br><br>


        <footer>
            <h1 class="h1-footer">© 2024 PCS Prestige | Mentions légales | CGV </h1> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <div class="social-icons">
            <a href="https://twitter.com/yourusername" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https:/snapchat.com/idrisbr" target="_blank"><i class="fab fa-snapchat-ghost"></i></a>
            <a href="https://instagram.com/yourusername" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="reservation.js"></script>
        <script src="tarif.js"></script>
        <script src="app.js"></script>
        <script src="../GLOBAL/script/menu.js"></script>
    </body>
</html>