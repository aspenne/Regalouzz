document.getElementById("mdp").addEventListener("keyup", validate);

function validate() { 
    var psw = document.getElementById("mdp");
    psw.style.borderColor = "white";

    const regex1 = new RegExp('[0-9]', "g");
    const regex2 = new RegExp('[A-Z]', "g");
    const regex3 = new RegExp('[a-z]', "g");
    const regex4 = new RegExp('[^a-zA-Z]', "g");
    const regex5 = new RegExp('[!-/]', "g");


    if (regex1.test(psw.value) && regex2.test(psw.value) && regex3.test(psw.value) && regex4.test(psw.value) && regex5.test(psw.value)) {
        psw.style.borderColor = "green";
        psw.style.color = "green";
    } 
    else {
        psw.style.borderColor = "red";
        psw.style.boxShadow = "0 0 2px 0 red";
        psw.style.color = "red";

    }
}