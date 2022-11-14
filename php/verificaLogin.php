<?php
session_start();
require "persistence.php";

if(isset($_POST["user"])){

    $nomeUsuario = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_EMAIL); // nome de usuario que vem da interface login
    $senhaUsuario = $_POST["pass"]; // senha que vem da interface login

    $stmt = new Persistence();

    $query = "SELECT * FROM usuarios WHERE identificador_usuario = ?";

    $usuario = $stmt->verificaLogin($query, $nomeUsuario);

    $resultado = password_verify($senhaUsuario, $usuario["senha_usuario"]);

    
    if ($resultado) {
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['nome'] = $usuario['nome_usuario'];
        echo "true";
    } else {
        echo "false";
    }
}