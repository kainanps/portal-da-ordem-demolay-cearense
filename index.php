<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeMolay Ceará - Portal da Ordem DeMolay Cearense</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="public/css/caixas.css">
    <link rel="stylesheet" type="text/css" href="public/css/estilo-noticia.css">
    <link rel="icon" href="public/img/favicon1.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="public/js/funcoes.js"></script>
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
                                <div><?php echo substr($_SESSION['nome'],0,1); ?></div>
                                <label><?php echo $_SESSION['nome']; ?></label>
                                <a href="php/sessionDestroy.php"><button class="verMais red">Sair</button></a>
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
                <li class="aba flutuar checked">Início</li>
                <li class="aba flutuar">A Ordem DeMolay&#8628;
                    <ul class="menu2">
                        <a href="a-historia-da-ordem-demolay/">
                        <li class="aba2">
                            A história da ordem DeMolay
                        </li>
                        </a>
                        <a href="o-que-e-a-ordem-demolay/">
                            <li class="aba2">
                                O que é a ordem DeMolay
                            </li>
                        </a>
                    </ul>
                </li>
                <li class="aba flutuar">Ordem DeMolay no Ceará&#8628;
                    <ul class="menu2">
                        <a href="gce-ce/"><li class="aba2">GCE/CE</li></a>
                        <a href="gelj-ce/"><li class="aba2">GELJ/CE</li></a>
                    </ul>
                </li>
            <?php
                if(!isset($_SESSION['tipo_usuario'])){
            ?>  
                <li class="aba flutuar" onclick="showDiv('modal')">Área Restrita</li>
            <?php
                }else{
            ?>  
                <a href="area-restrita/"><li class="aba flutuar">Área Restrita</li></a>
            <?php
                }
            ?>  
                <a href="eventos/"><li class="aba flutuar">Eventos</li></a>
                <a href="ouvidoria/"><li class="aba flutuar">Ouvidoria Estadual</li></a>
            </ul>
        </nav>
        <section class="conteudo limpa">
            <div class="page-title">
                Início
            </div>
            <div id="carregando"></div>
            <div id="conteudoNoticia"></div>
            <?php
                $id = password_hash("id_noticia", PASSWORD_DEFAULT);
            ?>
            <script>

                var qnt_result_pg = 8; //quantidade de registro por página
                var pagina = 1; //página inicial
                var key = null;
                var idno = "<?php print $id; ?>";
   
            </script>
            <script src="public/js/index-noticias.js"></script>
        </section>
<?php
    $ds = DIRECTORY_SEPARATOR;
    require_once "public".$ds."view-components".$ds."footer.php";

    if(!isset($_SESSION['tipo_usuario'])){
?>
        <div class="modal-container" id="modal">
            <div class="modal">
                <div class="form">
                    <button class="close" type="button" onclick="showDiv('modal')"><i class="material-icons">close</i></button>
                    <div>
                        <h3 class="login">Login</h3>
                        <input type="text" name="identificador" id="usuario" class="caixaTexto" placeholder="Usuário" required>
                        <input type="password" name="senha" id="senha" class="caixaTexto" placeholder="Senha" required>
                        <div id="incorreto">&nbsp;</div>
                        <input type="submit" value="Entrar" class="entrar" id="entrar">
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>