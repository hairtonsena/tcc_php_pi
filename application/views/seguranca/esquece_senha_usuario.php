<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="./?acao=gerar" method="post" >
        <fieldset>
            <legend> Gerar uma nova senha </legend>

            <p class="text-justify">
                Para gerar uma nova senha basta informar seu apelido
                ou email cadastrado neste sistema e clicar no botão "Gerar".<br/>
                Assim uma nova senha será encaminha a seu email.
            </p>
            <br/>
            <br/>
            <?php if (!empty($flesh)) { ?>
                <div class="alert <?php if($verificarErro==0){ echo 'alert-success';}else{echo 'alert-danger';} ?>">
                    <?php echo $flesh ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="inputApelido" class="col-sm-3 control-label">Apelido ou email:</label>
                <div class="col-sm-9">
                    <input type="text" name="apelido_email" maxlength="70" required="true" value="" class="form-control" id="inputApelido" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Gerar</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>