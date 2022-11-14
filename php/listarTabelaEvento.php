<?php

session_start();

if(!isset($_POST['pagina']) || $_SESSION["tipo_usuario"] != 2){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}

require "persistence.php";
$stmt = new Persistence();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_evento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT ?, ?";

$eventos = $stmt->selectNoticias($result_evento, $inicio, $qnt_result_pg);

if(!empty($eventos)){

?>
    <table class="table table-responsive">
        <div class="title-div"><label class="tituloDesc">Gerenciamento de Eventos:</label></div>
        <thead>
        <tr>
            <th>Titulo</th>
            <th>Conteudo</th>
            <th>Autor</th>
            <th>Editar</th>      
            <th>Excluir</th>      
        </tr>
        </thead>
        <tbody>
        <?php  
            
        foreach($eventos as $key => $value){
            echo "<tr>";
            echo "<td>".mb_substr($value['titulo_evento'],0,15,'utf8')."</td>";
            echo "<td>".mb_substr($value['conteudo_evento'],0,30,'utf8')."...</td>";
            echo "<td>$value[autor_evento]</td>";
            echo "<td><a href='editarEvento.php?" . md5('id_evento') . "=$value[id_evento]' class=' fancybox.iframe fancyboxFormulario'><button class='verMais blue'>Editar</button></a></td>";
            echo "<td><a onclick='excluir_evento($value[id_evento], $pagina)'><button class='verMais red'>Excluir</button></a></td>";
            echo "</tr>";
        }

        ?>

        </tbody>
    </table>

        <?php
        
            //Paginação - Somar a quantidade de Eventos
            $query = "SELECT COUNT(id_evento) AS num_result FROM eventos";
            $totEvento = $stmt->runExec($query);
            
            //Quantidade de pagina
            $totalEvento = ceil($totEvento["num_result"] / $qnt_result_pg);
            
            //Limitar os link antes depois
            $max_links = 2;

            echo"<div class='paginacao'>";
            echo "<a href='#conteudoPage' onclick='listar_evento(1, $qnt_result_pg)' class='firstLast'>First Event</a>";
            
            for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                if($pag_ant >= 1){
                    echo " <a href='#conteudoPage' onclick='listar_evento($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
                }
            }
            
            echo " <span class='pageSelected'>$pagina</span>";
            
            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if($pag_dep <= $totalEvento){
                    echo " <a href='#conteudoPage' onclick='listar_evento($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
                }
            }

            echo " <a href='#conteudoPage' onclick='listar_evento($totalEvento, $qnt_result_pg)' class='firstLast'>Last Event</a>";
            echo"</div>";

}else{
    echo "<div class='empty'>Nenhum evento enviado!</div>";
}

?>