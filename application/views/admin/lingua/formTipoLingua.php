<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('lingua/salvar_nova') ?>" method="post" >
        <fieldset>
            <legend> Tipo Lingua </legend>
            <div class="form-group">
                <label for="inputNomeLingua" class="col-sm-3 control-label"> Nome Lingua: </label>
                <div class="col-sm-9">
                    <input type="text" id="inputNomeLingua" required="true" maxlength="50" class="form-control" name="nomeLingua" value="<?php echo set_value('nomeLingua')?>"/>
                    <?php echo form_error('nomeLingua', '<span class="text-danger">', '</span>') ?>
                </div>
            </div> 
            <div class="form-group">
                <label for="inputObservacao" class="col-sm-3 control-label">Observação/Descrição:</label>
                <div class="col-sm-9">
                    <textarea name="observacaoLingua" id="inputObservacao" class="form-control" rows="5"><?php echo set_value('observacaoLingua')?></textarea>
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