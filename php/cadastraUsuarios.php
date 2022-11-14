<?php
session_start();
if(isset($_POST["nome_usuario"]) && $_SESSION['tipo_usuario'] == 2){
 
    $nomeUsuario = trim(strip_tags($_POST["nome_usuario"]));
    $identificadorUsuario = filter_input(INPUT_POST, 'identificador_usuario', FILTER_SANITIZE_EMAIL);
    $senhaUsuario = trim(strip_tags($_POST["senha_usuario"]));
    $tipoUsuario = trim(strip_tags($_POST["tipo_usuario"]));

    if(empty($nomeUsuario) || empty($identificadorUsuario) || empty($senhaUsuario) || empty($tipoUsuario)){
        echo "<script>alert('Erro no cadastro de usuário');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroUsuarios.php'>";
        exit;
    }

    $novaSenhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);

        require "persistence.php";
        
        $usuario = [
            1=>$nomeUsuario,
            $identificadorUsuario,
            $novaSenhaUsuario,
            $tipoUsuario
        ];
        
        $query = "INSERT INTO `usuarios` (`nome_usuario`, `identificador_usuario`, `senha_usuario`, `tipo_usuario`) VALUES (?, ?, ?, ?);";

        $stmt = new Persistence();
        $res = $stmt->runQuery($query, $usuario);
        
        if(!$res){
            echo "<script>alert('Este usuario já existe!');</script><meta http-equiv='refresh' content='0; http:../area-restrita/cadastroUsuarios.php'>";
            exit;
        }
                
        header("location: ../area-restrita/cadastroUsuarios.php");
        
}else{
$ds = DIRECTORY_SEPARATOR;
header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}
?>