const to_add = "Ajouter au panier";
const add = "A bien été ajouter !";

function simpleClickPanier(id) {    
    var btnX = document.getElementById(id);  
    btnX.textContent = add;
    btnX.setAttribute("style","background-color : #5aee5a;");
}

function afterClick(){
    var btnX = document.getElementById("btn");
    //btnX.disabled = false;
    btnX.textContent = to_add;
    btnX.setAttribute("style","background-color : aqua;");
}


