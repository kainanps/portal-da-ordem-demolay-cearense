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
    
    $result_noticia = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT ?, ?";
    
    $noticias = $stmt->selectNoticias($result_noticia, $inicio, $qnt_result_pg);
    
    if(!empty($noticias)){
?>

    <table class="table table-responsive">
        <div class="title-div"><label class="tituloDesc">Gerenciamento de Noticias:</label></div>
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

            
        foreach($noticias as $key => $value){
            echo "<tr>";
            echo "<td>".mb_substr($value['titulo_noticia'],0,15,'utf8')."</td>";
            echo "<td>".mb_substr($value['conteudo_noticia'],0,30,'utf8')."...</td>";
            echo "<td>$value[autor_noticia]</td>";
            echo "<td><a href='editarNoticia.php?" . md5('id_noticia') . "=$value[id_noticia]' class='fancybox.iframe fancyboxFormulario'><button class='verMais blue'>Editar</button></a></td>";
            echo "<td><a onclick='excluir_noticia($value[id_noticia], $pagina)'><button class='verMais red'>Excluir</button></a></td>";
            echo "</tr>";
        }

        ?>

        </tbody>    
    </table>

    <?php
    
        //Paginação - Somar a quantidade de noticias
        $query = "SELECT COUNT(id_noticia) AS num_result FROM noticias";
        $totNoticia = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalNoticia = ceil($totNoticia["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoPage' onclick='listar_noticia(1, $qnt_result_pg)' class='firstLast'>First News</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoPage' onclick='listar_noticia($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalNoticia){
                echo " <a href='#conteudoPage' onclick='listar_noticia($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoPage' onclick='listar_noticia($totalNoticia, $qnt_result_pg)' class='firstLast'>Last News</a>";
        echo"</div>";

}else{
    echo "<div class='empty'>Nenhuma noticia enviada!</div>";
}

    ?>