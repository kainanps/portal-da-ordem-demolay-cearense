<?php

session_start();
if(isset($_POST["titulo_decreto"]) && $_SESSION['tipo_usuario'] == 2){

    $titulo_decreto = trim(strip_tags($_POST["titulo_decreto"]));
    $capitulo_decreto = trim(strip_tags($_POST["capitulo_decreto"]));
    $data_decreto = trim(strip_tags($_POST["data_decreto"]));
    $arquivo_decreto = $_FILES["arquivo_decreto"];

    if(empty($titulo_decreto) || empty($capitulo_decreto)){
        echo "<script>alert('Erro de envio de decreto');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
        exit;
    }

    $extensaoArquivo = pathinfo($arquivo_decreto['name'], PATHINFO_EXTENSION);


    if($extensaoArquivo!="pdf"){

        echo "<script>alert('Só são permtidos arquivos pdf');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
        exit;

    }else{
        
        $nomeDiretorio = md5("decretos").DIRECTORY_SEPARATOR;
        $novoNome = md5(time()).".".$extensaoArquivo;

        var_dump($arquivo_decreto);

        $confirm = move_uploaded_file($arquivo_decreto['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$novoNome);
        
        echo $novoNome;
            
        if(!$confirm){
            echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/admin.php");
            exit;
        }

    }
        
        require "persistence.php";
        
            $decreto = [
                1=>$titulo_decreto,
                $capitulo_decreto,
                $data_decreto,
                $novoNome
            ];
            
            $query = "INSERT INTO `decretos` (`titulo_decreto`, `capitulo_decreto`, `data_decreto`, `titulo_arquivo_decreto`) VALUES (?, ?, ?, ?);";

            $stmt = new Persistence();
            $res = $stmt->runQuery($query, $decreto);
            if(!$res){
                echo "<script>alert('Erro de inserção no banco!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
            }

            header("location: ../area-restrita/");
}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}
?>