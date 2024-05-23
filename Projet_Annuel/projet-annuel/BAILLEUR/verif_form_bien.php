<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    // Fonction de nettoyage pour les données d'entrée
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Vérification des champs obligatoires
    $required_fields = [
        'property_type' => 'Type de propriété',
        'title' => 'Titre de l\'annonce',
        'address' => 'Adresse du Bien',
        'city' => 'Ville',
        'postal_code' => 'Code postal',
        'country' => 'Pays',
        'catchphrase' => 'Phrase d\'accroche',
        'description' => 'Description détaillée',
        'rooms' => 'Nombre de Chambres',
        'bathrooms' => 'Nombre de salles de bains',
        'area' => 'Superficie',
        'capacity' => 'Capacité d\'Accueil',
        'availability_date' => 'Disponible à partir de',
        'visit_date' => 'Disponibilité pour une visite',
        'not_robot' => 'Vérification robot'
    ];

    foreach ($required_fields as $field => $field_name) {
        if (empty($_POST[$field])) {
            $errors[$field] = "Le champ $field_name est requis.";
        }
    }

    // Si des erreurs de champs vides existent, renvoyer les erreurs
    if (!empty($errors)) {
        include('formulaire.html'); // Assurez-vous que votre formulaire HTML est dans un fichier distinct nommé formulaire.html
        exit;
    }

    // Validation des champs de texte
    $property_type = clean_input($_POST['property_type']);
    $title = clean_input($_POST['title']);
    $address = clean_input($_POST['address']);
    $city = clean_input($_POST['city']);
    $postal_code = clean_input($_POST['postal_code']);
    $country = clean_input($_POST['country']);
    $catchphrase = clean_input($_POST['catchphrase']);
    $description = clean_input($_POST['description']);
    $rooms = clean_input($_POST['rooms']);
    $bathrooms = clean_input($_POST['bathrooms']);
    $area = clean_input($_POST['area']);
    $capacity = clean_input($_POST['capacity']);
    $availability_date = clean_input($_POST['availability_date']);
    $visit_date = clean_input($_POST['visit_date']);
    $not_robot = isset($_POST['not_robot']) ? true : false;

    // Vérification du champ "Je ne suis pas un robot"
    if (!$not_robot) {
        $errors['not_robot'] = "Échec de la vérification du robot.";
    }

    // Validation des formats de données
    if (!preg_match("/^[a-zA-Z0-9\s,.'-]{3,}$/", $title)) {
        $errors['title'] = "Le titre contient des caractères invalides.";
    }
    if (!preg_match("/^[a-zA-Z\s]{2,}$/", $city)) {
        $errors['city'] = "La ville contient des caractères invalides.";
    }
    if (!preg_match("/^\d{5}$/", $postal_code)) {
        $errors['postal_code'] = "Le code postal est invalide.";
    }
    if (!preg_match("/^[a-zA-Z\s]{2,}$/", $country)) {
        $errors['country'] = "Le pays contient des caractères invalides.";
    }
    if (!preg_match("/^[a-zA-Z0-9\s,.'-]{3,}$/", $catchphrase)) {
        $errors['catchphrase'] = "La phrase d'accroche contient des caractères invalides.";
    }
    if (!filter_var($rooms, FILTER_VALIDATE_INT) || $rooms <= 0) {
        $errors['rooms'] = "Le nombre de chambres est invalide.";
    }
    if (!filter_var($bathrooms, FILTER_VALIDATE_INT) || $bathrooms <= 0) {
        $errors['bathrooms'] = "Le nombre de salles de bains est invalide.";
    }
    if (!filter_var($area, FILTER_VALIDATE_FLOAT) || $area <= 0) {
        $errors['area'] = "La superficie est invalide.";
    }
    if (!filter_var($capacity, FILTER_VALIDATE_INT) || $capacity <= 0) {
        $errors['capacity'] = "La capacité d'accueil est invalide.";
    }
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $availability_date)) {
        $errors['availability_date'] = "La date de disponibilité est invalide.";
    }
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $visit_date)) {
        $errors['visit_date'] = "La date de visite est invalide.";
    }

    // Si des erreurs de validation existent, renvoyer les erreurs
    if (!empty($errors)) {
        include('formulaire.html'); // Assurez-vous que votre formulaire HTML est dans un fichier distinct nommé formulaire.html
        exit;
    }

    // Validation et traitement des fichiers téléchargés
    $photos = $_FILES['photos'];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $upload_dir = 'uploads/';

    // Création du répertoire de téléchargement s'il n'existe pas
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    foreach ($photos['name'] as $key => $name) {
        $type = $photos['type'][$key];
        $tmp_name = $photos['tmp_name'][$key];
        $error = $photos['error'][$key];
        $size = $photos['size'][$key];

        if ($error === UPLOAD_ERR_OK) {
            if (in_array($type, $allowed_types)) {
                if ($size <= 5000000) { // Taille maximum de 5MB
                    $file_name = uniqid() . "-" . basename($name);
                    $target_file = $upload_dir . $file_name;

                    if (move_uploaded_file($tmp_name, $target_file)) {
                        echo "Le fichier " . basename($name) . " a été téléchargé avec succès.<br>";
                    } else {
                        echo "Échec du téléchargement du fichier " . basename($name) . ".<br>";
                    }
                } else {
                    echo "Le fichier " . basename($name) . " est trop volumineux.<br>";
                }
            } else {
                echo "Le type de fichier " . basename($name) . " n'est pas autorisé.<br>";
            }
        } else {
            echo "Erreur lors du téléchargement du fichier " . basename($name) . ".<br>";
        }
    }

    // Affichage des données validées
    echo "<h2>Vos informations</h2>";
    echo "Type de propriété : $property_type<br>";
    echo "Titre de l'annonce : $title<br>";
    echo "Adresse : $address<br>";
    echo "Ville : $city<br>";
    echo "Code postal : $postal_code<br>";
    echo "Pays : $country<br>";
    echo "Phrase d'accroche : $catchphrase<br>";
    echo "Description : $description<br>";
    echo "Nombre de chambres : $rooms<br>";
    echo "Nombre de salles de bains : $bathrooms<br>";
    echo "Superficie : $area m²<br>";
    echo "Capacité d'accueil : $capacity<br>";
    echo "Disponible à partir de : $availability_date<br>";
    echo "Disponibilité pour une visite : $visit_date<br>";
}
?>
