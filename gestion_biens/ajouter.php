<?php
include_once 'api/config/Database.php';
include_once 'api/models/Property.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $property = new Property($db);

    // Collecte des données
    $property->title = $_POST['title'];
    $property->type = $_POST['type'];
    $property->city = $_POST['city'];
    $property->description = $_POST['description'];

    // Traitement de l'image
    if ($_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $property->image_url = $target_file;
        }
    }

    // Insertion des données
    if ($property->create()) {
        header("Location: index.php"); // Redirection vers index.php
        exit;
    } else {
        echo "<p>Erreur lors de l'ajout du bien.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Bien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink">
    <div class="max-w-2xl mx-auto px-10 py-6 bg-white mt-10">
        <h1 class="text-xl font-bold mb-4">Ajouter un nouveau bien</h1>
        <form action="ajouter.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Titre" required class="block w-full mb-2 p-2">
            <input type="text" name="type" placeholder="Type" required class="block w-full mb-2 p-2">
            <input type="text" name="city" placeholder="Ville" required class="block w-full mb-2 p-2">
            <textarea name="description" placeholder="Description" required class="block w-full mb-2 p-2"></textarea>
            <input type="file" name="image" required class="block w-full mb-4 p-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Soumettre
            </button>
        </form>
    </div>
</body>

</html>