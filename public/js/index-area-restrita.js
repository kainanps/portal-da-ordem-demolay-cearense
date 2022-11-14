var qnt_result_pg = 5; //quantidade de registro por página
var pagina = 1; //página inicial

$(document).ready(function () {
    listar_ata(pagina, qnt_result_pg); //Chamar a função para listar os registros
    listar_prest(pagina, qnt_result_pg); //Chamar a função para listar os registros
    listar_decreto(pagina, qnt_result_pg); //Chamar a função para listar os registros
});

function listar_ata(pagina, qnt_result_pg){
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('../php/listarTabelaAta.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudoAtas"
        $("#conteudoAtas").html(retorna);
    });
}   
function excluir_ata(id_ata){
    var dados = {
        id_ata: id_ata
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiAtas.php', dados , function(retorna){
            listar_ata(pagina, qnt_result_pg);
        });
    }
}

function listar_prest(pagina_prest, qnt_pg){
    var dados = {
        pagina_prest: pagina_prest,
        qnt_pg: qnt_pg
    }
    $.post('../php/listarTabelaPrestacaoConta.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudoAtas"
        $("#conteudoPrest").html(retorna);
    });
}
function excluir_prest(id_prest){
    var dados = {
        id_prest: id_prest,
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiPrestacaoConta.php', dados , function(retorna){
            listar_prest(pagina, qnt_result_pg);
        });
    }
}   

function listar_decreto(pagina_decreto, qnt_pg_decreto){
    var dados = {
        pagina_decreto: pagina_decreto,
        qnt_pg_decreto: qnt_pg_decreto
    }
    $.post('../php/listarTabelaDecreto.php', dados , function(retorna){
        //Subtitui o valor no seletor id="conteudodecretos"
        $("#conteudoDecreto").html(retorna);
    });
}   
function excluir_decreto(id_decreto){
    var dados = {
        id_decreto: id_decreto
    }
    if(confirm("Tem certeza que deseja excluir?")){
        $.post('../php/excluiDecreto.php', dados , function(retorna){
            listar_decreto(pagina, qnt_result_pg);
        });
    }
}