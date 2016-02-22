<?php

$palavra_aux = '';
foreach ($palavra as $pal){
    $palavra_aux = $pal;
}

?>
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

        <tr>
            <td><?php echo $palavra_aux->palavraPortugues ?></td>
            <td><?php echo $palavra_aux->palavraIndigina ?></td>
            <td><?php echo $palavra_aux->nomeLingua ?></td>
            <td><?php echo $palavra_aux->nomePovo ?></td>
            <td><?php echo $palavra_aux->obsPalavra ?></td>
            <td>
                <?php if (file("./imagem/" . $palavra_aux->imagemPalavra) == true) { ?>
                    <img src="<?php echo base_url("./imagem/" . $palavra_aux->imagemPalavra) ?>" width="100" height="100" />
                <?php } else {
                    ?>
                    <img src="./imagem/sem_imagem.jpg" width="100" height="100" />
                <?php }
                ?>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-lg-6">
    <form action="?acao=salvar_imagem_palavra" method="POST" enctype="multipart/form-data" >
        <fieldset>
            <legend> Inserir imagem </legend>
            
            <input type="hidden" name="idPalavra" value="<?php echo $palavra_aux->idPalavra ?>"/>
            <input type="file" required="true" accept="image/*" class="form-control" name="imagemPalavra"/>
            <br/>
            <input type="submit" class="btn btn-default" value="Inserir"/>
        </fieldset>
    </form>
</div>