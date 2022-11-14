<?php
session_start();

if(isset($_POST["id_prest"]) && $_SESSION['tipo_usuario'] == 2){

    $id_pConta = filter_input(INPUT_POST, 'id_prest', FILTER_SANITIZE_NUMBER_INT);

    $pConta = [
        1=>$id_pConta
    ];
    $query = "DELETE FROM `prestacaoconta` WHERE `prestacaoconta`.`id_pConta` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $pConta);
    if(!$res){
       echo "<script>alert('Erro de inserção no banco!');</script>";
    }
}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}