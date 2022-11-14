<?php
    
    $ds = DIRECTORY_SEPARATOR;
    require "..".$ds."public".$ds."view-components".$ds."header.php";
?>
        <section class="conteudo limpa">
            <div class="page-title">
                Eventos
            </div>
            <?php
                $idEvent = password_hash("id_evento", PASSWORD_DEFAULT);
            ?>
            <div id="carregando"></div>
            <div id="conteudoEvento"></div>
            <script>

                var qnt_result_pg = 8; //quantidade de registro por página
                var pagina = 1; //página inicial
                var key = null;
                var idev = "<?php print $idEvent; ?>";

            </script>
            <script src="../public/js/index-eventos.js"></script>
        </section>
<?php

require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>