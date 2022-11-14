<?php

session_start();

if(!isset($_POST['pagina']) || $_SESSION["tipo_usuario"] != 2){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
    exit;
}

require "persistence.php";
$stmt = new Persistence();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_ouvidoria = "SELECT * FROM ouvidoria ORDER BY id_ouvidoria DESC LIMIT ?, ?";

$ouvidoria = $stmt->selectNoticias($result_ouvidoria, $inicio, $qnt_result_pg);

if(!empty($ouvidoria)){
        
    foreach($ouvidoria as $key => $value){
        echo "<div class='restrito formAreaRestrita'>";
        echo "<label class='inputLabel'>Nome:";
        echo "<p>$value[nome]</p></label>";
        echo "<label class='inputLabel'>Telefone:";
        echo "<p>$value[telefone]</p></label>";
        echo "<label class='inputLabel'>Cidade:";
        echo "<p>$value[cidade]</p></label>";
        echo "<label class='inputLabel'>Comentario:";
        echo "<p>$value[comentario]</p></label>";
        echo "<p><a onclick='excluir_ouvidoria($value[id_ouvidoria], $pagina)'><button class='verMais red'>Excluir</button></a></p>";
        echo "</div>";
    }

    ?>

    </tbody>
</table>

    <?php
    
        //Paginação - Somar a quantidade de ouvidoria
        $query = "SELECT COUNT(id_ouvidoria) AS num_result FROM ouvidoria";
        $totOuvidoria = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalOuvidoria = ceil($totOuvidoria["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoPage' onclick='listar_ouvidoria(1, $qnt_result_pg)' class='firstLast'>First Event</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoPage' onclick='listar_ouvidoria($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalOuvidoria){
                echo " <a href='#conteudoPage' onclick='listar_ouvidoria($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoPage' onclick='listar_ouvidoria($totalOuvidoria, $qnt_result_pg)' class='firstLast'>Last Event</a>";
        echo"</div>";

}else{
    echo "<div class='empty'>Nenhum comentario enviado!</div>";
}

    ?>