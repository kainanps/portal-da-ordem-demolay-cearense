<?php
require "persistence.php";
$stmt = new Persistence();

if(!password_verify("id_noticia", $_POST["id"]) || !isset($_POST["pagina"])){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
    exit;
}

if(!isset($_POST['key'])){
    
    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
    
    //calcular o inicio visualização
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
    
    $result_noticia = "SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT ?, ?";
    
    $noticias = $stmt->selectNoticias($result_noticia, $inicio, $qnt_result_pg);

    ?>
        <div class="noticia">
    <?php

    if(!empty($noticias)){
    
        foreach($noticias as $key => $value){
            echo "<div class='caixa-g-6 caixa-m-8'><div class='caixa limpa' id=noticia$key>";
            echo "<div class='box'>";
                    echo "<div class='date'>";
                    echo "<div id='daymonth'>" . date("d M", strtotime($value['data_noticia'])) . "</div>";
                    echo "<div id='year'>" . date("Y", strtotime($value['data_noticia'])) . "</div>";
                echo "</div>";
            echo "</div>";  
            echo"<img src=$value[titulo_imagem] class='imagemNoticia'>";
            echo "<h3>";
            echo $value['titulo_noticia']; 
            echo "</h3>";
            echo "<p>";
            echo $value['id_noticia'],mb_substr($value['conteudo_noticia'],0,300,'utf8')."...";
            echo "<button class='verMais green' onclick='listaUnica($value[id_noticia], $pagina)'>Ver Mais</button>";
            echo "</p></div></div>";
        }
    ?>
        </div>
    <?php

        //Paginação - Somar a quantidade de noticias
        $query = "SELECT COUNT(id_noticia) AS num_result FROM noticias";
        $totNoticia = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalNoticia = ceil($totNoticia["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoNoticia' onclick='listar_noticia(1, $qnt_result_pg)' class='firstLast'>First News</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoNoticia' onclick='listar_noticia($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalNoticia){
                echo " <a href='#conteudoNoticia' onclick='listar_noticia($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoNoticia' onclick='listar_noticia($totalNoticia, $qnt_result_pg)' class='firstLast'>Last News</a>";
        echo"</div>";
    }else{
        
        ?>
            <div class="caixa-g-12 caixa-m-8">
                <div class="caixa">
                    <figure class='imagemNoticiaOpen'>
                        <img src="imagens/interrogacao.png">
                    </figure>
                    <p class='red'>Nenhuma noticia enviada pelos administradores da página!</p>
                </div>
            </div>
        <?php
    }

}else{

    $display = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_NUMBER_INT);
    $page = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM noticias WHERE id_noticia = ?";
    $noticia = $stmt->selectUniq($query, $display);
    
    echo "<div class='caixa-g-12'><div class='caixa'>";
    echo "<div class='box'>";
        echo "<div class='date'>";
        echo "<div id='daymonth'>" . date("d M", strtotime($noticia['data_noticia'])) . "</div>";
        echo "<div id='year'>" . date("Y", strtotime($noticia['data_noticia'])) . "</div>";
        echo "</div>";
    echo "</div>";
    echo "<h3 class='open'>";
    echo $noticia['titulo_noticia']; 
    echo "</h3>";
    echo "<figure class='imagemNoticiaOpen'>";
    echo "<img src=$noticia[titulo_imagem] title=$noticia[descricao_imagem] alt=$noticia[descricao_imagem]>";
    echo "<figcaption>$noticia[descricao_imagem]</figcaption>";
    echo "</figure>";
    echo "<p>";
    echo nl2br($noticia['conteudo_noticia']);
    echo "<figure class='imagemNoticiaOpen'><figcaption>Por: $noticia[autor_noticia]</figcaption>";
    echo "<figcaption>Fontes: <pre>$noticia[fontes_noticia]</pre></figcaption></figure>";
    echo "<button class='verMais green' onclick='listar_noticia($page, 16)'>Voltar Para Notícias</button>";
    echo "</p></div></div>";
}
?>