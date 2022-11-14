<?php
    session_start();

    $_SESSION['nome'] = null;
    $_SESSION['tipo_usuario'] = null;

    session_destroy();

    $ds = DIRECTORY_SEPARATOR;
    header("location: ..$ds"); 
?>