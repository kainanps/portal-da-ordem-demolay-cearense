<div class="modal-ouvidoria">
<?php
if(isset($_POST["name"])){
 
    
        $nome = trim(strip_tags($_POST["name"]));
        $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
        $cidade = trim(strip_tags($_POST["city"]));
        $comentario = trim(strip_tags($_POST["coment"]));
        
        if(empty($nome)){
            ?>
            
            <div class="ouvidoria">
                Erro ao enviar Comentario!
                <button class="btn-ouvidoria red" onclick="limparComentario();">OK</button>
            </div>
            
            <?php
            exit;
        }

    require "persistence.php";
    $stmt = new Persistence();

    $prestacaoConta = [
        1=>$nome,
        $telefone,
        $cidade,
        $comentario
    ];

        
    $query = "INSERT INTO `ouvidoria` (`nome`, `telefone`, `cidade`, `comentario`) VALUES (?, ?, ?, ?);";

    $res = $stmt->runQuery($query, $prestacaoConta);

    if(!$res){
        ?>
            
            <div class="ouvidoria">
                Erro de inserção no banco
                <button class="btn-ouvidoria green" onclick="limparComentario();">OK</button>
            </div>
    
        <?php
    }
    ?>
            
        <div class="ouvidoria">
            Comentário enviado com sucesso!
            <button class="btn-ouvidoria green" onclick="limparComentario();">OK</button>
        </div>
    
    <?php

}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}
?>
</div>