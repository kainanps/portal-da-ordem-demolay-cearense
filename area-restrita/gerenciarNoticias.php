<?php

    require_once "header.php";
    
?>
   <div id="conteudoPage"></div>
            <!-- LINK DO FANCYBOX -->
            <link rel="stylesheet" href="../public/libs/fancybox/jquery.fancybox.css">
            <script src="../public/libs/fancybox/jquery.fancybox.js"></script>
            <script src="../public/js/gerenciarNoticias.js"></script>
                    
        </section>
<?php

$ds = DIRECTORY_SEPARATOR;
require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>