$(document).ready(function(){
    $("#enviar").click(function(){
        cadastraOuvidoria();
    });
});

function cadastraOuvidoria(){
    var nome = document.getElementById("nome").value;
    var telefone = document.getElementById("telefone").value;
    var cidade = document.getElementById("cidade").value;
    var comentario = document.getElementById("comentario").value;

    var dados = {
        name: nome,
        tel: telefone,
        city: cidade,
        coment: comentario
    }

    $.post("../php/cadastraOuvidoria.php", dados , function(retorna){
        $(".msg").html(retorna);
    });

}

function limparComentario(){
    document.getElementById("nome").value = "";
    document.getElementById("telefone").value = "";
    document.getElementById("cidade").value = "";
    document.getElementById("comentario").value = "";

    document.getElementById("msg").innerHTML = null;
}