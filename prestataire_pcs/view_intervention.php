<?php
// Paramètres de connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "prestataire_db";
$port = 8889;

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupération de l'ID de l'intervention depuis l'URL
$intervention_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Requête SQL pour obtenir les informations de l'intervention
if ($intervention_id > 0) {
    $sql = "SELECT * FROM interventions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $intervention_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $intervention = $result->fetch_assoc();

    if (!$intervention) {
        echo "Aucune intervention trouvée pour l'ID spécifié.";
        exit;
    }
    $stmt->close();
} else {
    echo "ID d'intervention non spécifié ou invalide.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche d'intervention remplie</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Fiche d'intervention</h1>
        </header>
        <section class="intervention-info">
            <div class="date-info">
                <div class="field">
                    <label>Date:</label>
                    <input type="date" name="date" value="<?php echo $intervention['date']; ?>" disabled>
                </div>
                <div class="field">
                    <label>Début:</label>
                    <input type="time" name="debut" value="<?php echo $intervention['debut']; ?>" disabled>
                </div>
                <div class="field">
                    <label>Fin:</label>
                    <input type="time" name="fin" value="<?php echo $intervention['fin']; ?>" disabled>
                </div>
                <div class="field">
                    <label>Durée:</label>
                    <input type="text" name="duree" value="<?php echo $intervention['duree']; ?>" disabled>
                </div>
                <div class="field">
                    <label>N° Facture:</label>
                    <input type="text" name="no_facture" value="<?php echo $intervention['no_facture']; ?>" disabled>
                </div>
            </div>
            <div class="client-info">
                <div class="field">
                    <label>N° Client:</label>
                    <input type="text" name="no_client" value="<?php echo $intervention['no_client']; ?>" disabled>
                </div>
                <div class="field">
                    <label>N° Contrat:</label>
                    <input type="text" name="no_contrat"
                        value="<?php echo isset($intervention['no_contrat']) ? $intervention['no_contrat'] : ''; ?>"
                        disabled>
                </div>
                <div class="field">
                    <label>Responsable:</label>
                    <input type="text" name="responsable"
                        value="<?php echo isset($intervention['responsable']) ? $intervention['responsable'] : ''; ?>"
                        disabled>
                </div>
                <div class="field">
                    <label>Adresse:</label>
                    <input type="text" name="adresse"
                        value="<?php echo isset($intervention['adresse']) ? $intervention['adresse'] : ''; ?>" disabled>
                </div>
            </div>
        </section>
        <section class="intervention">
            <div class="intervention-header">
                <h2>Intervention</h2>
            </div>
            <div class="textarea-container">
                <textarea name="objet" disabled><?php echo $intervention['objet']; ?></textarea>
            </div>
            <div class="textarea-container">
                <textarea name="type"
                    disabled><?php echo isset($intervention['type']) ? $intervention['type'] : ''; ?></textarea>
            </div>
        </section>
        <section class="rapport">
            <div class="rapport-header">
                <h2>Rapport</h2>
            </div>
            <textarea name="rapport"
                disabled><?php echo isset($intervention['rapport']) ? $intervention['rapport'] : ''; ?></textarea>
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
        </form>
        <footer>
            <p>©2024 PCS PRESTIGE | Mentions légales | CGV</p>
        </footer>
</body>

</html>