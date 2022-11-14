<?php
session_start();
if(isset($_POST["titulo_noticia"]) && $_SESSION['tipo_usuario'] == 2){
    
    $tituloNoticia = trim(strip_tags($_POST["titulo_noticia"]));
    $conteudoNoticia = trim(strip_tags($_POST["conteudo_noticia"]));
    $fontesNoticia = trim(strip_tags($_POST["fonte_noticia"]));
    $arquivoImagem = $_FILES["imagem_noticia"];
    $dataNoticia = trim(strip_tags($_POST["data_noticia"]));
    $descricaoImagem = trim(strip_tags($_POST["imagem_descricao"]));
    $autorNoticia = trim(strip_tags($_POST["autor_noticia"]));

    if(empty($tituloNoticia) || empty($conteudoNoticia) || empty($fontesNoticia) || empty($dataNoticia) || empty($autorNoticia)){
        echo "<script>alert('Erro de envio de noticia');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroNoticias.php'>";
        exit;
    }

    $extensoes = ['jpg', 'jpeg', 'gif', 'jp', 'png', 'ico'];
    $extensaoArquivo = pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION);

    echo $extensaoArquivo;

    if(!in_array($extensaoArquivo, $extensoes)){

        echo "<script>alert('Erro de upload de imagem');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroNoticias.php'>";

    }else{

        $nomeDiretorio = '..'.DIRECTORY_SEPARATOR.'imagens';
        $confirm = move_uploaded_file($arquivoImagem['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$arquivoImagem['name']);
        
        if(!$confirm){
            echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/admin.php");
            exit;
        }

        $caminhoImagem = 'imagens'.DIRECTORY_SEPARATOR.$arquivoImagem['name'];

        require "persistence.php";
        
        $noticia = [
            1=>$tituloNoticia,
            $conteudoNoticia,
            $fontesNoticia,
            $caminhoImagem,
            $dataNoticia,
            $descricaoImagem,
            $autorNoticia
        ];
        
        $query = "INSERT INTO `noticias` (`titulo_noticia`, `conteudo_noticia`, `fontes_noticia`, `titulo_imagem`, `data_noticia`, `descricao_imagem`, `autor_noticia`) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $stmt = new Persistence();
        $res = $stmt->runQuery($query, $noticia);
        
        if(!$res){
            echo "<script>alert('Erro de inserção no banco!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroNoticias.php'>";
        }
        
        header("location: ../area-restrita/cadastroNoticias.php");

    }

}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}
?>