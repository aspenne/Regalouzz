function rechercher() {
    var categorie = document.getElementById("categorie").value;
    var recherche = document.getElementById("myInput").value;
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
    window.location.href=url;
}