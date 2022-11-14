<?php

    session_start();

    if(!isset($_POST['pagina']) || $_SESSION['tipo_usuario'] != 2){
        $ds = DIRECTORY_SEPARATOR;
        header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
        exit;
    }
?>

<table class="table table-responsive">
    <div class="title-div"><label class="tituloDesc">Gerenciamento de Usuários:</label></div>
    <thead>
    <tr>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Senha</th>
        <th title="Tipo de usuário">Tipo</th>
        <th>Excluir</th>      
    </tr>
    </thead>
    <tbody>
    <?php   
        require "persistence.php";
        $stmt = new Persistence();

        $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
        $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
        
        //calcular o inicio visualização
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
        
        $result_usuario = "SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT ?, ?";
        
        $usuarios = $stmt->selectNoticias($result_usuario, $inicio, $qnt_result_pg);

        
    foreach($usuarios as $key => $value){
        echo "<tr>";
        echo "<td>".mb_substr($value['nome_usuario'],0,15,'utf8')."</td>";
        echo "<td>".mb_substr($value['identificador_usuario'],0,30,'utf8')."</td>";
        echo "<td>".mb_substr($value['senha_usuario'],0,30,'utf8')."...</td>";
        echo "<td>$value[tipo_usuario]</td>";
        echo "<td><button onclick='excluir_usuario($value[id_usuario], $pagina)' type='submit' class='verMais red'>Excluir</button></td>";
        echo "</tr>";
    }

    ?>

    </tbody>
</table>

    <?php
    
        //Paginação - Somar a quantidade de usuarios
        $query = "SELECT COUNT(id_usuario) AS num_result FROM usuarios";
        $totUsuario = $stmt->runExec($query);
        
        //Quantidade de pagina
        $totalUsuario = ceil($totUsuario["num_result"] / $qnt_result_pg);
        
        //Limitar os link antes depois
        $max_links = 2;

        echo"<div class='paginacao'>";
        echo "<a href='#conteudoPage' onclick='listar_usuario(1, $qnt_result_pg)' class='firstLast'>First Users</a>";
        
        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#conteudoPage' onclick='listar_usuario($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
            }
        }
        
        echo " <span class='pageSelected'>$pagina</span>";
        
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $totalUsuario){
                echo " <a href='#conteudoPage' onclick='listar_usuario($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
            }
        }

        echo " <a href='#conteudoPage' onclick='listar_usuario($totalUsuario, $qnt_result_pg)' class='firstLast'>Last Users</a>";
        echo"</div>";

    ?>