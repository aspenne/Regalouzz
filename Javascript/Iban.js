document.getElementById("iban").addEventListener("keyup", validate);
document.getElementById("bonAchat").addEventListener("click", validate);
document.getElementById("virement").addEventListener("click", validate);

document.getElementById("erreur_iban").hidden = true;

function validate() { 
    var iban = document.getElementById("iban");
    iban.style.borderColor = "red";
    var boutton = document.getElementById("val_retour");
    var verif = document.getElementById("erreur_iban");
    var place_iban = document.getElementById("place_iban");

    const regex1 = new RegExp('[F][R][0-9]{2}[" "][0-9]{4}[" "][0-9]{4}[" "][0-9]{4}[" "][0-9]{4}[" "][0-9]{4}[" "][0-9]{3}', "g");
    const regex2 = new RegExp('[F][R][0-9]{25}', "g");

    if ($('#bonAchat').is(':checked') ) {
        boutton.disabled = false;
        verif.hidden = true;
        iban.style.borderColor = "white";
        iban.style.color = "white";
        iban.style.boxShadow = "0 0 2px 0 white";
        place_iban.hidden = true;
    }

    else if ($('#virement').is(':checked') ) {
        if (regex1.test(iban.value) || regex2.test(iban.value)){
            iban.style.borderColor = "green";
            iban.style.color = "green";
            iban.style.boxShadow = "0 0 2px 0 green";
            boutton.disabled = false;
            verif.style.color = "green";
            verif.hidden = true;
            place_iban.hidden = false;

        }
        else {
            iban.style.borderColor = "red";
            iban.style.boxShadow = "0 0 2px 0 red";
            iban.style.color = "red";
            boutton.disabled = true;
            verif.style.color = "red";
            verif.hidden = false;
            place_iban.hidden = false;
        }
    } 
    

}

validate();

function valid(){
    var bon  = document.getElementById("bonAchat");
    if (bon.checked){
        window.location.href="retourPaiement_sql.php";
    }
    else {
        window.location.href="page_pdf_ret.php";
    }
}