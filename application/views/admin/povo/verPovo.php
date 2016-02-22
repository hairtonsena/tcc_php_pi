<div class="row" style="margin: 0px; padding: 0px;">
    <div class="col-lg-6">
        <form action = "./?acao=povo" method = "GET" >
            <input type = "hidden" name = "acao" value = "povo" />
            <div class="input-group">
                <input type = "text" name = "pesquisarPalavra" required="true" class="form-control"  value = "" />
                <span class="input-group-btn">
                    <input class="btn btn-default" type = "submit" value = "Pesquisar"/>
                </span>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <a class="btn btn-default pull-left" href="<?php echo base_url('povo/novo') ?>">Cadastrar Povo</a>
        <a class="btn btn-default pull-right" href = "<?php echo base_url('povo/') ?>" >Ver Todos </a>
    </div>
</div>
<?php
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Povo</th>                  
            <th>Observação/Descrição</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($povos as $pov) {
            ?>
            <tr>
                <td><?php echo $pov->nomePovo ?></td>
                <td><?php echo $pov->obsPovo ?></td>
                <td><a href='<?php echo base_url('povo/alterar/'.$pov->idPovo) ?>'>Alterar</a></td>
                <td><a href='<?php echo base_url('povo/excluir/'.$pov->idPovo) ?>'>Excluir</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php ?>
</div>