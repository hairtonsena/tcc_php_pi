<?php
$consultaPalavra = mysql_query("SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE idPalavra = '$id_palavra'");
if (!$consultaPalavra) {
    die(mysql_error());
} else {
    $linha = mysql_fetch_array($consultaPalavra);
    if ($linha['idPalavra'] == null) {
        echo "<h1> Acesso negado!</h1>";
        exit();
    }
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
            <th>Som</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><?php echo $linha['palavraPortugues'] ?></td>
            <td><?php echo $linha['palavraIndigina'] ?></td>
            <td><?php echo $linha['nomeLingua'] ?></td>
            <td><?php echo $linha['nomePovo'] ?></td>
            <td><?php echo $linha['obsPalavra'] ?></td>

            <td>
                <audio controls>
                    <source  src="<?php echo "./sons/" . $linha['somPalavra'] ?>" type="audio/mp3" >
                </audio>
            </td>
        </tr>
    </tbody>
</table>
<div class="col-lg-6">
    <form action="./?acao=salvar_som_palavra" method="POST" enctype="multipart/form-data" >
        <fieldset>
            <legend>Inserir som</legend>
            <?php if (!empty($flesh)) { ?>
                <div class="alert <?php
                if ($verificarErro == 0) {
                    echo 'alert-success';
                } else {
                    echo 'alert-danger';
                }
                ?>">
                         <?php echo $flesh; ?>
                </div>
            <?php } ?>
            <input type="hidden" name="idPalavra" value="<?php echo $id_palavra ?>"/>
            <input type="file" class="form-control" accept="audio/*" required="true" name="somPalavra"/>
            <br/>
            <input type="submit" class="btn btn-default" value="Inserir"/>
        </fieldset>
    </form>
</div>