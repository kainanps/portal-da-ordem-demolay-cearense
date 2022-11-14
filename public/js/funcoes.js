document.addEventListener('keydown', function(e) {
    e = e || window.event;
    var code = e.which || e.keyCode;
    modal = document.getElementById('modal').style.display;

    if(code == 27 && modal == "block"){
        showDiv('modal');
    }       
});

function showDiv(identificador){
    var displ = document.getElementById(identificador).style.display;
    if(displ == "none" || displ == ""){
        document.getElementById(identificador).style.display = "block";
    }else{
        document.getElementById(identificador).style.display = "none";
    }
}

function loginVerify(redirect, incorporate){
    var usuario = document.getElementById('usuario').value;
    var senha = document.getElementById('senha').value;
    var dados = {
        user: usuario,
        pass: senha
    }

    $.post(incorporate, dados , function(retorna){
        if(retorna == 'true'){
            window.location.href = redirect;
        }else{
            incorreto();
        }
    });
}

function incorreto(){
    var incorreto = document.getElementById('incorreto');
    incorreto.style.height = "20px";
    incorreto.style.opacity = 1;
    incorreto.style.fontSize = "15px";
    incorreto.innerHTML = "Senha ou usuário incorreto(s)";
}

$(document).ready(function(){
    $("#entrarLeft").click(function(){
        loginVerify("../area-restrita/index.php", "../php/verificaLogin.php");
    });
});