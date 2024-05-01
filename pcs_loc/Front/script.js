document.getElementById('reservationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const propertyId = document.getElementById('propertyId').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    fetch('http://localhost:3000/api/locataires/reservations', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            property_id: propertyId,
            date_start: startDate,
            date_end: endDate
        })
    })
        .then(response => response.json())
        .then(data => {
            alert('Réservation créée avec succès !');
        })
        .catch((error) => {
            console.error('Erreur :', error);
        });
    // Au chargement de la page, récupérer les propriétés disponibles
    document.addEventListener('DOMContentLoaded', function () {
        fetch('http://localhost:3000/api/locataires/properties')
            .then(response => response.json())
            .then(properties => {
                const propertySelect = document.getElementById('propertySelect');
                properties.forEach(property => {
                    let option = new Option(property.title, property.id);
                    propertySelect.add(option);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des propriétés :', error));
    });

    // Gérer la sélection de la propriété
    document.getElementById('choosePropertyBtn').addEventListener('click', function () {
        const selectedPropertyId = document.getElementById('propertySelect').value;
        if (selectedPropertyId) {
            document.getElementById('propertySelectionSection').style.display = 'none';
            document.getElementById('reservationSection').style.display = 'block';
            // Optionnellement, préremplir un champ du formulaire de réservation avec l'ID de la propriété sélectionnée
            document.getElementById('propertyId').value = selectedPropertyId; // Assurez-vous que votre formulaire de réservation a un champ avec id="propertyId"
        }
    });

});
