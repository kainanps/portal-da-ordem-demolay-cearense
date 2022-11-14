<?php

session_start();
if(isset($_POST["titulo_pConta"]) && isset($_SESSION['tipo_usuario'])){
 
    
    $titulo_pre_con = trim(strip_tags($_POST["titulo_pConta"]));
    $capitulo_pre_con = trim(strip_tags($_POST["capitulo_pConta"]));
    $data_pre_con = trim(strip_tags($_POST["data_pConta"]));
    $frequencia_pre_con= trim(strip_tags($_POST["frequencia_pConta"]));
    $arquivo_pre_con = $_FILES["arquivo_pConta"];

    if(empty($titulo_pre_con) || empty($capitulo_pre_con) || empty($data_pre_con) || empty($frequencia_pre_con)){
        echo "<script>alert('Erro de envio de prestação de conta');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
        exit;
    }
    
    $extensaoArquivo = pathinfo($arquivo_pre_con['name'], PATHINFO_EXTENSION);


    if($extensaoArquivo!="pdf"){

        echo "<script>alert('Erro de upload de arquivo');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
        exit;


    }else{
        
        $nomeDiretorio = md5("prestacaoConta").DIRECTORY_SEPARATOR;
        $novoNome = md5(time()).".".$extensaoArquivo;

        $confirm = move_uploaded_file($arquivo_pre_con['tmp_name'], $nomeDiretorio.DIRECTORY_SEPARATOR.$novoNome);
            
        if(!$confirm){
            echo "<script>alert('Erro ao atualizar imagem!');</script>";
            header("location: ../area-restrita/admin.php");
            exit;
        }

    }
        
    require "persistence.php";
    require "../public/libs/PHPMailer/enviar_email.php";

        $stmt = new Persistence();
        
            $prestacaoConta = [
                1=>$titulo_pre_con,
                $capitulo_pre_con,
                $data_pre_con,
                $frequencia_pre_con,
                $novoNome
            ];
            
            $query = "INSERT INTO `prestacaoconta` (`titulo_pConta`, `capitulo_pConta`, `data_pConta`, `frequencia_pConta`, `titulo_arquivo_pConta`) VALUES (?, ?, ?, ?, ?);";
            
            $res = $stmt->runQuery($query, $prestacaoConta);
            
            if(!$res){
                echo "<script>alert('Erro de inserção no banco!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
                exit;
            }
    $resEmail = enviarEmail($capitulo_pre_con, $titulo_pre_con, $nomeDiretorio.$novoNome, $data_pre_con, $frequencia_pre_con);
    if($resEmail){
        echo "<script>alert('Arquivo cadastrado com sucesso! compartilhado com: tesourariagcece@gmail.com');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
	}else{
        echo "<script>alert('Arquivo cadastrado com sucesso!Erro no envio do e-mail para: tesourariagcece@gmail.com" . $Mailer->ErrorInfo."');</script><meta http-equiv='refresh' content='0; http:../area-restrita/'>";
	}
}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}