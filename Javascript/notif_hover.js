
// i have 2 buttons with the same class "notification" and i want to change the color and the background of the notification when i hover the button

console.log()

const button_souhait = document.getElementById("button_souhait")
const button_panier = document.getElementById("button_panier")
const button_panier_visiteur = document.getElementById("button_panier_visiteur")

console.log(button_panier_visiteur);
console.log(button_panier);

// just for remove the error console
if (button_panier_visiteur != null){
    button_panier_visiteur.addEventListener("mouseover",  notif_on_hover_panier_cli);
    button_panier_visiteur.addEventListener("mouseout", notif_out_hover_panier_cli);
}

if (button_panier != null){
    button_souhait.addEventListener("mouseover", notif_on_hover_souhait);
    button_souhait.addEventListener("mouseout", notif_out_hover_souhait);
    button_panier.addEventListener("mouseover", notif_on_hover_panier);
    button_panier.addEventListener("mouseout", notif_out_hover_panier);
}

// i want to change the color and background of the notification when i hover the button
function notif_on_hover_souhait(){
    document.getElementsByClassName("notification")[1].style.color = "white";
    document.getElementsByClassName("notification")[1].style.backgroundColor = "black";
}

// i want to change the color and background of the notification when i stop to hover the button
function notif_out_hover_souhait(){
    document.getElementsByClassName("notification")[1].style.color = "black";
    document.getElementsByClassName("notification")[1].style.backgroundColor = "#ECECE2";
}

// same as the first function but here for the second button
function notif_on_hover_panier(){
    document.getElementsByClassName("notification")[0].style.color = "white";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "black";
}

// same as the second function but here for the second button
function notif_out_hover_panier(){
    document.getElementsByClassName("notification")[0].style.color = "black";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "#ECECE2";
}

// just for the client
function notif_on_hover_panier_cli(){
    // here not third element because we don't shwo the whish button
    document.getElementsByClassName("notification")[0].style.color = "white";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "black";
}

// just for the client
function notif_out_hover_panier_cli(){
    document.getElementsByClassName("notification")[0].style.color = "black";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "#ECECE2";
}