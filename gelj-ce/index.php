<?php
    
    $ds = DIRECTORY_SEPARATOR;
    require "..".$ds."public".$ds."view-components".$ds."header.php";
?>

<script src="../public/libs/fancybox/jquery.fancybox.js"></script>
<script>
    $('.fancybox').fancybox();
</script>
<script src="../public/js/slide.js"></script>
<link rel="stylesheet" href="../public/libs/fancybox/jquery.fancybox.css">
        <section class="conteudo limpa">
            <div class="page-title">
                GELJ/CE
            </div>
            <div class="caixa-g-6 caixa-m-6">
                <div class="caixa box-img">
                    <a class="fancybox" href="../public/img/Anderson-Vasconcelos.jpeg" data-fancybox-group="gallery" title="Anderson Vasconcelos - Mestre Conselheiro Estadual do Estado do Ceará"><img src="../public/img/Anderson-Vasconcelos.jpeg" alt="Anderson Vasconcelos - Mestre Conselheiro Estadual do Estado do Ceará" class="gce-img"></a>
                    <span>Anderson Vasconcelos - Mestre Conselheiro Estadual do Estado do Ceará</span>
                </div>
            </div>
            <div class="caixa-g-6 caixa-m-6">
                <div class="caixa box-img">
                    <a class="fancybox" href="../public/img/Jardel-Cavalcante.jpeg" data-fancybox-group="gallery" title="Jardel Cavalcante - Secretário Geral do Gabinete Estadual da Liderança Juvenil do Estado do Ceará"><img src="../public/img/Jardel-Cavalcante.jpeg" alt="Jardel Cavalcante - Secretário Geral do Gabinete Estadual da Liderança Juvenil do Estado do Ceará" class="gce-img"></a>
                    <span>Jardel Cavalcante - Secretário Geral do Gabinete Estadual da Liderança Juvenil do Estado do Ceará</span>
                </div>
            </div>
        </section>
        <script src="../public/libs/fancybox/jquery.fancybox.js"></script>
<?php

require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>