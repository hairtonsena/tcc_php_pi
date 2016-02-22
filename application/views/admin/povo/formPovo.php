<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('povo/salvar_novo') ?>" method="post" >
        <fieldset>
            <legend> Povo </legend>
            <div class="form-group">
                <label for="inputNomePovo" class="col-sm-3 control-label"> Nome Povo: </label>
                <div class="col-sm-9">
                    <input type="text" id="inputNomePovo" required="true" maxlength="50" class="form-control" name="nomePovo" value="<?php echo set_value('nomePovo') ?>"/>
                    <?php echo form_error('nomePovo', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputObservacao" class="col-sm-3 control-label">Observação/Descrição:</label>
                <div class="col-sm-9">
                    <textarea name="observacaoPovo" id="inputObservacao" class="form-control" rows="5"><?php echo set_value('observacaoPovo') ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <input class="btn btn-default" type="submit" value="Salvar"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>