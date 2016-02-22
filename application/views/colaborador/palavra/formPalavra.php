<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="./?acao=cadastrar_palavra" method="post" >
        <fieldset>
            <legend> Palavra </legend>

            <div class="form-group">
                <label for="inputPalavraPortugues" class="col-sm-3 control-label"> Palavra Portugues: </label>
                <div class="col-sm-9">
                    <input type="text" name="palavraPortugues" required="true" maxlength="50" value="<?php echo set_value('palavraPortugues'); ?>" class="form-control" id="inputPalavraPortugues"/>
                    <?php echo form_error('palavraPortugues', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPalavraIndigena" class="col-sm-3 control-label"> Palavra Indigena:</label>
                <div class="col-sm-9">
                    <input type="text" name="palavraIndigena" required="true" maxlength="50" value="<?php echo set_value('palavraIndigena') ?>" class="form-control" id="inputPalavraIndigena" placeholder="">
                    <?php echo form_error('palavraIndigena', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="selectPovo" class="col-sm-3 control-label"> Povo: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="selectPovo" name="povo"> 
                        <option  value=""> Selecione Povo </option>
                        <?php
                        foreach ($povos as $pov) {
                            if (set_value('povo') == $pov->idPovo) {
                                ?>
                                <option selected="true" value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?> </option>
                            <?php } else { ?>
                                <option value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?></option>
                                <?php
                            }
                        };
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectLingua" class="col-sm-3 control-label"> Tipo Lingua: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="selectLingua" name="tipoLingua"> 
                        <option  value=""> Selecione Tipo </option>
                        <?php
                        foreach($linguas as $lin){
                            if (set_value('tipoLingua') == $lin->idLingua) {
                                ?>
                                <option selected="true" value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>
                                <?php
                            }
                        };
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputObservacaoPalavra" class="col-sm-3 control-label" >Observação:</label><br/>
                <div class="col-sm-9">
                    <textarea name="observacaoPalavra" id="inputObservacaoPalavra" class="form-control" rows="5"><?php echo set_value('observacaoPalavra')?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input class="btn btn-default" type="submit" value="Salvar"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>