<?php
session_start();
if(!isset($_POST['pagina_decreto']) || !isset($_SESSION['tipo_usuario'])){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}


function excluirDecreto($id){
    if($_SESSION["tipo_usuario"] == 2){
        $excluir = "<td class='tcol download'><a onclick='excluir_decreto($id)'><button class='verMais red'>Excluir</button></a></td>";
    }else{
        $excluir = "";
    }
    
    return $excluir;
}

require "persistence.php";
$stmt = new Persistence();

$pagina = filter_input(INPUT_POST, 'pagina_decreto', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_pg_decreto', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_decreto = "SELECT * FROM decretos ORDER BY id_decreto DESC LIMIT ?, ?";

$decretos = $stmt->selectNoticias($result_decreto, $inicio, $qnt_result_pg);

if(!empty($decretos)){
?>
<label class="tTitle">Decretos Enviados:</label>
<table class="table table-responsive">
    <thead>
        <tr>
            <th title="Título do Decreto">
                Título
            </th>
            <th title="Capítulo">
                Capítulo
            </th>
            <th title="Data">
                Data
            </th>
            <th title='Donwload'>
                Baixar
            </th>
        <?php
            if($_SESSION["tipo_usuario"] == 2){
        ?>
            <th title="Remover Decreto">
                Excluir
            </th>
        <?php
            }
        ?>
        </tr> 
    </thead>
    <tbody class="tcor">    
    <?php

        $pagina = filter_input(INPUT_POST, 'pagina_decreto', FILTER_SANITIZE_NUMBER_INT);
        $qnt_result_pg = filter_input(INPUT_POST, 'qnt_pg_decreto', FILTER_SANITIZE_NUMBER_INT);
        
        //calcular o inicio visualização
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
        
        $result_decreto = "SELECT * FROM decretos ORDER BY id_decreto DESC LIMIT ?, ?";
        
        $decretos = $stmt->selectNoticias($result_decreto, $inicio, $qnt_result_pg);

        $sep = DIRECTORY_SEPARATOR;
        $dirDecreto = "..$sep"."php$sep".md5("decretos").$sep;
                        
        foreach($decretos as $key => $value){
            $download =  $dirDecreto.$value['titulo_arquivo_decreto'];
            echo"<tr>";
            echo"<td>$value[titulo_decreto]</td>";
            echo"<td>$value[capitulo_decreto]</td>";
            echo"<td>".date("d/m/Y", strtotime($value['data_decreto']))."</td>";
            echo"<td class='download'><a href=$download download><i class='material-icons'>arrow_downward</i></a></td>";
            echo excluirDecreto($value['id_decreto']);
            echo"</tr>";
        }

    ?>

    </tbody>
</table>

    <?php
    
        //Paginação - Somar a quantidade de decretos
        $query = "SELECT COUNT(id_decreto) AS num_result FROM decretos";
        $totDecreto = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalDecreto = ceil($totDecreto["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoDecreto' onclick='listar_decreto(1, $qnt_result_pg)' class='firstLast'>First</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoDecreto' onclick='listar_decreto($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalDecreto){
                echo " <a href='#conteudoDecreto' onclick='listar_decreto($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoDecreto' onclick='listar_decreto($totalDecreto, $qnt_result_pg)' class='firstLast'>Last</a>";
        echo"</div>";

}else{
    echo "<div class='empty'>Nenhum Decreto enviado!</div>";
}

    ?>