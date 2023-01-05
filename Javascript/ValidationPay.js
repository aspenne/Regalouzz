document.getElementById("numCa").addEventListener("keyup", valider);

document.getElementById('valiPay').disabled = true;
document.getElementById("valiCarte").hidden = false;
document.getElementById("tailleCrypto").hidden = false;

tailleCrypto

function valider(){

    var input1 = document.getElementById("numCa");

    var tabl = [];
    var tabl2 = [];
    var ind = 0;
    var somme = 0;
    var temp;
    var trop;
    var test = 0;
    var size;
    var reste;

    tabl = input1.value.split('');
    if(tabl.length == 16){

        document.getElementById("tailleCrypto").hidden = true;
        size = tabl.length -2;        

        for (let index = tabl.length -2; index >= 0; index--) {
            if(index %2 != 0){
                temp = parseInt(tabl[index]);
                temp = temp * 2;
                if(temp >= 10){
                    trop = temp.toString();
                    temp = parseInt(trop[0]) + parseInt(trop[1]);
                }
            }
            else{
                temp = parseInt(tabl[index]);
            }
            tabl2[ind] = temp;
            ind = ind +1;  
        }


        for (let index2 = 0; index2 < tabl2.length; index2++) {
            //alert('passé : ' + index2);
            //alert("tabl2 [" + index2 + "]" + tabl2[index2]);
            somme = somme + tabl2[index2];
        }
        //alert(somme);
        reste = somme % 10;

        if(reste == 0){
            //alert("reste égal 0");
            if(tabl[15] == 0){
                document.getElementById("valiCarte").hidden = true;
                document.getElementById('valiPay').disabled = false;
            }
            else{
                document.getElementById("valiCarte").hidden = false;
                document.getElementById("valiPay").disabled = true;
            }
        }
        else{
            //alert("reste pas égal 0");
            if(tabl[15] == 10 - reste){
                document.getElementById("valiCarte").hidden = true;
                document.getElementById("valiPay").disabled = false;
            }
            else{
                document.getElementById("valiCarte").hidden = false;
                document.getElementById("valiPay").disabled = true;
            }
        }
    }
    else{
        document.getElementById("tailleCrypto").hidden = false;

    }
}
