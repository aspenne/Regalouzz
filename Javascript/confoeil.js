
function voir(){
    let x = document.getElementById("confoeil");
    let y = document.getElementById("mdp");
    if(y.type==="password"){
        y.type="text";
        x.classList.remove("fa-eye");
        x.classList.add("fa-eye-slash");
    }else{
        y.type="password";
        x.classList.add("fa-eye");
        x.classList.remove("fa-eye-slash");
    }
}