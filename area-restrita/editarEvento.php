<?php 
session_start();
if(!isset($_GET[md5('id_evento')]) || $_SESSION['tipo_usuario'] != 2){
    header("location: ../page404.php");
    exit;
}else{

    require "../php/persistence.php";
    $stmt = new Persistence();

    $id = trim(strip_tags($_GET[md5('id_evento')]));
    $query = "SELECT * FROM eventos WHERE id_evento = ?";

    $evento = $stmt->verificaLogin($query, $id);
    if(empty($evento)){
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
            <div class="restrito formulario" id="evento">
                <form action="../php/atualizaEventos.php" method="post" enctype="multipart/form-data">
                    <center><label class="tituloDesc">Editar Evento:</label></center>
                    <input type="text" name="titulo_evento" class="inputForm inputTexto" placeholder="Titulo:" value="<?php echo $evento['titulo_evento'] ?>" >
                    <textarea name="conteudo_evento" class="inputForm arquivoConteudo" placeholder="Conteudo:"><?php echo $evento['conteudo_evento'] ?></textarea>
                    <label class="inputLabel" for="imagemId">Imagem:
                        <input type="file" name="imagem_evento" id="imagemId" accept="image/*">
                    </label>
                    <input type="hidden" name="nome_imagem"  value="<?php echo $evento['titulo_imagem'] ?>">
                    <input type="hidden" name="id_evento"  value="<?php echo $evento['id_evento'] ?>">
                    <input type="text" name="imagem_descricao" class="inputForm inputTexto" placeholder="Titulo/Descrição da Imagem:" value="<?php echo $evento['descricao_imagem'] ?>" >
                    <input type="text" name="autor_evento" class="inputForm inputTexto" placeholder="Autor:" value="<?php echo $evento['autor_evento'] ?>">
                    <div class="buttonEnviar"><input type="submit" value="Atualizar" class="entrar"></div>
                </form>
            </div>
    </div>
</body>
</html>