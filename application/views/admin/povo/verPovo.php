<?php if (!empty($this->session->flashdata("erro_excluir"))) { ?>
    <div class="alert alert-danger" role="alert"> <?php echo $this->session->flashdata("erro_excluir") ?> </div>
<?php } ?>
<div class="row" style="margin: 0px; padding: 0px;">
    <div class="col-lg-6">
        <form action = "<?php echo base_url("povo") ?>" method="GET" >
            <div class="input-group">
                <?php 
                $texto_pesquisa = "";
                if($this->input->get("p",TRUE)){
                    $texto_pesquisa = $this->input->get("p");
                }
                ?>
                
                <input type="text" name="p" required="true" class="form-control"  value="<?php echo $texto_pesquisa ?>" />
                <span class="input-group-btn">
                    <input class="btn btn-default" type = "submit" value = "Pesquisar"/>
                </span>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <a class="btn btn-primary pull-left" href="<?php echo base_url('povo/novo') ?>">Cadastrar Povo</a>
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