<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url("passe/logar") ?>" method="post" >
        <fieldset>
            <legend> Logar Sistema </legend>


            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group">
                <label for="inputApelido" class="col-sm-2 control-label">Apelido:</label>
                <div class="col-sm-10">
                    <input type="text" name="apelido" required="true" value="" class="form-control" id="inputApelido" placeholder="Nickname">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSenha" class="col-sm-2 control-label">Senha:</label>
                <div class="col-sm-10">
                    <input type="password" name="senha" required="true" value="" class="form-control" id="inputSenha" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p>
                        <a href="./?acao=gerar_nova_senha" >Esqueci minha senha</a>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Entrar</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>