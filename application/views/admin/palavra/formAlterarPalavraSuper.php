<?php
//$id_palavra = base64_decode($_GET['palavra_alterar']);
$consultaPalavra = "SELECT * FROM palavra WHERE idPalavra = '$id_palavra'";
$consultaLingua = "SELECT * FROM lingua";
$consultaPovo = "SELECT * FROM povo";
$linha = '';

if (!$resultado = mysql_query($consultaPalavra)) {
    die(mysql_error());
} else {
    $linha = mysql_fetch_array($resultado);
    if ($linha['idPalavra'] == null) {
        echo "<h1> Acesso negado!</h1>";
        exit();
    }
}
?>
<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="./?acao=salvar_palavra_alterada_super" method="post">
        <fieldset>
            <input type="hidden" name="idPalavra" value="<?php echo $linha['idPalavra'] ?>"/>
            <legend> Palavra </legend>
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
            <div class="form-group">
                <label for="inputPalavraPortugues" class="col-sm-3 control-label"> Palavra Portugues: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="palavraPortugues" value="<?php echo $linha['palavraPortugues'] ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="palavraIndigena" class="col-sm-3 control-label"> Palavra Indigena: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="palavraIndigena" value="<?php echo $linha['palavraIndigina'] ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="tipoLingua" class="col-sm-3 control-label"> Tipo Lingua: </label>
                <div class="col-sm-9">
                    <select name="tipoLingua" class="form-control"> 
                        <option value=""> Seleciona Tipo </option>
                        <?php
                        if (!$resultadoTipo = mysql_query($consultaLingua)) {
                            die(mysql_error());
                        } else {
                            $linhaTipo = mysql_fetch_array($resultadoTipo);
                            do {
                                if ($linhaTipo['idLingua'] == $linha['idLingua']) {
                                    ?>
                                    <option selected="true" value="<?php echo $linhaTipo['idLingua'] ?>"> <?php echo $linhaTipo['nomeLingua'] ?> </option>;
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $linhaTipo['idLingua'] ?>"> <?php echo $linhaTipo['nomeLingua'] ?> </option>;
                                    <?php
                                }
                            } while ($linhaTipo = mysql_fetch_array($resultadoTipo));
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="povo" class="col-sm-3 control-label"> Povo: </label>
                <div class="col-sm-9">
                    <select class="form-control" name="povo"> 
                        <option value=""> Seleciona Povo </option>
                        <?php
                        if (!$resultadoPovo = mysql_query($consultaPovo)) {
                            die(mysql_error());
                        } else {
                            $linhaPovo = mysql_fetch_array($resultadoPovo);
                            do {
                                if ($linhaPovo['idPovo'] == $linha['idPovo']) {
                                    ?>
                                    <option selected="true" value="<?php echo $linhaPovo['idPovo'] ?>"> <?php echo $linhaPovo['nomePovo'] ?> </option>;
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $linhaPovo['idPovo'] ?>"> <?php echo $linhaPovo['nomePovo'] ?> </option>;
                                    <?php
                                }
                            } while ($linhaPovo = mysql_fetch_array($resultadoPovo));
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="observacaoPalavra" class="col-sm-3 control-label">Observação:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="observacaoPalavra"><?php echo $linha['obsPalavra'] ?></textarea>
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