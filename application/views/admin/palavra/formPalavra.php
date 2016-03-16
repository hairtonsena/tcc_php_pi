<div class="col-lg-12" style="margin-bottom: 20px">
    <a href="<?php echo base_url('palavras/minhas') ?>" class="btn btn-danger " style="font-size: 16px;"> Voltar </a>
    <a href="<?php echo base_url('palavras/minhas') ?>" class="btn btn-success " style="font-size: 16px;"> Salvar </a>
</div>
<div class="col-lg-12">

    <div class="col-lg-4">
        <form class="form-horizontal" role="form" action="<?php echo base_url('palavras/salvar_palavra') ?>" method="post" >
            <fieldset>
                <legend> Palavra </legend>
                <div class="form-group">
                    <label for="inputPalavraPortugues" class="control-label"> Palavra Portugues: </label>

                    <input type="text" name="palavraPortugues" required="true" maxlength="50" value="<?php echo set_value('palavraPortugues'); ?>" class="form-control" id="inputPalavraPortugues"/>
                    <?php echo form_error('palavraPortugues', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="inputPalavraIndigena" class="control-label"> Palavra Indigena:</label>

                    <input type="text" name="palavraIndigena" required="true" maxlength="50" value="<?php echo set_value('palavraIndigena'); ?>" class="form-control" id="inputPalavraIndigena" placeholder="">
                    <?php echo form_error('palavraIndigena', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="selectPovo" class="control-label"> Povo: </label>

                    <select class="form-control" id="selectPovo" name="povo"> 
                        <option  value=""> Selecione Povo </option>
                        <?php
                        foreach ($povos as $pov) {
                            if ($pov->idPovo == set_value('povo')) {
                                ?>
                                <option selected="true" value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?></option>
                            <?php } else {
                                ?>
                                <option value="<?php echo $pov->idPovo ?>"> <?php echo $pov->nomePovo ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('povo', '<span class="text-danger">', '</span>') ?>
                </div>
                <div class="form-group">
                    <label for="selectLingua" class="control-label"> Tipo Lingua: </label>

                    <select class="form-control" id="selectLingua" name="tipoLingua"> 
                        <option  value=""> Selecione Tipo </option>
                        <?php
                        foreach ($linguas as $lin) {
                            if ($lin->idLingua == set_value('tipoLingua')) {
                                ?>
                                <option selected="true" value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('tipoLingua', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="inputObservacaoPalavra" class="control-label" >Observação:</label><br/>

                    <textarea name="observacaoPalavra" id="inputObservacaoPalavra" class="form-control" rows="5"></textarea>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-8 col-sm-4">
                        <input class="btn btn-default" type="submit" value="Salvar"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-lg-8">
        <div class="col-lg-12">
            <h3>Categorias <small> *Opcional</small></h3>
        </div>
        <div class="col-lg-12" style="margin: 0px; padding: 0px">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><strong>Tipo:</strong></h4>
                        <div class="radio">
                            <label>
                                <input  type="radio" name="tipo_palavra" checked="true" value="Cat" />Nenhuma
                            </label>

                        </div>

                        <?php for ($i = 0; $i < count($tipo_palavra); $i++) { ?>
                            <div class="radio">
                                <label>
                                    <input  type="radio" name="tipo_palavra" value="Cat" /><?php echo $tipo_palavra[$i]->nomeTipoPalavra ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><strong>Classificação:</strong></h4>
                        <div class="radio">
                            <label>
                                <input  type="radio" name="tipo_palavra" value="Cat" />Cats
                            </label>

                        </div>
                        <div class="radio">
                            <label>
                                <input  type="radio" name="tipo_palavra" value="Cat" />Cats
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><strong>Classe gramatical:</strong></h4>
                        <div class="radio">
                            <label>
                                <input  type="radio" name="tipo_palavra" value="Cat" />Cats
                            </label>

                        </div>
                        <div class="radio">
                            <label>
                                <input  type="radio" name="tipo_palavra" value="Cat" />Cats
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>