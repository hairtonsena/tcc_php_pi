<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="./?acao=salvar_nova_senha" method="post" >
        <fieldset>
            <legend> Logar Sistema </legend>
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
            <div class="form-group">
                <label for="inputSenhaAtual" class="col-sm-2 control-label">Senha atual:</label>
                <div class="col-sm-10">
                    <input type="password" name="senha_atual" value="" class="form-control" id="inputSenhaAtual" placeholder="Senha atual">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNovaSenha" class="col-sm-2 control-label">Nova senha:</label>
                <div class="col-sm-10">
                    <input type="password" name="nova_senha" value="" class="form-control" id="inputNovaSenha" placeholder="Nova senha">
                </div>
            </div>
            <div class="form-group">
                <label for="inputConfirmarSenha" class="col-sm-2 control-label">Confirmar senha:</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmar_senha" value="" class="form-control" id="inputConfirmarSenha" placeholder="Confirmar Senha">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Alterar</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>