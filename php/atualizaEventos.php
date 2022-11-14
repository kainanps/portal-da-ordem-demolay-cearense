<link rel="stylesheet" href="../public/css/estilo.css">
<?php
session_start();
if(isset($_POST["id_evento"]) && $_SESSION['tipo_usuario'] == 2){

    $idEvento = $_POST["id_evento"];
    $tituloEvento = trim(strip_tags($_POST["titulo_evento"]));
    $conteudoEvento = trim(strip_tags($_POST["conteudo_evento"]));
    $descricaoImagem = trim(strip_tags($_POST["imagem_descricao"]));
    $autorEvento = trim(strip_tags($_POST["autor_evento"]));

    if(empty($tituloEvento) || empty($conteudoEvento) || empty($descricaoImagem) || empty($autorEvento)){
        ?>
            <div class="modal-container" style='display: block; background-color: white;'>
                <div class="modal">
                    <span class="entrar" style='background: red;'>Erro de atuaização de evento!</span>
                </div>
            </div>
        <?php
            exit;
    }

    if(!empty($_FILES["imagem_evento"]["name"])){

        $arquivoImagem = $_FILES["imagem_evento"];
        $extensoes = ['jpg', 'jpeg', 'gif', 'jp', 'png', 'ico'];
        $extensaoArquivo = pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION);

        echo $extensaoArquivo;

        if(!in_array($extensaoArquivo, $extensoes)){

        ?>
            <div class="modal-container" style='display: block; background-color: white;'>
                <div class="modal">
                    <span class="entrar" style='background: red;'>Erro de upload de imagem!</span>
                </div>
            </div>
        <?php
            exit;

        }
        $nomeDiretorio = '..'.DIRECTORY_SEPARATOR.'imagens';
        $confirm = move_uploaded_file($arquivoImagem['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$arquivoImagem['name']);
        
        if(!$confirm){
            ?>
                <div class="modal-container" style='display: block; background-color: white;'>
                    <div class="modal">
                        <span class="entrar" style='background: red;'>Erro ao atualizar imagem!</span>
                    </div>
                </div>
            <?php

            exit;        
        }
        
        $nomeImagem = 'imagens'.DIRECTORY_SEPARATOR.$arquivoImagem['name'];

    }else{
        $nomeImagem = trim(strip_tags($_POST["nome_imagem"]));
    }


        require "persistence.php";
        
        $evento = [
            1=>$tituloEvento,
            $conteudoEvento,
            $nomeImagem,
            $descricaoImagem,
            $autorEvento,
            $idEvento
        ];
        
        $query = "UPDATE `eventos` SET `titulo_evento` = ?, `conteudo_evento` = ?, `titulo_imagem` = ?,`descricao_imagem` = ?, `autor_evento` = ? WHERE `eventos`.`id_evento` = ?;";

        $stmt = new Persistence();
        $res = $stmt->runQuery($query, $evento);
        
        if(!$res){
            ?>
                <div class="modal-container" style='display: block; background-color: white;'>
                    <div class="modal">
                        <span class="entrar" style='background: red;'>Erro ao fazer inserção no banco!</span>
                    </div>
                </div>
            <?php
            exit;
        }
        ?>
            <div class="modal-container" style='display: block; background-color: white;'>
                <div class="modal">
                    <span class="entrar" style='background: green;'>Atualizado com sucesso!</span>
                </div>
            </div>
        <?php
}else{

        $ds = DIRECTORY_SEPARATOR;     
        header("location: ..".$ds."public".$ds."view-components".$ds."page404.php");
}
?>