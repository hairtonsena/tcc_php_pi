<div class="row" style="margin: 0px; padding: 0px;">
    <div class="col-lg-6">
        <form action="./" method="GET" > 
            Pesquisar por:
            <label><input type="radio" required="true" name="opcaoPesquisa" value="portugues" id="abc" />Portugues</label>
            <label><input type="radio" required="true" name="opcaoPesquisa" value="indigena" id="abc" />Indigena</label>
            <label><input type="radio" required="true" name="opcaoPesquisa" value="tipo" id="abc"/>Lingua</label>
            <label><input type="radio" required="true" name="opcaoPesquisa" value="povo" id="abc"/>Povo</label>
            <input type="hidden" name="acao" size="50" value="minhas_palavras"/>
            <div class="input-group">
                <input type="text" class="form-control" required="true" name="pesquisarPalavra" value="" />
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Pesquisar"/>
                </span>
            </div>
        </form>
    </div>
    <div class="col-lg-6 text-right">
        <br/>
        <a class="btn btn-default pull-left" href="<?php echo base_url('palavras/nova_palavra') ?>">Cadastrar palavra</a>
        <a class="btn btn-default" href="./?acao=minhas_palavras" >Ver Todos </a> 
        <a class="btn btn-default" href="apresentacao/admin/relatorio.php" > Gerar Relatorio </a> 
    </div>
    <?php if (count($registro_pralavras) == 0) { ?>
        <div style="width: 100%; clear: both">Registro não encontrado!</div>
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
                    <th>Som Indigina</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($registro_pralavras as $res_pal) {
                    ?>
                    <tr>
                        <td><?php echo $res_pal->palavraPortugues ?></td>
                        <td><?php echo $res_pal->palavraIndigina ?></td>
                        <td><?php echo $res_pal->nomeLingua ?></td>
                        <td><?php echo $res_pal->nomePovo ?></td>
                        <td><?php echo $res_pal->obsPalavra ?></td>
                        <td>
                            <a href="<?php echo base_url('palavras/inserir_imagem/'.$res_pal->idPalavra) ?>">Alterar Imagem</a> <br/>
                            <img src="<?php echo base_url("imagem/" . $res_pal->imagemPalavra) ?>" width="100" height="100" />
                        </td>
                        <td>
                            <a href="./?acao=inserir_som_palavra&palavra=<?php echo base64_encode($res_pal->idPalavra) ?>">Alterar Som</a> <br/>
                            <audio controls>
                                <source  src="<?php echo base_url("sons/" . $res_pal->somPalavra) ?>" type="audio/mp3" >
                            </audio>
                        </td>
                        <td><a href="./?acao=alterar_palavra&palavra_alterar=<?php echo base64_encode($res_pal->idPalavra) ?>">Alterar</a></td>
                        <td><a href="./?acao=excluir_palavra&palavra_excluir=<?php echo base64_encode($res_pal->idPalavra) ?>">Excluir</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="col-lg-12 text-center">
            <ul class="pagination">
                <?php
                for ($i = 0; $i < $qtde_paginas; $i++) {
                    ?>
                    <li><a href="<?php echo base_url('palavras/minhas?pg=' . $i) ?>"><?php echo $i ?></a></li>
                <?php }
                ?>
            </ul>
        </div>
    <?php }
    ?>
</div>