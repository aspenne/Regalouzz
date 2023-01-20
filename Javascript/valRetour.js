function valRetour() {
    document.getElementById("selectionne").style.color = "red";
    $('#checkBtn').prop("disabled", true);
    let total = 0;
    document.getElementById("demo").innerHTML = total + " €";

    $('input:checkbox').click(function() {
        if (($(this).is(':checked'))) {
            $('#checkBtn').prop("disabled", false);
            document.getElementById("selectionne").style.color = "green";
            
            total += parseInt($(this).val());
            document.getElementById("demo").innerHTML = total + " €";
        }

        else {
            if ($('.checks').filter(':checked').length < 1){
                $('#checkBtn').attr('disabled',true);
                document.getElementById("selectionne").style.color = "red";
            }
        }
    }
    );
};
valRetour();

// total calculus of checkbox checked

var table = [];
var total = 0;
const demo  = document.getElementById("demo");
const totalInput = document.getElementById("totalInput");
demo.innerHTML = total + " € <i>TTC</i>";

function onCheckBoxChange(idProduit){
    let checkBox = document.getElementById('checkBox'+idProduit);
    let idSelect = checkBox.name;
    let quantite = document.getElementById('quantite'+idProduit);
    let raison = document.getElementById('raison'+idProduit);

    if (checkBox.checked){
        table[idSelect] = {
            idProduit: idProduit,
            quantite: quantite.value,
            raison: raison.value,
        };

        total += parseInt(checkBox.value)*parseInt(quantite.value);
        demo.innerHTML = total + " € <i>TTC</i>";
    } else {
        table[idSelect] = null;
        total -= parseInt(checkBox.value)*parseInt(quantite.value);
        demo.innerHTML = total + " € <i>TTC</i>";
    }
    totalInput.value = total;
}

function onQuantiteChange(idProduit){
    let checkBox = document.getElementById('checkBox'+idProduit);
    let idSelect = checkBox.name;
    let quantite = document.getElementById('quantite'+idProduit);

    if (checkBox.checked){
        total += parseInt(checkBox.value)*parseInt(quantite.value) - parseInt(checkBox.value)*parseInt(table[idSelect].quantite);
        table[idSelect].quantite = quantite.value;
        demo.innerHTML = total + " € <i>TTC</i>";
    }
    totalInput.value = total;
}

function onRaisonChange(idProduit){
    let checkBox = document.getElementById('checkBox'+idProduit);
    let idSelect = checkBox.name;
    let raison = document.getElementById('raison'+idProduit);

    if (checkBox.checked){
        table[idSelect].raison = raison.value;
    }
}

function validate(){
    const idHidden = document.getElementById('idProduitInput');
    const quantiteHidden = document.getElementById('quantiteInput');
    const raisonHidden = document.getElementById('raisonInput');
    for (let i = 0; i < table.length; i++) {
        if (table[i] != null){
            idHidden.value += table[i].idProduit.toString() + ";";
            quantiteHidden.value += table[i].quantite + ";";
            raisonHidden.value += table[i].raison + ";";
        }
    }
    document.getElementById('form_retour').submit();
}

function suppr(){
    // sessionStorage.removeItem('total');
    // sessionStorage.removeItem('id_commande');
    // sessionStorage.removeItem('heure');
    window.location.href="page_pdf_sql.php";
}