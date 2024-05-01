<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche d'intervention - PCS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Fiche d'intervention</h1>
        </header>
        <form action="submit_intervention.php" method="post">
        <section class="intervention-info">
            <div class="date-info">
                <div class="field">
                    <label>Date:</label>
                    <input type="date" name="date">
                </div>
                <div class="field">
                    <label>Début:</label>
                    <input type="time" name="debut">
                </div>
                <div class="field">
                    <label>Fin:</label>
                    <input type="time" name="fin">
                </div>
                <div class="field">
                    <label>Durée:</label>
                    <input type="text" name="duree">
                </div>
                <div class="field">
                    <label>N° Facture:</label>
                    <input type="text" name="no_facture">
                </div>
            </div>
            <div class="client-info">
                <div class="field">
                    <label>N° Client:</label>
                    <input type="number" name="no_client" required>
                </div>
                <div class="field">
                    <label>N° Contrat:</label>
                    <input type="text" name="no_contrat">
                </div>
                <div class="field">
                    <label>Responsable:</label>
                    <input type="text" name="responsable">
                </div>
                <div class="field">
                    <label>Adresse:</label>
                    <input type="text" name="adresse">
                </div>
            </div>
        </section>
        
        <section class="intervention">
            <div class="intervention-header">
                <h2>Intervention</h2>
            </div>
            <div class="textarea-container">
                <textarea name="objet" placeholder="Objet:"></textarea>
            </div>
            <div class="textarea-container">
                <textarea name="type" placeholder="Type:"></textarea>
            </div>
        </section>
        
        <section class="rapport">
            <div class="rapport-header">
                <h2>Rapport</h2>
            </div>
            <textarea name="rapport" placeholder="Rapport:"></textarea>
        </section>
        
            <section class="signatures">
                <div class="signature technicien">
                    <h3>Technicien</h3>
                    <div class="field">
                        <label>Nom:</label>
                        <div class="input-underline">
                            <input type="text" name="nom_technicien">
                        </div>
                    </div>
                    <div class="field">
                        <label>Date:</label>
                        <div class="input-underline">
                            <input type="date" name="date_technicien">
                        </div>
                    </div>
                    <div class="signature-space">
                        <label>Signature:</label>
                    </div>
                </div>
                <div class="signature-divider"></div>
                <div class="signature client">
                    <h3>Client</h3>
                    <div class="field">
                        <label>Nom:</label>
                        <div class="input-underline">
                            <input type="text" name="nom_client">
                        </div>
                    </div>
                    <div class="field">
                        <label>Date:</label>
                        <div class="input-underline">
                            <input type="date" name="date_client">
                        </div>
                    </div>
                    <div class="signature-space">
                        <label>Signature:</label>
                    </div>
                </div>
            </section>
            <input type="submit" value="Enregistrer">
        </form>
        <footer>
            <p>©2024 PCS PRESTIGE | Mentions légales | CGV</p>
        </footer>
</body>
</html>  
        
