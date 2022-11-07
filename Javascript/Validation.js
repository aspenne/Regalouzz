document.getElementById("mdp").addEventListener("keyup", validate);
document.getElementById("mdp2").addEventListener("keyup", validate);
document.getElementById("js").hidden = true;

function validate() { 
    var psw = document.getElementById("mdp");
    var psw2 = document.getElementById("mdp2");
    psw.style.borderColor = "white";
    var boutton = document.getElementById("boutton");

    const regex1 = new RegExp('[0-9]', "g");
    const regex2 = new RegExp('[A-Z]', "g");
    const regex3 = new RegExp('[a-z]', "g");
    const regex4 = new RegExp('[!-/@?$]', "g");


    if (regex1.test(psw.value) && regex2.test(psw.value) && regex3.test(psw.value) && regex4.test(psw.value) && psw.value.length >= 8 && psw.value == psw2.value) {
        psw.style.borderColor = "green";
        psw.style.color = "green";
        psw.style.boxShadow = "0 0 2px 0 green";
        psw2.style.borderColor = "green";
        psw2.style.color = "green";
        psw2.style.boxShadow = "0 0 2px 0 green";
        boutton.disabled = false;
        document.getElementById("chiffre").style.color = "green";
        document.getElementById("maj").style.color = "green";
        document.getElementById("min").style.color = "green";
        document.getElementById("longueur").style.color = "green";
        document.getElementById("special").style.color = "green";
        document.getElementById("identique").style.color = "green";
    } 
    else {
        psw.style.borderColor = "red";
        psw.style.boxShadow = "0 0 2px 0 red";
        psw.style.color = "red";
        boutton.disabled = true;

                if(psw.value.length >= 8){
            document.getElementById("longueur").style.color = "green";
        }
        else{
            document.getElementById("longueur").style.color = "red";
        }
        
        if(psw.value.match(regex1)){
            document.getElementById("chiffre").style.color = "green";
        }
        else{
            document.getElementById("chiffre").style.color = "red";
        }
        
        if(psw.value.match(regex2)){
            document.getElementById("maj").style.color = "green";
        }
        else{
            document.getElementById("maj").style.color = "red";
        }

        if(psw.value.match(regex3)){
            document.getElementById("min").style.color = "green";
        }
        else{
            document.getElementById("min").style.color = "red";
        }

        if(psw.value.match(regex4)){
            document.getElementById("special").style.color = "green";
        }
        else{
            document.getElementById("special").style.color = "red";
        }
        
        if (regex1.test(psw.value) && regex2.test(psw.value) && regex3.test(psw.value) && regex4.test(psw.value) && psw.value.length >= 8){
            psw.style.borderColor = "green";
            psw.style.color = "green";
            psw.style.boxShadow = "0 0 2px 0 green";
        }else{
            psw.style.borderColor = "red";
            psw.style.boxShadow = "0 0 2px 0 red";
            psw.style.color = "red";
        }

        if(psw.value == psw2.value && psw2.value != ""){
            document.getElementById("identique").style.color = "green";
            psw2.style.borderColor = "green";
            psw2.style.color = "green";
            psw2.style.boxShadow = "0 0 2px 0 green";   
        }
        else{
            document.getElementById("identique").style.color = "red";
            psw2.style.borderColor = "red";
            psw2.style.boxShadow = "0 0 2px 0 red";
            psw2.style.color = "red";
        }


    }
}

validate();