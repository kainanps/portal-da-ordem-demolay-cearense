<?php
session_start();
if(isset($_POST["id_decreto"]) && $_SESSION['tipo_usuario'] == 2){

    $idDecreto = filter_input(INPUT_POST, 'id_decreto', FILTER_SANITIZE_NUMBER_INT);

    $decreto = [
        1=>$idDecreto
    ];

    $query = "DELETE FROM `decretos` WHERE `decretos`.`id_decreto` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $decreto);
    
    if(!$res){
        echo "<script>alert('Erro de inserção no banco!');</script>";
    }
      
}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}