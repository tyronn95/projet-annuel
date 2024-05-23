var slideIndex = 1; // Commence au premier élément
showSlides(slideIndex);

// Fonction pour changer de slide
function moveSlide(n) {
  showSlides(slideIndex += n);
}

// Fonction principale pour afficher le slide
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("col-md-3");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  // Cache tous les slides
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  // Affiche le slide courant
  slides[slideIndex-1].style.display = "flex";  
}

// Initialiser en affichant le premier slide
showSlides(slideIndex);
