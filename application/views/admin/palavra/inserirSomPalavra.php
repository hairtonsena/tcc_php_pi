<?php
$id_palavra;
?>
<table class="table table-bordered"> 
    <thead> 
        <tr>
            <th>Palavra Portugues</th>
            <th>Palavra Indigena</th>
            <th>Lingua</th>
            <th>Povo</th>
            <th>Observacão</th>  
            <th>Som</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($palavra as $pal) { 
            $id_palavra = $pal->idPalavra;
            ?>
            <tr>
                <td><?php echo $pal->palavraPortugues ?></td>
                <td><?php echo $pal->palavraIndigina ?></td>
                <td><?php echo $pal->nomeLingua ?></td>
                <td><?php echo $pal->nomePovo ?></td>
                <td><?php echo $pal->obsPalavra ?></td>

                <td>
                    <audio controls>
                        <source  src="<?php echo base_url("./sons/" . $pal->somPalavra) ?>" type="audio/mp3" >
                    </audio>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="col-lg-6">
    <form action="<?php echo base_url('palavras/salvar_som') ?>" method="POST" enctype="multipart/form-data" >
        <fieldset>
            <legend>Inserir som</legend>
            
            <input type="hidden" name="idPalavra" value="<?php echo $id_palavra ?>" />
            <input type="file" class="form-control" accept="audio/*" required="true" name="somPalavra"/>
            <br/>
            <input type="submit" class="btn btn-default" value="Inserir"/>
        </fieldset>
    </form>
</div>