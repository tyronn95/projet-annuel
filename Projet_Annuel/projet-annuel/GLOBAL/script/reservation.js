function addService(nom) {
    $.ajax({
        url: 'reservation.php',
        type: 'POST',
        data: { nom: nom},
        success: function(response) {
            alert(nom);
        },
        error: function(xhr, status, error) {
            alert('Une erreur s\'est produite lors de l\'ajout du service.');
            console.error(error);
        }
    });
}