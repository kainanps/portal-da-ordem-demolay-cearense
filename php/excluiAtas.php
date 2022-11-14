<?php
session_start();
if(isset($_POST["id_ata"]) && $_SESSION['tipo_usuario'] == 2){

    $idAta = filter_input(INPUT_POST, 'id_ata', FILTER_SANITIZE_NUMBER_INT);
    
    $ata = [
        1=>$idAta
    ];
    
    $query = "DELETE FROM `atas` WHERE `atas`.`id_ata` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $ata);

    if(!$res){
        echo "<script>alert('Erro de inserção no banco!');</script>";
    }    
}else{
    $ds = DIRECTORY_SEPARATOR; 
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}