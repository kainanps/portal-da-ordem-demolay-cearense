<?php
session_start();
if(isset($_POST["id_evento"]) && $_SESSION['tipo_usuario'] == 2){

    $idEvento = filter_input(INPUT_POST, 'id_evento', FILTER_SANITIZE_NUMBER_INT);

    $evento = [
        1=>$idEvento
    ];
    $query = "DELETE FROM `eventos` WHERE `eventos`.`id_evento` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $evento);
        
    if(!$res){
        echo "<script>alert('Erro de inserção no banco!');</script>";
    }  
    
}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}