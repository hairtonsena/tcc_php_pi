<?php
$palavra_aux;

foreach ($palavra as $pal) {
    $palavra_aux = $pal;
}
?>

<div class="col-lg-12 text-right">
    <a href="<?php echo base_url('palavras/nova_palavra') ?> " class="btn btn-primary" style="font-size: 18px;"> Nova palavra</a>
    <a href="<?php echo base_url('palavras/minhas') ?>" class="btn btn-danger" style="font-size: 18px;"> Voltar minhas palavras</a>

</div>

<table class="table table-bordered"> 
    <thead> 
        <tr>
            <th>Palavra Portugues</th>
            <th>Palavra Indigena</th>
            <th>Lingua</th>
            <th>Povo</th>
            <th>Observacão</th>  
            <th>Imagem</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id_palavra;
        foreach ($palavra as $pal) {
            $id_palavra = $pal->idPalavra;
            ?>
            <tr>
                <td><?php echo $pal->palavraPortugues ?></td>
                <td><?php echo $pal->palavraIndigina ?></td>
                <td><?php echo $pal->nomeLingua ?></td>
                <td><?php echo $pal->nomePovo ?></td>
                <td><?php echo $pal->obsPalavra ?></td>
                <td>
                    <?php if (file_exists("./imagem/" . $pal->imagemPalavra) == true) { ?>
                        <img src="<?php echo base_url("imagem/" . $pal->imagemPalavra) ?>" width="100" height="100" />
                    <?php } else {
                        ?>
                        <img src="<?php echo base_url('imagem/sem_imagem.jpg') ?>" width="100" height="100" />
                    <?php }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="col-lg-12">

    <div class="col-lg-4">

        <form class="form-horizontal" role="form" action="<?php echo base_url('palavras/salvar_palavra') ?>" method="post" >
            <fieldset>
                <legend> Palavra </legend>
                <a href="<?php echo base_url('palavras/alterar/' . $palavra_aux->idPalavra) ?>" class="btn btn-success" >Editar</a>

                <div class="form-group">
                    <label for="inputPalavraPortugues" class="control-label"> Palavra Portugues: </label>

                    <input type="text" name="palavraPortugues" disabled="true" required="true" maxlength="50" value="<?php echo $palavra_aux->palavraPortugues; ?>" class="form-control" id="inputPalavraPortugues"/>
                    <?php echo form_error('palavraPortugues', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="inputPalavraIndigena" class="control-label"> Palavra Indigena:</label>

                    <input type="text" name="palavraIndigena" disabled="true" required="true" maxlength="50" value="<?php echo $palavra_aux->palavraIndigina; ?>" class="form-control" id="inputPalavraIndigena" placeholder="">
                    <?php echo form_error('palavraIndigena', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="selectPovo" class="control-label"> Povo: </label>

                    <input type="text" class="form-control" disabled="true" value="<?php echo $pal->nomePovo ?>" />


                    <?php echo form_error('povo', '<span class="text-danger">', '</span>') ?>
                </div>
                <div class="form-group">
                    <label for="selectLingua" class="control-label"> Tipo Lingua: </label>

                    <input type="text" class="form-control" disabled="true" value="<?php echo $pal->nomeLingua ?>" />

                    <?php echo form_error('tipoLingua', '<span class="text-danger">', '</span>') ?>

                </div>
                <div class="form-group">
                    <label for="inputObservacaoPalavra" class="control-label" >Observação:</label>
                    <textarea name="observacaoPalavra" disabled="true" id="inputObservacaoPalavra" class="form-control" rows="5"><?php echo $pal->obsPalavra ?></textarea>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-lg-4">
        <!--?acao=salvar_imagem_palavra-->
        <form action="" id="form_upload_imagem" method="POST" enctype="multipart/form-data" >
            <fieldset>
                <legend> Inserir imagem </legend>

                <div id="mensagemImagem" class="panel">

                    <img src="<?php echo base_url('imagem/' . $palavra_aux->imagemPalavra) ?>" class="img-responsive" width="300" height="auto" />

                </div>


                <div class="progress" id="porgentagemImagem">
                    <div class="progress-bar progress-bar-info" id="barraImagem" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                    </div>
                </div>


                <input type="hidden" name="idPalavra" value="<?php echo $palavra_aux->idPalavra ?>"/>

                <input type="file" id="arquivo_imagem" required="true" accept="image/*" class="form-control" name="imagemPalavra"/>
                <br/>
                <input type="button" id="btn_enviar_imagem" class="btn btn-default" value="Inserir"/>
            </fieldset>
        </form>
    </div>
    <div class="col-lg-4">
        <!--./?acao=salvar_som_palavra-->
        <form action="" id="form_upload_som"  method="POST" enctype="multipart/form-data" >
            <fieldset>
                <legend>Inserir som</legend>

                <div id="mensagemSom" class="panel">

                    <?php if (isset($palavra_aux->somPalavra)) {
                        ?>

                        <audio controls="controls" style="display: none" id="audio" class="audio_palavra">
                            <source src="<?php echo base_url('sons/' . $palavra_aux->somPalavra) ?>" type="audio/mp3" /> seu navegador não suporta HTML5 
                        </audio>

                        <div class="btn-group">
                            <button class="btn btn-default" onclick="document.getElementById('audio').play()"><i class="glyphicon glyphicon-play"></i></button>
                        </div>
                        <?php
                    } else {
                        ?>

                        <button class="btn btn-default disabled"  ><i class="glyphicon glyphicon-play"></i></button>
                    <?php } ?>
                </div>

                <div class="progress" id="porgentagemSom">
                    <div class="progress-bar progress-bar-success" id="barraSom" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                    </div>
                </div>

                <input type="hidden" name="idPalavra" value="<?php echo $palavra_aux->idPalavra ?>"/>
                <input type="file" id="arquivo_som" class="form-control" accept="audio/*" required="true" name="somPalavra"/>
                <br/>
                <input type="button" id="btn_enviar_som" class="btn btn-default" value="Inserir"/>
            </fieldset>
        </form>
    </div>
</div>