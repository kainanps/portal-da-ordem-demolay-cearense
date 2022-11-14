<?php
session_start();


if(isset($_POST["id_ouvidoria"])&& $_SESSION['tipo_usuario'] == 2){

    $idOuvidoria = filter_input(INPUT_POST, 'id_ouvidoria', FILTER_SANITIZE_NUMBER_INT);

    
    $ouvidoria = [
        1=>$idOuvidoria
    ];
    $query = "DELETE FROM `ouvidoria` WHERE `ouvidoria`.`id_ouvidoria` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $ouvidoria);
        
    if(!$res){
        echo "<script>alert('Erro de remoção no banco!');</script>";
    }
    
}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}