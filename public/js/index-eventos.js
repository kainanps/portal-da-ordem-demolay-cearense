$(window).on('load', function (){
    document.getElementById("carregando").style.display = "none";
    document.getElementById("conteudoEvento").style.display = "block";
});

$(document).ready(function () {
    listar_evento(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_evento(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg,
        id: idev
    }
    $.post('../php/listarEventos.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#conteudoEvento").html(retorna);
    });
}   
function listaUnica(key, page){
    var dados = {
        key: key,
        pagina: pagina,
        id: idev
    }
    $.post('../php/listarEventos.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#conteudoEvento").html(retorna);
    });
}   