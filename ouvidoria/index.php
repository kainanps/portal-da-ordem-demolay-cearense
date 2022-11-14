<?php
    
    $ds = DIRECTORY_SEPARATOR;
    require "..".$ds."public".$ds."view-components".$ds."header.php";

    if(isset($_GET['sucess'])){
        if($_GET['sucess']=='true')
            echo "<span class='incorreto' style='background: green; color:black;'>Enviado com sucesso!</span>";
        else
            echo "<span class='incorreto' style='background: red; color:black;'>Preencha os campos corretamente!</span>";
            
    }
?>
        <script src="../public/js/ouvidoria.js"></script>
        <div class="msg" id="msg"></div>
        <section class="conteudo limpa">
                <div class="page-title">
                    Ouvidoria
                </div>
            <div class="restrito formulario" id="noticia">
                    <center><label class="tituloDesc">Críticas e Sugestões</label></center>
                    <input type="text" name="nome" id="nome" class="inputForm inputTexto" placeholder="Nome:" maxlength="60" required>
                    <input type="tel" name="telefone" id="telefone" class="inputForm inputTexto" placeholder="Telefone:" maxlength="16" required>
                    <input type="text" name="cidade" id="cidade" class="inputForm inputTexto" placeholder="Cidade:" maxlength="40" required>
                    <textarea name="comentario"  id="comentario" class="inputForm arquivoConteudo" placeholder="Comentário:" maxlength="1000" required></textarea>
                    <div class="buttonEnviar"><input type="submit" value="Enviar" class="entrar" id="enviar"></div>
            </div>
        </section>
<?php

require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>