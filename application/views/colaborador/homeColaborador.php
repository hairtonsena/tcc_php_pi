<div class="row" style="margin: 0px; padding: 0px;">
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
                    <th>Palavra Portugues</th>
                    <th>Palavra Indigena</th>
                    <th>Lingua</th>
                    <th>Povo</th>
                    <th>Observacão</th>  
                    <th>Imagem</th>
                    <th>Som</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($registro_pralavras as $res_pal) {
                    ?>
                    <tr>
                        <td><?php echo $res_pal->palavraPortugues; ?></td>
                        <td><?php echo $res_pal->palavraIndigina; ?></td>
                        <td><?php echo $res_pal->nomeLingua; ?></td>
                        <td><?php echo $res_pal->nomePovo; ?></td>
                        <td><?php echo $res_pal->obsPalavra; ?></td>
                        <td>
                            <?php
                            if (strlen($res_pal->imagemPalavra) > 2) {
                                if (file_exists("./imagem/" . $res_pal->imagemPalavra)) {
                                    ?>
                            <img src="<?php echo base_url("imagem/" . $res_pal->imagemPalavra)  ?>" width="100" height="100" />
                                <?php } else {
                                    ?>
                                    <img src="<?php echo base_url('imagem/sem_imagem.jpg') ?> " width="100" height="100" />
                                    <?php
                                }
                            } else {
                                ?>
                                    <img src="<?php echo base_url('imagem/sem_imagem.jpg') ?>" width="100" height="100" />
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <audio controls>
                                <source  src="<?php echo base_url("sons/" . $res_pal->somPalavra)  ?>" type="audio/mp3" >
                            </audio>
                        </td>
                        <td> 
                            <a href="javascript:void(0)" onclick="abrirModal('<?php echo $res_pal->idPalavra ?>')">autor</a>
                        </td>
                    </tr>
                    <?php
                };
                ?>
            </tbody>
        </table>
        <div class="col-lg-12 text-center">
            <ul class="pagination">
                <?php
                for ($i = 0; $i < $qtde_paginas; $i++) {
                    ?>

                <li><a href="<?php echo base_url('?pg='.$i) ?>"><?php echo $i ?></a></li>

                <?php }
                ?>
            </ul>
        </div>
    <?php }
    ?>
</div>
