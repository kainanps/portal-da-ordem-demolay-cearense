var qnt_result_pg = 8; //quantidade de registro por página
var pagina = 1; //página inicial
$(document).ready(function () {
    listar_ouvidoria(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_ouvidoria(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('../php/listarTabelaOuvidoria.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudoPage"
        $("#conteudoPage").html(retorna);
    });
}  
function excluir_ouvidoria(id_ouvidoria, pag_ouvidoria){
    var dados = {
        id_ouvidoria: id_ouvidoria
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiOuvidoria.php', dados , function(retorna){
            listar_ouvidoria(pag_ouvidoria, qnt_result_pg);
        });
    }
}