var add_btn = document.getElementById("BoutonPanier")
var sht_btn = document.getElementById("BoutonSouhait")
add_btn.addEventListener("click", bruit_panier)
sht_btn.addEventListener("click", bruit_souhait)
var sound = new Audio("../sound/bloop.mp3");
sound.preload = "auto";


function bruit_panier(){
    sound.play();
    alert("vous avez ajouté un article au panier");
}

function bruit_souhait(){
    sound.play();
    alert("vous avez ajouté un article a votre liste de souhait");
}