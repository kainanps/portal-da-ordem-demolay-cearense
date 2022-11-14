<?php

    require_once "header.php";

?>
            <div class="restrito formulario" id="noticia">
                <form action="../php/cadastraNoticias.php" method="post" enctype="multipart/form-data">
                    <div class="title-div"><label class="tituloDesc">Enviar Notícia</label></div>
                    <input type="text" name="titulo_noticia" class="inputForm inputTexto" placeholder="Titulo:">
                    <textarea name="conteudo_noticia" class="inputForm arquivoConteudo" placeholder="Conteudo:"></textarea>
                    <input type="text" name="fonte_noticia" class="inputForm inputTexto" placeholder="Bibliografia, Fontes...">
                    <label class="inputLabel" for="imagemId">Imagem:
                        <input type="file" name="imagem_noticia" id="imagemId" accept="image/*">
                    </label>
                    <label for="dataNoticia" class="inputLabel">Data:
                        <input type="date" name="data_noticia" id="dataNoticia" value="<?php echo date("Y-m-d"); ?>">
                    </label>
                    <input type="text" name="imagem_descricao" class="inputForm inputTexto" placeholder="Titulo/Descrição da Imagem:">
                    <input type="text" name="autor_noticia" class="inputForm inputTexto" placeholder="Autor:">
                    <div class="buttonEnviar"><input type="submit" value="Enviar" class="entrar"></div>
                </form>
            </div>
        </section>
<?php
    $ds = DIRECTORY_SEPARATOR;
    require_once "..".$ds."public".$ds."view-components".$ds."footer.php";
?>