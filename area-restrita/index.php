<?php
session_start();

if(!isset($_SESSION['tipo_usuario'])){
    header("location: ../index.php");
}else{
    $us = $_SESSION['tipo_usuario'];
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
    <link rel="stylesheet" type="text/css" href="../public/css/caixas.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo-area-restrita.css">
    <link rel="stylesheet" type="text/css" href="../public/css/estilo-area-gerencial.css">
    <link rel="icon" href="../public/img/favicon1.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="../public/js/funcoes.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">
<!-- CABEÇALHO -->
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
<!-- MENU DE NAVEGAÇÃO -->
<nav class="barra2">
    <div class="barra-menu">
        <button>
            <label for="menu"><i class="material-icons">menu</i></label>
        </button>
    </div>
    <input type="checkbox" id="menu">
    <ul class="menu">
        <a href="../index.php"><li class="aba flutuar">Início</li></a>
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
    <li class="aba flutuar checked">Área Restrita&#8628;
        <ul class="menu2">
            <a href="#ata">
                <li class="aba2" onclick="showDiv('ata')">
                        Enviar Ata
                    </li>          
                </a>    
                <a href="#prest">      
                    <li class="aba2" onclick="showDiv('prest')">
                            Enviar Prestação de Contas                        
                        </li>
                    </a>
                <?php
                    if($us == 2){
                ?>
                    <a href="#decreto">      
                        <li class="aba2" onclick="showDiv('decreto')">
                                Enviar Decretos                        
                        </li>
                    </a>
                <?php
                    }
                ?>
                    </ul>
                </li>
                <a href="../eventos/"><li class="aba flutuar">Eventos</li></a>
                <a href="../ouvidoria/"><li class="aba flutuar">Ouvidoria Estadual</li></a>
            </ul>
        </nav>
        <!-- PÁGINA QUE CONTÉM TODO CONTEUDO -->
        <section class="conteudo">
            <div class="page-title">
            <?php
                if($us == 2){
            ?>
                    <!-- MENU DO ADMIN DA PAGINA -->
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
            <?php
                }else{
            ?>
                Área Restrita
            <?php
                }
            ?>
        </div>
        <!-- FORMULÁRIO DE CADASTRO DE ATAS -->
        <div class="restrito formAreaRestrita sumir" id="ata">         
            <form action="../php/cadastraAta.php" method="POST" enctype="multipart/form-data">
                    <button type="button" class="fechando" onclick="showDiv('ata')"><i class="material-icons">close</i></button>
                    <h5 class="tituloDesc">Enviar Atas</h5>
                    <label for="titulo" class="inputLabel">Titulo:
                        <input type="text" name="titulo_ata" id="titulo" class="inputCaixa inputTexto" maxlength="80" placeholder="Titulo da Ata:">
                    </label>
                    <label for="iCapitulo" class="inputLabel">Capítulo:
                        <input type="text" name="capitulo_ata" id="iCapitulo" class="inputCaixa inputTexto"  maxlength="50" placeholder="Seu nome:">
                    </label>
                    <label for="data" class="inputLabel">Data:
                        <input type="date" name="data_ata" id="data" value="<?php echo date("Y-m-d")?>" class="inputCaixa">
                    </label class="inputLabel">
                    <label for="ataPdf" class="inputLabel">Arquivo(.pdf):
                        <input type="file" name="arquivo_ata" id="ataPdf" class="" accept="application/pdf">
                    </label>
                    <button type="submit" class="entrar">Enviar</button>
                </form>    
            </div>   
            <!-- FORMULÁRIO DE CADASTRO DE PRESTAÇÕES DE CONTAS -->
            <div class="restrito formAreaRestrita sumir" id="prest">    
                <form action="../php/cadastraPrestacaoConta.php" method="POST" enctype="multipart/form-data">
                    <button type="button" class="fechando" onclick="showDiv('prest')"><i class="material-icons">close</i></button>
                    <h5 class="tituloDesc">Enviar Prestação de Contas</h5>
                    <label for="tituloPrest" class="inputLabel">Titulo:
                        <input type="text" name="titulo_pConta" id="tituloPrest" class="inputCaixa inputTexto" placeholder="Titulo da Prestação de conta:"  maxlength="70">
                    </label>
                    <label for="iCapituloPrest" class="inputLabel">Capítulo:
                        <input type="text" name="capitulo_pConta" id="iCapituloPrest" class="inputCaixa inputTexto"  maxlength="40" placeholder="Seu nome:">
                        </label>                    
                    <label for="dataPrest" class="inputLabel">Data:
                        <input type="date" name="data_pConta" id="dataPrest" class="inputCaixa" value="<?php echo date("Y-m-d")?>">
                        </label>                    
                    <label for="frequencia" class="inputLabel">Frequência:
                    <select name="frequencia_pConta" class="inputCaixa" id="frequencia">
                        <option value="m">Mensal</option>
                        <option value="a">Anual</option>
                    </select>
                    </label>
                    <label for="prestPdf" class="inputLabel">Arquivo(.pdf):
                        <input type="file" name="arquivo_pConta" id="prestPdf" accept="application/pdf">
                    </label>
                    <button type="submit" class="entrar">Enviar</button>
                </form>    
            </div>   
            <!-- FORMULÁRIO DE CADASTRO DE DECRETOS -->
            <div class="restrito formAreaRestrita sumir" id="decreto">    
                <form action="../php/cadastraDecreto.php" method="POST" enctype="multipart/form-data">
                    <button type="button" class="fechando" onclick="showDiv('decreto')"><i class="material-icons">close</i></button>
                    <h5 class="tituloDesc">Enviar Decretos</h5>
                    <label for="tituloDecreto" class="inputLabel">Titulo:
                        <input type="text" name="titulo_decreto" id="tituloDecreto" class="inputCaixa inputTexto" placeholder="Titulo do Decretos:"  maxlength="70">
                    </label>
                    <label for="iCapituloDecreto" class="inputLabel">Capítulo:
                        <input type="text" name="capitulo_decreto" id="iCapituloDecreto" class="inputCaixa inputTexto"  maxlength="40" placeholder="Seu nome:">
                        </label>                    
                    <label for="dataDecreto" class="inputLabel">Data:
                        <input type="date" name="data_decreto" id="dataDecreto" class="inputCaixa" value="<?php echo date("Y-m-d")?>">
                    </label>
                    <label for="decretoPdf" class="inputLabel">Arquivo(.pdf):
                        <input type="file" name="arquivo_decreto" id="decretoPdf" accept="application/pdf">
                    </label>
                    <button type="submit" class="entrar">Enviar</button>
                </form>    
            </div>
               <!-- ÁREA DE EXIBIÇÃO E DOWNLOAD DOS DECRETOS, ATAS E PRESTAÇÃO DE CONTAS -->
        <div class="restrito decretos">    
            <h5 class="tituloDesc">Decretos GCE</h5>

            <script src="../public/js/index-area-restrita.js"></script>
            
            <div id="conteudoAtas"></div>

            <div id="conteudoPrest"></div>

            <div id="conteudoDecreto"></div>
        </div>
        </section>
<?php
    $ds = DIRECTORY_SEPARATOR;
    require_once "..".$ds."public".$ds."view-components".$ds."footer.php";
?>