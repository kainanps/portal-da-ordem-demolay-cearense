var qnt_result_pg = 8; //quantidade de registro por página
var pagina = 1; //página inicial
$(document).ready(function () {
    listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_usuario(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('../php/listarTabelaUsuarios.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudoPage"
        $("#conteudoPage").html(retorna);
    });
}
function excluir_usuario(id_usuario, pag_usuario){
    var dados = {
        id_usuario: id_usuario
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiUsuario.php', dados , function(retorna){
            listar_usuario(pag_usuario, qnt_result_pg);
        });
    }
}