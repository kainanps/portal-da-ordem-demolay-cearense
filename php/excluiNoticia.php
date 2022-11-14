<?php
session_start();
   
if(isset($_POST["id_noticia"]) && $_SESSION['tipo_usuario'] == 2){

    $idNoticia = filter_input(INPUT_POST, 'id_noticia', FILTER_SANITIZE_NUMBER_INT);
   
    $noticia = [
        1=>$idNoticia
    ];
    
    $query = "DELETE FROM `noticias` WHERE `noticias`.`id_noticia` = ?;";

    require "persistence.php";
    $stmt = new Persistence();
    $res = $stmt->runQuery($query, $noticia);

    if(!$res){
       echo "<script>alert('Erro de inserção no banco!');</script>";
    }

}else{
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}