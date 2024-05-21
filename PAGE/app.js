document.getElementById('numberForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const number = document.getElementById('number').value;
    
    if (number == 1) {
        resultat = 100;
    }else if (number == 2) {
        resultat = 75;
    }else if (number == 3) {
        resultat = 50;
    }

    fetch('save_number.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ resultat: resultat })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});
