<link rel="stylesheet" href="../public/css/estilo.css">
<?php
session_start();
if(isset($_POST["id_noticia"]) && $_SESSION['tipo_usuario'] == 2){
        
    $idNoticia = $_POST["id_noticia"];
    $tituloNoticia = trim(strip_tags($_POST["titulo_noticia"]));
    $conteudoNoticia = trim(strip_tags($_POST["conteudo_noticia"]));
    $fontesNoticia = trim(strip_tags($_POST["fonte_noticia"]));
    $descricaoImagem = trim(strip_tags($_POST["imagem_descricao"]));
    $autorNoticia = trim(strip_tags($_POST["autor_noticia"]));

    if(empty($tituloNoticia) || empty($conteudoNoticia) || empty($fontesNoticia) || empty($descricaoImagem) || empty($autorNoticia)){
        ?>
            <div class="modal-container" style='display: block; background-color: white;'>
                <div class="modal">
                    <span class="entrar" style='background: red;'>Erro de atuaização de noticia!</span>
                </div>
            </div>
        <?php
            exit;
    }

    if(!empty($_FILES["imagem_noticia"]["name"])){

        $arquivoImagem = $_FILES["imagem_noticia"];
        $extensoes = ['jpg', 'jpeg', 'gif', 'jp', 'png', 'ico'];
        $extensaoArquivo = pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION);

        if(!in_array($extensaoArquivo, $extensoes)){
            echo "Erro de upload de imagem";
            exit;
        }
        $nomeDiretorio = '..'.DIRECTORY_SEPARATOR.'imagens';
        $confirm = move_uploaded_file($arquivoImagem['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$arquivoImagem['name']);
        
        if(!$confirm){
            echo "Erro ao atualizar imagem!";
            // echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/editarNoticia.php?id=$idNoticia");
            exit;
        }
        
        $nomeImagem = 'imagens'.DIRECTORY_SEPARATOR.$arquivoImagem['name'];

    }else{
        $nomeImagem = trim(strip_tags($_POST["nome_imagem"]));
    }


        require "persistence.php";
        
        $noticia = [
            1=>$tituloNoticia,
            $conteudoNoticia,
            $fontesNoticia,
            $nomeImagem,
            $descricaoImagem,
            $autorNoticia,
            $idNoticia
        ];
        
        $query = "UPDATE `noticias` SET `titulo_noticia` = ?, `conteudo_noticia` = ?, `fontes_noticia` = ?, `titulo_imagem` = ?, `descricao_imagem` = ?, `autor_noticia` = ? WHERE `noticias`.`id_noticia` = ?;";

        $stmt = new Persistence();
        $res = $stmt->runQuery($query, $noticia);
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
