<?php

session_start();

if(!isset($_POST['pagina_prest']) || !isset($_SESSION['tipo_usuario'])){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
    exit;
}


function excluirP_conta($id){
    if($_SESSION["tipo_usuario"] == 2){
        $excluir = "<td class='tcol download'><a onclick='excluir_prest($id)'><button class='verMais red'>Excluir</button></a></td>";
    }else{
        $excluir = "";
    }
    
    return $excluir;
}

require "persistence.php";
$stmt = new Persistence();

$pagina = filter_input(INPUT_POST, 'pagina_prest', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_pg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_pConta = "SELECT * FROM `prestacaoconta` ORDER BY id_pConta DESC LIMIT ?, ?";

$pContas = $stmt->selectNoticias($result_pConta, $inicio, $qnt_result_pg);

if(!empty($pContas)){
?>
<label class="tTitle">Prestações de Contas Enviadas:</label>
<table class="table table-responsive">
    <thead>
        <tr>
            <th title="Título da Prestação de Conta">
                Título
            </td>
            <th title="Capítulo">
                Capítulo
            </td>
            <th title="Data">
                Data
            </td>
            <th title="Frequência">
                Freq.
            </td>
            <th title="Download">
                Baixar
            </td>
            <?php
                if($_SESSION["tipo_usuario"] == 2){
            ?>
            <th  title="Remover Prestação de Conta">
                Excluir
            </td>
            <?php
                }
            ?>
        </tr> 
    </thead>
    <tbody>    
        <?php   

        $sep = DIRECTORY_SEPARATOR;
        $dirPrest = "..$sep"."php$sep".md5("prestacaoConta").$sep;

        foreach($pContas as $key => $value){
                $download = $dirPrest.$value['titulo_arquivo_pConta'];
                echo"<tr class='tlin'>";
                echo"<td class='tcol'>$value[titulo_pConta]</td>";
                echo"<td class='tcol'>$value[capitulo_pConta]</td>";
                echo"<td class='tcol'>".date("d/m/Y", strtotime($value['data_pConta']))."</td>";
                echo"<td class='tcol'>$value[frequencia_pConta]</td>";
                echo"<td class='tcol download'><a href=$download download><i class='material-icons'>arrow_downward</i></a></td>";
                echo excluirP_conta($value['id_pConta']);
            }

    ?>

    </tbody>
</table>

    <?php
    
        //Paginação - Somar a quantidade de pContas
        $query = "SELECT COUNT(id_pConta) AS num_result FROM prestacaoconta";
        $totpConta = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalpConta = ceil($totpConta["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoPrest' onclick='listar_prest(1, $qnt_result_pg)' class='firstLast'>First</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoPrest' onclick='listar_prest($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalpConta){
                echo " <a href='#conteudoPrest' onclick='listar_prest($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoPrest' onclick='listar_prest($totalpConta, $qnt_result_pg)' class='firstLast'>Last</a>";
        echo"</div>";

}else{
    echo "<div class='empty'>Nenhuma Prestação de Conta enviada!</div>";
}

    ?>