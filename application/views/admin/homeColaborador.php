<div class="container">
    <div class="col-lg-12" style="margin: 0px; padding: 0px;">
        <div class="col-lg-6">
            <form action="./" method="GET" >
                Pesquisar por:
                <label><input type="radio" name="opcaoPesquisa" required="true" value="portugues" id="abc" />Portugues</label>
                <label><input type="radio" name="opcaoPesquisa" required="true" value="indigena" id="abc" />Indigena</label>
                <label><input type="radio" name="opcaoPesquisa" required="true" value="tipo" id="abc"/>Lingua</label>
                <label><input type="radio" name="opcaoPesquisa" required="true" value="povo" id="abc"/>Povo</label>
                <div class="input-group">
                    <input type="text" name="pesquisarPalavra" required="true" class="form-control" value="" />
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="Pesquisar"/>
                    </span>
                </div>

            </form>
        </div>
        <div class="col-lg-6 text-right">
            <br/>        
            <a class="btn btn-default" href="<?php echo base_url() ?>" >Ver Todos </a>
            <a class="btn btn-default" href="apresentacao/admin/relatorio.php" > Gerar Relatorio </a> 
        </div>
        <?php if (count($registro_pralavras) == 0) { ?>
            <div style="width: 100%; clear: both"> Registro não encontrado!</div>
        <?php } else {
            ?>
            <table class="table table-bordered"> 
                <thead> 
                    <tr> 
                        <th>Imagem</th>

                        <th>Palavra Portugues</th>
                        <th>Palavra Indigena</th>
                        <th>Som</th>
                        <th>Obs</th>  
                        <th>Lingua</th>
                        <th>Povo</th>
                        <th>Autor</th>
                        <?php if ($tipoUsuarioSistema == 0) { ?>
                            <th>alterar</th>
                            <th>excluir</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registro_pralavras as $res_pal) { ?>
                        <tr>

                            <td>
                                <?php if ($tipoUsuarioSistema == 0) { ?>
                                    <a href="<?php echo base_url("palavras/inserir_imagem/" . $res_pal->idPalavra) ?> ">Alterar Imagem</a><br/>
                                <?php } ?>
                                <img src="<?php echo base_url("imagem/" . $res_pal->imagemPalavra) ?>" width="100" height="100" />

                            </td>
                            <td><?php echo $res_pal->palavraPortugues ?></td>
                            <td><?php echo $res_pal->palavraIndigina ?></td>
                            <td>
                                <?php if ($tipoUsuarioSistema == 0) { ?>
                                    <a href="<?php echo base_url('palavras/inserir_som/' . $res_pal->idPalavra) ?>">Alterar Som</a> <br/>
                                <?php } ?>


                                <audio controls class="audio_palavra" id="audio_<?php echo $res_pal->idPalavra ?>">
                                    <source  src="<?php echo base_url("sons/" . $res_pal->somPalavra) ?>" type="audio/mp3" >
                                </audio>
                                <div class="btn-group">
                                    <button class="btn btn-default" onclick="document.getElementById('audio_<?php echo $res_pal->idPalavra ?>').play()"><i class="glyphicon glyphicon-play"></i></button>
                                    <button class="btn btn-default" onclick="document.getElementById('audio_<?php echo $res_pal->idPalavra ?>').volume += 0.1"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button class="btn btn-default" onclick="document.getElementById('audio_<?php echo $res_pal->idPalavra ?>').volume -= 0.1"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                            </td>
                            <td>
                                <?php if ($res_pal->obsPalavra != 1) { ?>
                                    <button type="button" class="btn btn-default"   onclick="exibirObservacao('<?php echo $res_pal->obsPalavra ?>')" ><i class="glyphicon glyphicon-plus" ></i></button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-default" disabled="true"  ><i class="glyphicon glyphicon-plus" ></i></button>
                                <?php } ?>
                            </td>
                            <td><?php echo $res_pal->nomeLingua ?></td>
                            <td><?php echo $res_pal->nomePovo ?></td>



                            <td> 
                                <a href="javascript:void(0)" onclick="fuc_sobreAutor('<?php echo $res_pal->idPalavra ?>')">autor</a>
                            </td>
                            <?php if ($tipoUsuarioSistema == 0) { ?>
                                <td><a href="<?php echo base_url('palavras/alterar/' . $res_pal->idPalavra) ?>">Alterar</a></td>
                                <td><a href="<?php echo base_url('palavras/excluir/' . $res_pal->idPalavra) ?>">Excluir</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col-lg-12 text-center paginacao ">
                <ul class="pagination">
                    <?php for ($i = 0; $i < $qtde_paginas; $i++) { ?>
                        <li><a href="./?pg=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>