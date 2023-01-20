function rechercher() {
    var categorie = document.getElementById("categorie").value;
    var recherche = document.getElementById("myInput").value;
    var min = document.getElementById("min").value;
    var max = document.getElementById("max").value;
    var url="./Liste_produit.php";
    if (categorie == "0"){
        if (recherche == ""){
            url="./Liste_produit.php";
        }else{
            url = "./recherche.php?recherche="+recherche;
        }
    }
    else{
        if (recherche == ""){
            url = "./recherche.php?categorie="+categorie;
        }else{
            url = "./recherche.php?categorie="+categorie+"&recherche="+recherche;
        }
    }
    if ((min >= 0) && (max > 1)){
        url = "./recherche.php?min="+min+"&max="+max;
    }
    window.location.href=url;
}
