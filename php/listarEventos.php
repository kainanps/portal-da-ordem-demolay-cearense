<?php
require "persistence.php";
$stmt = new Persistence();

if(!password_verify("id_evento", $_POST["id"]) || !isset($_POST["pagina"])){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
    exit;
}

if(!isset($_POST['key'])){
    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    
    //calcular o inicio visualização
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
    
    $result_evento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT ?, ?";
    
    $eventos = $stmt->selectNoticias($result_evento, $inicio, $qnt_result_pg);
    if(!empty($eventos)){

    ?>
        <div class="noticia">
    <?php
        
        foreach($eventos as $key => $value){
            echo "<div class='caixa-g-6 caixa-m-8'><div class='caixa limpa' id=evento$key><h3>";
            echo "<div class='box'>";
                echo "<div class='date'>";
                    echo "<div id='daymonth'>" . date("d M", strtotime($value['data_evento'])) . "</div>";
                    echo "<div id='year'>" . date("Y", strtotime($value['data_evento'])) . "</div>";
                echo "</div>";
            echo "</div>"; 
            echo"<img src=../$value[titulo_imagem] style='width: 100%; height: 270px;'>";
            echo $value['titulo_evento']; 
            echo "</h3>";
            echo "<p>";
            echo $value['id_evento'],mb_substr($value['conteudo_evento'],0,300,'utf8')."...";
            echo "<button class='verMais green' onclick='listaUnica($value[id_evento], $pagina)'>Ver Mais</button>";
            echo "</p></div></div>";
        }

    ?>
        </div>
    <?php

        //Paginação - Somar a quantidade de eventos
        $query = "SELECT COUNT(id_evento) AS num_result FROM eventos";
        $totevento = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalEvento = ceil($totevento["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoEvento' onclick='listar_evento(1, $qnt_result_pg)' class='firstLast'>First News</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoEvento' onclick='listar_evento($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalEvento){
                echo " <a href='#conteudoEvento' onclick='listar_evento($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoEvento' onclick='listar_evento($totalEvento, $qnt_result_pg)' class='firstLast'>Last News</a>";
        echo"</div>";
    }else{
        ?>
            <div class="caixa-g-12 caixa-m-8">
                <div class="caixa">
                    <figure class='imagemNoticiaOpen'>
                        <img src="../imagens/interrogacao.png">
                    </figure>
                    <p class='red'>Nenhum evento enviado pelos administradores da página!</p>
                </div>
            </div>
        <?php
    }

}else{

    $display = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_NUMBER_INT);
    $page = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    
    $query = "SELECT * FROM eventos WHERE id_evento = ?";
    $evento = $stmt->selectUniq($query, $display);
    
    echo "<div class='caixa-g-12'><div class='caixa'>";
    echo "<div class='box'>";
        echo "<div class='date'>";
            echo "<div id='daymonth'>" . date("d M", strtotime($evento['data_evento'])) . "</div>";
            echo "<div id='year'>" . date("Y", strtotime($evento['data_evento'])) . "</div>";
        echo "</div>";
    echo "</div>";
    echo "<h3 class='open'>";
    echo $evento['titulo_evento']; 
    echo "</h3>";
    echo "<figure class='imagemNoticiaOpen'>";
    echo "<img src=../$evento[titulo_imagem] title=$evento[descricao_imagem] alt=$evento[descricao_imagem]>";
    echo "<figcaption>$evento[descricao_imagem]</figcaption>";
    echo "</figure>";
    echo "<p>";
    echo nl2br($evento['conteudo_evento']);
    echo "<figure class='imagemNoticiaOpen'><figcaption>Por: $evento[autor_evento]</figcaption></figure>";
    echo "<button class='verMais green' onclick='listar_evento($page, 16)'>Voltar Para Eventos</button>";
    echo "</p></div></div>";
}
?>