function publicite() {
    event.preventDefault();

    let input = document.getElementById("pub").value;
    let resultatDiv = document.getElementById("resultat");

    if (input == "1") {
        resultat = "50 €";
    }else if (toString(input) !== 'int') {
        resultat = "utiliser un chiffre";
    }else if (input == "2") {
        resultat = "100 €";
    }else if (input == "jaden est fou") {
        resultat = "vrai";
    }else if (input == "mikael le larbin d'ariana") {
        resultat = "super vrai !!!";
    }else{
        resultat = "entrez une valeur";
    }

    resultatDiv.textContent = resultat;
    document.getElementById("myForm").addEventListener("submit", publicite);
}

function nettoyage() {
    event.preventDefault();
    console.log("hello")
    let mettre = 1;
    let resultatDiv = document.getElementById("resultatN");
    resultat = mettre * 0.5;

    resultatDiv.textContent = resultat;
    document.getElementById("myForm").addEventListener("submit", nettoyage);
}


function assistance() {
    event.preventDefault();
    let resultatDiv = document.getElementById("resultatA");

    resultatDiv.textContent = "10€/mois + 0,3/minute d'appel";
    document.getElementById("myForm").addEventListener("submit", assistance);
}

document.getElementById("burger-menu").addEventListener("click", function() {
    var menu = document.getElementById("menu");
    console.log("fgzggzgz")
    if (menu.style.display === "none") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
});