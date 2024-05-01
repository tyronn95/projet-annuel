<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Biens</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#d4af37',
                }
            }
        }
    }
    </script>
</head>

<body class="bg-black">

    <nav class="flex justify-between items-center bg-primary px-4 py-3">
        <a href="#">
            <img src="/src/logo/logo.png" class="w-20" />
        </a>

        <section class="flex justify-between gap-2 item-center">
            <ul>
                <li>Gestion des biens</li>
            </ul>

            <ul>
                <li>Calendrier et suivi</li>
            </ul>

            <ul>
                <li>Gestion Financière</li>
            </ul>
        </section>


        <div>

        </div>
    </nav>

    <section class="mt-10 bg-primary text-black max-w-2xl mx-auto px-10 py-6 text-center">
        <h1>Vous voulez ajouter un bien :
            <a href="/ajouter.php" class="bg-black hover:bg-black/80 text-white font-bold py-2 px-4 rounded-full">
                Ajouter un Bien
            </a>
        </h1>
    </section>

    <section class="bg-primary text-black mt-20 max-w-5xl mx-auto">

        <h1 class="text-center text-2xl mb-8 uppercase font-bold ">
            <span class="bg-black text-primary px-6 py-2 rounded-full">Vos
                Biens</span>
        </h1>

        <table class="table-auto border border-black">
            <thead class="bg-black text-primary">
                <tr>
                    <th class="border border-black">Id</th>
                    <th class="border border-black">titre</th>
                    <th class="border border-black">Type</th>
                    <th class="border border-black">Ville</th>
                    <th class="border border-black">Description</th>
                    <th class="border border-black">Images</th>
                    <th class="border border-black">Fonctionnalité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'api/config/Database.php';
                include_once 'api/models/Property.php';

                $database = new Database();
                $db = $database->getConnection();

                $property = new Property($db);
                $stmt = $property->read();
                $num = $stmt->rowCount();

                if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td class='border border-black p-4'>{$row['id']}</td>";
                        echo "<td class='border border-black p-4'>{$row['title']}</td>";
                        echo "<td class='border border-black p-4'>{$row['type']}</td>";
                        echo "<td class='border border-black p-4'>{$row['city']}</td>";
                        echo "<td class='border border-black p-4'>{$row['description']}</td>";
                        echo "<td class='border border-black p-4'><img src='{$row['image_url']}' width='100' /></td>";
                        echo "<td class='p-4 flex flex-col gap-2'>";
                        echo "<a href='edit.php?id={$row['id']}' class='bg-blue-500 hover:bg-blue-600 rounded-full text-white px-4 py-1'>Modifier</a>";
                        echo "<button onclick='deleteProperty({$row['id']})' class='bg-red-500 hover:bg-red-600 rounded-full text-white px-4 py-1'>Supprimer</button>";
                        echo "<button class='bg-green-500 hover:bg-green-600 rounded-full text-white px-4 py-1'>Voir plus</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center p-4'>Aucun bien trouvé.</td></tr>";
                }
                ?>
            </tbody>
        </table>


    </section>




</body>
<script>
function deleteProperty(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce bien ?')) {
        fetch('/api/controllers/PropertyController.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => alert('Erreur lors de la suppression : ' + error));
    }
}
</script>

</html>