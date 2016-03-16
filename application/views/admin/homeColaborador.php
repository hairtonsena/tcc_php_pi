<div class="container">
    <div class="col-lg-12" style="margin: 0px; padding: 0px;">
        <div class="col-lg-4">
            <form action="./" method="GET" >

                <div class="input-group">
                    <input type="text" name="p" required="true" class="form-control" value="" />
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit" title="Pesquisar" ><i style="font-size: 20px" class="glyphicon glyphicon-search" ></i></button>
                    </span>
                </div>

            </form>
        </div>
        <div class="col-lg-8 text-right">

            <a class="btn btn-default" href="./" ><span class="text-success"> Ver Todos </span></a>

            <?php
            $linkRelatorio = '';
            if ((empty($opcaoLingua)) && (empty($opcaoPovo))) {
                $linkRelatorio = base_url('palavras/gerar_relatorio');
            } else {
                $linkRelatorio = base_url('palavras/gerar_relatorio?lingua=' . $opcaoLingua . '&povo=' . $opcaoPovo);
            }
            ?>

            <a class="btn btn-default" target="_blank" href="<?php echo $linkRelatorio ?>" ><span class="text-success"> Gerar Relatorio </span></a> 


            <div class="col-lg-3" style="padding: 0px; margin: 0px">


                <select name="" class="form-control" id="lingua" onchange="fuc_filtros()" style="color: #006400" >
                    <option value="0">Lingua</option>
                    <?php
                    foreach ($linguas as $lin) {
                        if ($opcaoLingua == $lin->idLingua) {
                            ?>
                            <option selected="true" value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>

                        <?php } else {
                            ?>
                            <option value="<?php echo $lin->idLingua ?>"><?php echo $lin->nomeLingua ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-3 " style="padding: 0px; margin: 0px">
                <select name="" id="povo" onchange="fuc_filtros()" class="form-control" style="color: #006400" >
                    <option value="0">Povo</option>
                    <?php
                    foreach ($povos as $pov) {
                        if ($opcaoPovo == $pov->idPovo) {
                            ?>
                            <option selected="true" value="<?php echo $pov->idPovo ?>"><?php echo $pov->nomePovo ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $pov->idPovo ?>"><?php echo $pov->nomePovo ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div> 
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
                                    <a href="<?php echo base_url("palavras/inserir_imagem/" . $res_pal->idPalavra) ?> "><i class="glyphicon glyphicon-edit"></i></a><br/>
                                <?php } ?>
                                <img src="<?php echo base_url("imagem/" . $res_pal->imagemPalavra) ?>" width="100" height="100" />

                            </td>
                            <td><?php echo $res_pal->palavraPortugues ?></td>
                            <td><?php echo $res_pal->palavraIndigina ?></td>
                            <td>
                                <?php if ($tipoUsuarioSistema == 0) { ?>
                                <a href="<?php echo base_url('palavras/inserir_som/' . $res_pal->idPalavra) ?>"><i class="glyphicon glyphicon-edit"></i></a> <br/>
                                <?php } ?>


                                <audio controls class="audio_palavra" style="display: none" id="audio_<?php echo $res_pal->idPalavra ?>">
                                    <source  src="<?php echo base_url("sons/" . $res_pal->somPalavra) ?>" type="audio/mp3" >
                                </audio>
                                <div class="btn-group">
                                    <button class="btn btn-default" onclick="document.getElementById('audio_<?php echo $res_pal->idPalavra ?>').play()"><i class="glyphicon glyphicon-play"></i></button>

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
                                <a href="javascript:void(0)" onclick="fuc_sobreAutor('<?php echo $res_pal->idPalavra ?>')"><i class="glyphicon glyphicon-user"></i></a>
                            </td>
                            <?php if ($tipoUsuarioSistema == 0) { ?>
                            <td><a href="<?php echo base_url("palavras/inserir_imagem/" . $res_pal->idPalavra) ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
                                <td><a href="<?php echo base_url('palavras/excluir/' . $res_pal->idPalavra) ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col-lg-12 text-center paginacao ">
                <ul class="pagination">
                    <?php
                    $linkPaginacao = '';
                    if ((empty($opcaoLingua)) && (empty($opcaoPovo))) {
                        $linkPaginacao = base_url('?pg=');
                    } else {
                        $linkPaginacao = base_url('?lingua=' . $opcaoLingua . '&povo=' . $opcaoPovo . '&pg=');
                    }

                    for ($i = 1; $i <= $qtde_paginas; $i++) {
                        ?>
                        <li><a href="<?php echo $linkPaginacao . $i ?>"><?php echo $i ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>