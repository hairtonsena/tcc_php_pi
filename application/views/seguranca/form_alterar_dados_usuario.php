<?php
$idUsuario = $_SESSION['user_id'];

$consultaUsuario = mysql_query("SELECT * FROM usuario WHERE idUsuario =" . $idUsuario . ";");
if (!$consultaUsuario) {
    $flesh = mysql_error();
} else {
    $usuarioAlterar = mysql_fetch_array($consultaUsuario);
    ?>

    <div class="col-lg-12">
        <form class="form-horizontal" role="form" action="./?acao=salvar_dados_usuario" method="post" >
            <fieldset>
                <legend> Alterar dados </legend>
                <?php if (!empty($flesh)) { ?>
                    <div class="alert <?php
                    if ($verificarErro == 0) {
                        echo 'alert-success';
                    } else {
                        echo 'alert-danger';
                    }
                    ?>">
                             <?php echo $flesh; ?>
                    </div>
                <?php } ?>
                <div class="col-lg-12">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="nome" required="true" maxlength="50" value="<?php echo $usuarioAlterar['nomeUsuario'] ?>" class="form-control" id="inputNome" placeholder="Nome Sobrenome">
                                    <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputApelido" class="col-sm-2 control-label">Apelido:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="apelido" required="true" maxlength="50" value="<?php echo $usuarioAlterar['apelidoUsuario'] ?>" class="form-control" id="inputApelido" placeholder="nickname">
                                    <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="email" name="email" required="true" maxlength="70" value="<?php echo $usuarioAlterar['emailUsuario'] ?>" class="form-control" id="inputEmail" placeholder="nome@site.com.br">
                                    <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="inputCPF" class="col-sm-2 control-label">CPF:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="cpf" required="true" maxlength="14" value="<?php echo $usuarioAlterar['cpfUsuario'] ?>" class="form-control" id="inputCPF" placeholder="000.000.000-00">
                                    <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTelefone" class="col-sm-2 control-label">Telefone:</label>
                            <div class="col-sm-10">
                                <input type="text" name="telefone" maxlength="15" value="<?php echo $usuarioAlterar['telefoneUsuario'] ?>" class="form-control" id="inputTelefone" placeholder="(99) 9999-9999">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">Link pessoal:</label>
                            <div class="col-sm-10">
                                <input type="text" name="link" maxlength="100" value="<?php echo $usuarioAlterar['linkUsuario'] ?>" class="form-control" id="inputLink" placeholder="Rede Social/Currículo Lattes">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDescricao" class="col-sm-2 control-label"> Descrição: </label>
                            <div class="col-sm-10">
                                <textarea name="descricao" rows="3" class="form-control" id="inputTextArea" placeholder="Fale sobre você e/ou formação acadêmica" ><?php echo $usuarioAlterar['descricaoUsuario'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group has-warning" style="margin-top: 50px;">
                            <label for="inputSenhaAtual" class="col-sm-2 control-label">Senha atual:</label>
                            <div class="col-sm-10">
                                <input type="password" name="senha_atual" value="" required class="form-control" id="inputSenhaAtual" placeholder="Senha atual">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 50px;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-default" type="submit"> Salvar </button> 
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php } ?>