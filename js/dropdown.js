//Selection du bouton et de la nav
let menuBtn = document.querySelector(".menuBtn");
const navbar = document.querySelector('.navbar');

//Ajout d'un écouteur d'évènement au clique
menuBtn.addEventListener("click", function(){
    navbar.classList.toggle('open');
})
