<?php
$povo_alterar;
foreach ($povo as $pov) {
    $povo_alterar = $pov;
}
?>

<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('povo/salvar_alterado') ?>" method="post">
        <fieldset>
            <input type="hidden" name="idPovo" value="<?php echo $povo_alterar->idPovo ?>"/>
            <legend> Povo </legend>

            <div class="form-group">
                <label for="nomePovo" class="col-sm-3"> Nome Povo: </label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" required="true" maxlength="50" name="nomePovo" value="<?php echo $povo_alterar->nomePovo ?>"/>
                    <?php echo form_error('nomePovo', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="observacaoPovo" class="col-sm-3">Observação/Descrição:</label><br/>
                <div class="col-sm-9">
                    <textarea name="observacaoPovo" class="form-control"><?php echo $povo_alterar->obsPovo ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <input class="btn btn-default" type="submit" value="Alterar"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>