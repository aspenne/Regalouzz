
// i have 2 buttons with the same class "notification" and i want to change the color and the background of the notification when i hover the button
document.getElementById("button_souhait").addEventListener("mouseover", notif_on_hover_souhait);
document.getElementById("button_souhait").addEventListener("mouseout", notif_out_hover_souhait);
document.getElementById("button_panier").addEventListener("mouseover", notif_on_hover_panier);
document.getElementById("button_panier").addEventListener("mouseout", notif_out_hover_panier);

// i want to change the color and background of the notification when i hover the button
function notif_on_hover_souhait(){
    document.getElementsByClassName("notification")[1].style.color = "white";
    document.getElementsByClassName("notification")[1].style.backgroundColor = "black";
    console.log("hover");
}

// i want to change the color and background of the notification when i stop to hover the button
function notif_out_hover_souhait(){
    document.getElementsByClassName("notification")[1].style.color = "black";
    document.getElementsByClassName("notification")[1].style.backgroundColor = "#ECECE2";
    console.log("hover");
}

// same as the first function but here for the second button
function notif_on_hover_panier(){
    document.getElementsByClassName("notification")[0].style.color = "white";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "black";
    console.log("hover");
}

// same as the second function but here for the second button
function notif_out_hover_panier(){
    document.getElementsByClassName("notification")[0].style.color = "black";
    document.getElementsByClassName("notification")[0].style.backgroundColor = "#ECECE2";
    console.log("hover");
}