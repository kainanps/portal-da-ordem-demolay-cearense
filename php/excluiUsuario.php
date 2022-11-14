<?php

session_start();

if(isset($_POST["id_usuario"]) && $_SESSION['tipo_usuario'] == 2){

    $idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

    $usuario = [
        1=>$idUsuario
    ];
    $query = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $usuario);

    if(!$res){
        echo "<script>alert('Erro de inserção no banco!');</script>";
    }
    
}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}