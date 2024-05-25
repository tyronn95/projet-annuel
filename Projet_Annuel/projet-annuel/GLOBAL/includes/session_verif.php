<?php
session_start();

// Fonction pour vérifier si l'utilisateur est dans la bonne section
function isUserInCorrectSection($userType, $currentFile) {
    $sections = [
        0 => 'ADMIN',
        1 => 'VOYAGEUR',
        2 => 'PRESTATAIRE',
        3 => 'BAILLEUR'
    ];
    
    if (array_key_exists($userType, $sections)) {
        return strpos($currentFile, $sections[$userType]) !== false;
    }
    return false;
}

function checkUserSession() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userType = $_SESSION['type'];
        $currentFile = $_SERVER['PHP_SELF'];

        // Afficher l'ID de l'utilisateur
        // echo "L'ID de l'utilisateur est : " . $_SESSION['id'];

        if (!isUserInCorrectSection($userType, $currentFile)) {
            switch ($userType) {
                case 0:
                    header("location: ../ADMIN/admin.php");
                    exit;
                case 1:
                    header("location: ../VOYAGEUR/voyageur.php");
                    exit;
                case 2:
                    header("location: ../PRESTATAIRE/calendar_presta.php");
                    exit;
                case 3:
                    header("location: ../BAILLEUR/calendrier_bailleur.php");
                    exit;
                default:
                    header("location: ../PAGE/connexion.php");
                    exit;
            }
        }
    } else {
        header("location: ../PAGE/connexion.php");
        exit;
    }
}

checkUserSession();
?>
