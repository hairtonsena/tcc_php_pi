
<?php if (!empty($this->session->flashdata("erro_excluir"))) { ?>
    <div class="alert alert-danger" role="alert"> <?php echo $this->session->flashdata("erro_excluir") ?> </div>
<?php } ?>
<div class="row" style="margin: 0px; padding: 0px;">
    <div class="col-lg-6">
        <form action="<?php echo base_url("lingua/") ?>" method="GET" >
            <div class="input-group">
                <?php
                $texto_pesquisa = "";
                if ($this->input->get("p", TRUE)) {
                    $texto_pesquisa = $this->input->get("p");
                }
                ?>
                <input type="text" name="p" required="true" class="form-control" placeholder="Pesquisar liguas" value="<?php echo $texto_pesquisa ?>" />
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Pesquisar"/>
                </span>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <a class="btn btn-primary pull-left" href="<?php echo base_url('lingua/nova') ?>" >Cadastrar Lingua </a>
        <a class="btn btn-default pull-right" href="<?php echo base_url('lingua') ?>" >Ver Todos </a>
    </div>
</div>
<?php
if (count($linguas) == 0) {
    ?><h4> Registro não encotrado!</h4>  <?php
} else {
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lingua</th>
                <th>Observação/Descrição</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($linguas as $lin) {
                ?>
                <tr>
                    <td><?php echo $lin->nomeLingua ?></td>
                    <td><?php echo $lin->obsLingua ?></td>
                    <td><a href='<?php echo base_url('lingua/alterar/' . $lin->idLingua) ?>'>Alterar</a></td>
                    <td><a href='<?php echo base_url('lingua/excluir/' . $lin->idLingua) ?>'>Excluir</a></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
