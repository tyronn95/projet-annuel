<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un Bien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const params = new URLSearchParams(window.location.search);
        const id = params.get('id');
        if (!id) {
            alert('Erreur : ID manquant.');
            return;
        }

        fetch(`/api/controllers/PropertyController.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Ajoutez cette ligne pour voir ce que l'API renvoie exactement
                document.querySelector('[name="id"]').value = data.id;
                document.querySelector('[name="title"]').value = data.title;
                document.querySelector('[name="type"]').value = data.type;
                document.querySelector('[name="city"]').value = data.city;
                document.querySelector('[name="description"]').value = data.description;
                // Suppose that you only display the image URL or a link to the image
            })
            .catch(error => console.error('Error loading the property:', error));
    });

    function submitForm() {
        const propertyData = {
            id: document.querySelector('[name="id"]').value,
            title: document.querySelector('[name="title"]').value,
            type: document.querySelector('[name="type"]').value,
            city: document.querySelector('[name="city"]').value,
            description: document.querySelector('[name="description"]').value
        };

        fetch('/api/controllers/PropertyController.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(propertyData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response
                    .json(); // Nous traitons la réponse ici pour éviter d'aller plus loin en cas d'erreur
            })
            .then(data => {
                alert(data.message);
                window.location.href = '/index.php'; // Redirection vers la page principale après la mise à jour
            })
            .catch(error => {
                console.error('Error updating the property:', error);
                alert('Error updating the property: ' + error.message);
            });

        return false; // Prevent form submission
    }
    </script>
</head>

<body class="bg-pink">
    <div class="max-w-2xl mx-auto px-10 py-6 bg-white mt-10">
        <h1 class="text-xl font-bold mb-4">Modifier le bien</h1>
        <form onsubmit="return submitForm()">
            <input type="hidden" name="id" value="">
            <input type="text" name="title" required class="block w-full mb-2 p-2">
            <input type="text" name="type" required class="block w-full mb-2 p-2">
            <input type="text" name="city" required class="block w-full mb-2 p-2">
            <textarea name="description" required class="block w-full mb-2 p-2"></textarea>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Mettre à jour
            </button>
        </form>
    </div>
</body>

</html>