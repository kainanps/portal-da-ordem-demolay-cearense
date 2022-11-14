<?php 
session_start();

if(!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 1){
    header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeMolay Ceará - Portal da Ordem DeMolay Cearense</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo-area-restrita.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo-area-gerencial.css">
    <link rel="icon" href="../public/img/favicon1.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="../public/js/funcoes.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">

        <header class="cabecalho">
            <div class="barraSuperior">
                <div class="cell">
                <?php 
                    if(isset($_SESSION['tipo_usuario'])){
                ?>
                        <div class="nome"><span class="online">&#9679;</span>Online&#8628;
                            <div class="sair">
                                <span>&#9650;</span>
                                <div style="width: 50px;"><?php echo substr($_SESSION['nome'],0,1); ?></div>
                                <label><?php echo substr($_SESSION['nome'],0,20); ?></label>
                                <a href="../php/sessionDestroy.php"><button class="verMais red">Sair</button></a>
                            </div>
                        </div>
                <?php
                    }
                ?>
                    
                    <h1 class="bemvindo">
                            Supremo Conselho da Ordem DeMolay para o Brasil
                    </h1>
                </div>
            </div>
        </header>
        <nav class="barra2">
            <div class="barra-menu">
                <button>
                    <label for="menu"><i class="material-icons">menu</i></label>
                </button>
            </div>
            <input type="checkbox" id="menu">
            <ul class="menu">
                <a href="../index.php">
                    <li class="aba flutuar checked">Início</li>
                </a>
                <li class="aba flutuar">A Ordem DeMolay&#8628;
                    <ul class="menu2">
                        <a href="../a-historia-da-ordem-demolay/">
                        <li class="aba2">
                            A história da ordem DeMolay
                            </li>
                        </a>
                        <a href="../o-que-e-a-ordem-demolay/">
                            <li class="aba2">
                                O que é a ordem DeMolay
                            </li>
                        </a>
                    </ul>
                </li>
                <li class="aba flutuar">Ordem DeMolay no Ceará&#8628;
                    <ul class="menu2">
                        <a href="../gce-ce/"><li class="aba2">GCE/CE</li></a>
                        <a href="../gelj-ce/"><li class="aba2">GELJ/CE</li></a>
                    </ul>
                </li>
                <a href="."><li class="aba flutuar">Área Restrita</li></a>
                <a href="../eventos/"><li class="aba flutuar">Eventos</li></a>
                <a href="../ouvidoria/"><li class="aba flutuar">Ouvidoria Estadual</li></a>
            </ul>
        </nav>
        <section class="conteudo limpa">
            <div class="page-title">
                <ul class="menuUl">
                    <li class="list">Área de Cadastro
                        <ul class="menuUl2">
                            <a href="cadastroNoticias.php"><li class="list2">Notícias</li></a>
                            <a href="cadastroUsuarios.php"><li class="list2">Usuários</li></a>
                            <a href="cadastroEventos.php"><li class="list2">Eventos</li></a>
                        </ul>
                    </li class="list">
                    <li class="list">Opções
                        <ul class="menuUl2">
                            <a href="gerenciarNoticias.php"><li class="list2">Gerenciar Notícias</li></a>
                            <a href="gerenciarUsuarios.php"><li class="list2">Gerenciar Usuários</li></a>
                            <a href="gerenciarEventos.php"><li class="list2">Gerenciar Eventos</li></a>
                            <a href="gerenciarOuvidoria.php"><li class="list2">Gerenciar Ouvidoria</li></a>
                        </ul>
                    </li>
                </ul>
            </div>