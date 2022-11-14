<?php

    require_once "header.php";

?>
            <div class="restrito formulario" id="evento">
                <form action="../php/cadastraEventos.php" method="post" enctype="multipart/form-data">
                    <div class="title-div"><label class="tituloDesc">Enviar Evento</label></div>
                    <input type="text" name="titulo_evento" class="inputForm inputTexto" placeholder="Titulo:">
                    <textarea name="conteudo_evento" class="inputForm arquivoConteudo" placeholder="Conteudo:"></textarea>
                    <label class="inputLabel" for="imagemId">Imagem:
                        <input type="file" name="imagem_evento" id="imagemId" accept="image/*">
                    </label>
                    <label for="dataEvento" class="inputLabel">Data:
                        <input type="date" name="data_evento" id="dataEvento" value="<?php echo date("Y-m-d"); ?>">
                    </label>
                    <input type="text" name="imagem_descricao" class="inputForm inputTexto" placeholder="Titulo/Descrição da Imagem:">
                    <input type="text" name="autor_evento" class="inputForm inputTexto" placeholder="Autor:">
                    <div class="buttonEnviar"><input type="submit" value="Enviar" class="entrar"></div>
                </form>
            </div>
        </section>
<?php
    $ds = DIRECTORY_SEPARATOR;
    require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>