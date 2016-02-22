<?php
$lingua_alterar;
foreach ($lingua as $lin) {
    $lingua_alterar = $lin;
}
?>
<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('lingua/salvar_alterada') ?>" method="post">
        <fieldset>
            <input type="hidden" name="idTipoLingua" value="<?php echo $lin->idLingua ?>"/>
            <legend> Tipo Lingua </legend>

            <div class="form-group">
                <label for="nomeLingua" class="col-sm-3"> Nome Lingua: </label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" required="true" maxlength="50" name="nomeLingua" value="<?php echo $lin->nomeLingua ?>"/>
                    <?php echo form_error('nomeLingua', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="observacaoLingua" class="col-sm-3">Observação/Descrição:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="observacaoLingua" ><?php echo $lin->obsLingua ?></textarea>
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