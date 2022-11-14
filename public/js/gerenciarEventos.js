$('.fancybox').fancybox();
                
$('.fancyboxFormulario').fancybox({
    openEffect: 'fade',
    closeEffect: 'fade',
    openSpeed: 500,
    closeSpeed: 250,
    title: false
});

var qnt_result_pg = 8; //quantidade de registro por página
var pagina = 1; //página inicial
$(document).ready(function () {
    listar_noticia(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_noticia(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('../php/listarTabelaEvento.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudoPage"
        $("#conteudoPage").html(retorna);
    });
} 
function excluir_evento(id_evento, pag_evento){
    var dados = {
        id_evento: id_evento
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiEvento.php', dados , function(retorna){
            listar_noticia(pag_evento, qnt_result_pg);
        });
    }
} 