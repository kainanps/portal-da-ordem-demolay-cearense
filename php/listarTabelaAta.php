<?php

session_start();

if(!isset($_POST['pagina']) || !isset($_SESSION['tipo_usuario'])){
    $ds = DIRECTORY_SEPARATOR;
    header("location: ..".$ds."public".$ds."view-components".$ds."page404.php"); 
}

function excluirAta($id){
    if($_SESSION["tipo_usuario"] == 2){
        $excluir = "<td class='tcol download'><a onclick='excluir_ata($id)'><button class='verMais red'>Excluir</button></a></td>";
    }else{
        $excluir = "";
    }
    
    return $excluir;
}

require "persistence.php";
$stmt = new Persistence();

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);

//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_ata = "SELECT * FROM atas ORDER BY id_ata DESC LIMIT ?, ?";

$atas = $stmt->selectNoticias($result_ata, $inicio, $qnt_result_pg);
if(!empty($atas)){
?>

<label class="tTitle">Atas Enviadas:</label>
<table class="table table-responsive">
    <thead>
        <tr>
            <th title="Título da Ata">
                Título
            </th>
            <th title="Capítulo">
                Capítulo
            </th>
            <th title="Data">
                Data
            </th>
            <th title='Donwload'>
                Baixar
            </th>
            <?php
                if($_SESSION["tipo_usuario"] == 2){
            ?>
            <th title="Remover Ata">
                Excluir
            </th>
            <?php
                }
            ?>
        </tr> 
    </thead>
    <tbody>    
    <?php   
       

            $sep = DIRECTORY_SEPARATOR;
            $dirAta = "..$sep"."php$sep".md5("atas").$sep;
                            
            foreach($atas as $key => $value){
                $download =  $dirAta.$value['titulo_arquivo_ata'];
                echo"<tr>";
                echo"<td>$value[titulo_ata]</td>";
                echo"<td>$value[capitulo_ata]</td>";
                echo"<td>".date("d/m/Y", strtotime($value['data_ata']))."</td>";
                echo"<td class='download'><a href=$download download><i class='material-icons'>arrow_downward</i></a></td>";
                echo excluirAta($value['id_ata']);
                echo"</tr>";
            }
        ?>

        </tbody>
        </table>

        <?php
        
            //Paginação - Somar a quantidade de atas
            $query = "SELECT COUNT(id_ata) AS num_result FROM atas";
            $totAta = $stmt->runExec($query);
            
            //Quantidade de pagina
            $totalAta = ceil($totAta["num_result"] / $qnt_result_pg);
            
            //Limitar os link antes depois
            $max_links = 2;

            echo"<div class='paginacao'>";
            echo "<a href='#conteudoAta' onclick='listar_ata(1, $qnt_result_pg)' class='firstLast'>First</a>";
            
            for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                if($pag_ant >= 1){
                    echo " <a href='#conteudoAta' onclick='listar_ata($pag_ant, $qnt_result_pg)' class='page'>$pag_ant</a> ";
                }
            }
            
            echo " <span class='pageSelected'>$pagina</span>";
            
            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if($pag_dep <= $totalAta){
                    echo " <a href='#conteudoAta' onclick='listar_ata($pag_dep, $qnt_result_pg)' class='page'>$pag_dep</a> ";
                }
            }

            echo " <a href='#conteudoAta' onclick='listar_ata($totalAta, $qnt_result_pg)' class='firstLast'>Last</a>";
            echo"</div>";
        }else{
            echo"<div class='empty'>Nenhuma Ata enviada!</div>";
        }
    ?>