$(window).on('load', function (){
    document.getElementById("carregando").style.display = "none";
    document.getElementById("conteudoNoticia").style.display = "block";
});

$(document).ready(function () {
    listar_noticia(pagina, qnt_result_pg); //Chamar a função para listar os registros
    $("#entrar").click(function(){
        loginVerify("area-restrita/index.php", "php/verificaLogin.php");
    });
});

function listar_noticia(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg,
        id: idno
    }
    $.post('php/listarNoticias.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#conteudoNoticia").html(retorna);
    });
}   
function listaUnica(key, pagina){
    var dados = {
        key: key,
        pagina: pagina,
        id: idno
    }
    $.post('php/listarNoticias.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#conteudoNoticia").html(retorna);
    });
}