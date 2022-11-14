<?php 

session_start();
if(!isset($_GET[md5('id_noticia')]) || $_SESSION['tipo_usuario'] != 2){
    header("location: ../page404.php");
    exit;
}else{

    require "../php/persistence.php";
    $stmt = new Persistence();

    $id = trim(strip_tags($_GET[md5('id_noticia')]));
    $query = "SELECT * FROM noticias WHERE id_noticia = ?";

    $noticia = $stmt->verificaLogin($query, $id);
    if(empty($noticia)){
        header("location: ../page404.php");
    }
    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeMolay Ceará - Portal da Ordem DeMolay Cearense</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo-area-restrita.css">
    <link rel="icon" href="../public/img/favicon1.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="../public/js/funcoes.js"></script>
    
</head>
<body>
    <div class="container">
            <div class="restrito formulario" id="noticia">
                <form action="../php/atualizaNoticias.php" method="post" enctype="multipart/form-data">
                    <center><label class="tituloDesc">Editar Notícia:</label></center>
                    <input type="text" name="titulo_noticia" class="inputForm inputTexto" placeholder="Titulo:" value="<?php echo $noticia['titulo_noticia'] ?>" >
                    <textarea name="conteudo_noticia" class="inputForm arquivoConteudo" placeholder="Conteudo:"><?php echo $noticia['conteudo_noticia'] ?></textarea>
                    <input type="text" name="fonte_noticia" class="inputForm inputTexto" placeholder="Bibliografia, Fontes..." value="<?php echo $noticia['fontes_noticia'] ?>" >
                    <label class="inputLabel" for="imagemId">Imagem:
                        <input type="file" name="imagem_noticia" id="imagemId" accept="image/*">
                    </label>
                    <input type="hidden" name="nome_imagem"  value="<?php echo $noticia['titulo_imagem'] ?>">
                    <input type="hidden" name="id_noticia"  value="<?php echo $noticia['id_noticia'] ?>">
                    <input type="text" name="imagem_descricao" class="inputForm inputTexto" placeholder="Titulo/Descrição da Imagem:" value="<?php echo $noticia['descricao_imagem'] ?>" >
                    <input type="text" name="autor_noticia" class="inputForm inputTexto" placeholder="Autor:" value="<?php echo $noticia['autor_noticia'] ?>">
                    <div class="buttonEnviar"><input type="submit" value="Atualizar" class="entrar"></div>
                </form>
            </div>
    </div>
</body>
</html>