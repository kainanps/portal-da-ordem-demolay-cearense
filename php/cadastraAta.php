<?php
session_start();
if(isset($_POST["titulo_ata"]) && isset($_SESSION['tipo_usuario'])){

    $tituloAta = trim(strip_tags($_POST["titulo_ata"]));
    $capituloAta = trim(strip_tags($_POST["capitulo_ata"]));
    $dataAta = trim(strip_tags($_POST["data_ata"]));
    $arquivoAta = $_FILES["arquivo_ata"];

    if(empty($tituloAta) || empty($capituloAta)){
        echo "<script>alert('Erro de envio de ata');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
        exit;
    }

    $extensaoArquivo = pathinfo($arquivoAta['name'], PATHINFO_EXTENSION);


    if($extensaoArquivo!="pdf"){

        echo "<script>alert('Erro de upload de imagem');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";

    }else{
        
        $nomeDiretorio = md5("atas").DIRECTORY_SEPARATOR;
        $novoNome = md5(time()).".".$extensaoArquivo;

        var_dump($arquivoAta);

        $confirm = move_uploaded_file($arquivoAta['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$novoNome);
        
        echo $novoNome;
            
        if(!$confirm){
            echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/");
            exit;
        }

    }
        
        require "persistence.php";
        
            $ata = [
                1=>$tituloAta,
                $capituloAta,
                $dataAta,
                $novoNome
            ];
            
            $query = "INSERT INTO `atas` (`titulo_ata`, `capitulo_ata`, `data_ata`, `titulo_arquivo_ata`) VALUES (?, ?, ?, ?);";

            $stmt = new Persistence();
            $res = $stmt->runQuery($query, $ata);
            if(!$res){
                echo "<script>alert('Erro de inserção no banco!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
            }
            header("location: ../area-restrita/");
}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}
?>