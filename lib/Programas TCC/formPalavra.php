<?php
$consultaLingua = "SELECT * FROM lingua";
$consultaPovo = "SELECT * FROM povo";

$resultadoPovo = mysql_query($consultaPovo);
$resultadoTipo = mysql_query($consultaLingua);
?>
<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="./?acao=cadastrar_palavra" method="post" >
        <fieldset>
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
                    <input type="text" name="palavraPortugues" required="true" maxlength="50" value="<?php echo $inputValue['palavraPortugues'] ?>" class="form-control" id="inputPalavraPortugues"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPalavraIndigena" class="col-sm-3 control-label"> Palavra Indigena:</label>
                <div class="col-sm-9">
                    <input type="text" name="palavraIndigena" required="true" maxlength="50" value="<?php echo $inputValue['palavraIndigena'] ?>" class="form-control" id="inputPalavraIndigena" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="selectPovo" class="col-sm-3 control-label"> Povo: </label>
                <div class="col-sm-9">
                    <select class="form-control" id="selectPovo" name="povo"> 
                        <option  value=""> Selecione Povo </option>
                        <?php
                        $linha = mysql_fetch_array($resultadoPovo);
                        do {
                            if ($inputValue['povo'] == $linha['idPovo']) {
                                ?>
                                <option selected="true" value="<?php echo $linha['idPovo'] ?>"> <?php echo $linha['nomePovo'] ?> </option>
                            <?php } else { ?>
                                <option value="<?php echo $linha['idPovo'] ?>"> <?php echo $linha['nomePovo'] ?></option>
                                <?php
                            }
                        } while ($linha = mysql_fetch_array($resultadoPovo));
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
                        $linha = mysql_fetch_array($resultadoTipo);
                        do {
                            if ($inputValue['tipoLingua'] == $linha['idLingua']) {
                                ?>
                                <option selected="true" value="<?php echo $linha['idLingua'] ?>"><?php echo $linha['nomeLingua'] ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $linha['idLingua'] ?>"><?php echo $linha['nomeLingua'] ?></option>
                                <?php
                            }
                        } while ($linha = mysql_fetch_array($resultadoTipo));
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputObservacaoPalavra" class="col-sm-3 control-label" >Observação:</label><br/>
                <div class="col-sm-9">
                    <textarea name="observacaoPalavra" id="inputObservacaoPalavra" class="form-control" rows="5"></textarea>
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