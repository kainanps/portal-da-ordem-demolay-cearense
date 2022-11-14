<?php
session_start();
if(isset($_POST["titulo_evento"]) && $_SESSION['tipo_usuario'] == 2){
        
    $tituloEvento = trim(strip_tags($_POST["titulo_evento"]));
    $conteudoEvento = trim(strip_tags($_POST["conteudo_evento"]));
    $arquivoImagem = $_FILES["imagem_evento"];
    $dataEvento = trim(strip_tags($_POST["data_evento"]));
    $descricaoImagem = trim(strip_tags($_POST["imagem_descricao"]));
    $autorEvento = trim(strip_tags($_POST["autor_evento"]));

    if(empty($tituloEvento) || empty($conteudoEvento) || empty($dataEvento) || empty($descricaoImagem) || empty($autorEvento)){
            echo "<script>alert('Erro de envio de evento');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroEventos.php'>";
            exit;
    }

    $extensoes = ['jpg', 'jpeg', 'gif', 'jp', 'png', 'ico'];
    $extensaoArquivo = pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION);

    if(!in_array($extensaoArquivo, $extensoes)){

        echo "<script>alert('Erro de upload de imagem');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroEventos.php'>";
        
    }else{

        $nomeDiretorio = '..'.DIRECTORY_SEPARATOR.'imagens';
        $confirm = move_uploaded_file($arquivoImagem['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$arquivoImagem['name']);
        
        if(!$confirm){
            echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/cadastroEventos.php");
            exit;
        }

        $caminhoImagem = 'imagens'.DIRECTORY_SEPARATOR.$arquivoImagem['name'];

        require "persistence.php";
        
        $evento = [
            1=>$tituloEvento,
            $conteudoEvento,
            $caminhoImagem,
            $dataEvento,
            $descricaoImagem,
            $autorEvento
        ];
        
        $query = "INSERT INTO `eventos` (`titulo_evento`, `conteudo_evento`, `titulo_imagem`, `data_evento`, `descricao_imagem`, `autor_evento`) VALUES (?, ?, ?, ?, ?, ?);";
        
        $stmt = new Persistence();
        $res = $stmt->runQuery($query, $evento);
        
        if(!$res){
            echo "<script>alert('Erro de inserção no banco!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroEventos.php'>";
        }

        header("location: ../area-restrita/cadastroEventos.php");

    }
}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}

?>