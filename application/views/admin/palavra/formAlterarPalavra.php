<?php
$palavra_alterar;
foreach ($palavra as $pal) {
    $palavra_alterar = $pal;
    break;
}
?>
<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('palavras/salvar_palavra_alterarda') ?>" method="post">
        <fieldset>
            <input type="hidden" name="idPalavra" value="<?php echo $pal->idPalavra ?>"/>
            <legend> Palavra </legend>

            <div class="form-group">
                <label for="inputPalavraPortugues" class="col-sm-3 control-label"> Palavra Portugues: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="palavraPortugues" maxlength="50" required="true" value="<?php echo $pal->palavraPortugues ?>"/>
                <?php echo form_error('palavraPortugues', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="palavraIndigena" class="col-sm-3 control-label"> Palavra Indigena: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="palavraIndigena" maxlength="50" required="true" value="<?php echo $pal->palavraIndigina ?>"/>
                <?php echo form_error('palavraIndigena', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="tipoLingua" class="col-sm-3 control-label"> Tipo Lingua: </label>
                <div class="col-sm-9">
                    <select name="tipoLingua" class="form-control"> 
                        <option value=""> Seleciona Tipo </option>
                        <?php
                        foreach ($linguas as $lin) {
                            if ($lin->idLingua == $palavra_alterar->idLingua) {
                                ?>
                                <option selected="true" value="<?php echo $lin->idLingua ?>"> <?php echo $lin->nomeLingua ?> </option>;
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $lin->idLingua ?>"> <?php echo $lin->nomeLingua ?> </option>;
                                <?php
                            }
                        }
                        ?>

                    </select>
                    <?php echo form_error('tipoLingua', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="povo" class="col-sm-3 control-label"> Povo: </label>
                <div class="col-sm-9">
                    <select class="form-control" name="povo"> 
                        <option value=""> Seleciona Povo </option>
                        <?php
                        foreach ($povos as $pov) {
                            if ($pov->idPovo == $palavra_alterar->idPovo) {
                                ?>
                                <option selected="true" value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?> </option>;
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?> </option>;
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('povo', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="observacaoPalavra" class="col-sm-3 control-label">Observação:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="observacaoPalavra"><?php echo $palavra_alterar->obsPalavra ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <a class="btn btn-default" href="<?php echo base_url("palavras/inserir_imagem/".$palavra_alterar->idPalavra) ?>">Cancelar</a> <input class="btn btn-default" type="submit" value="Alterar"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>