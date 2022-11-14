<?php

    require_once "header.php";

?>
            <div class="restrito formulario">         
            <form action="../php/cadastraUsuarios.php" class="formUsuario" method="post">
                    <div class="title-div"><label class="tituloDesc">Cadastrar Usuário:</label></div>
                    <input type="text" name="nome_usuario" class="inputForm inputUsuario" placeholder="Nome Completo:">
                    <input type="text" name="identificador_usuario" class="inputForm inputUsuario" placeholder="Usuário:">
                    <input type="password" name="senha_usuario" placeholder="Senha:" class="inputForm inputUsuario">
                    <label for="nivelUsuario" class="inputLabel">Tipo Usuário:
                        <select name="tipo_usuario" class="inputCaixa" id="nivelUsuario">Tipo Usuário:
                            <option value=1>Nivel 1</option>
                            <option value=2>Nivel 2(Admin)</option>
                        </select>
                    </label>
                    <div class="buttonEnviar"><input type="submit" value="Enviar" class="entrar"></div>
                </form>    
            </div>
        </section>
<?php
    $ds = DIRECTORY_SEPARATOR;
    require_once "..".$ds."public".$ds."view-components".$ds."footer.php";

?>