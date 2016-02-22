<div class="col-lg-6">
    <form class="form-horizontal" role="form" action="<?php echo base_url('passe/enviar_solicitacao'); ?>" method="post" >
        <fieldset>
            <legend> Quero ser Colaborador </legend>

            <div class="form-group">
                <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                <div class="col-sm-10">
                    <span class="text-success"><?php echo $mensagem ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputNome" class="col-sm-2 control-label">Nome:</label>
                <div class="col-sm-10">
                    <div class=" input-group">
                        <input type="text" name="nome" required="true" maxlength="50" value="<?php echo set_value('nome'); ?>" class="form-control" id="inputNome" placeholder="Nome Sobrenome">
                        <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                    </div>
                    <?php echo form_error('nome', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputApelido" class="col-sm-2 control-label">Apelido:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" name="apelido" required="true" maxlength="50" value="<?php echo set_value('apelido') ?>" class="form-control" id="inputApelido" placeholder="nickname">
                        <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                    </div>
                    <?php echo form_error('apelido', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="email" name="email" required="true" maxlength="70" value="<?php echo set_value('email') ?>" class="form-control" id="inputEmail" placeholder="nome@site.com.br">
                        <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                    </div>
                    <?php echo form_error('email', '<span class="text-danger">', '</span>') ?>
                </div> 
            </div>

            <div class="form-group">
                <label for="inputCPF" class="col-sm-2 control-label">CPF:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" name="cpf" required="true" maxlength="14" value="<?php echo set_value('cpf') ?>" class="form-control" id="inputCPF" placeholder="000.000.000-00">
                        <span title="Campo obrigatorio!" class="input-group-addon">*</span>
                    </div>
                    <?php echo form_error('cpf', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputTelefone" class="col-sm-2 control-label">Telefone:</label>
                <div class="col-sm-10">
                    <input type="text" name="telefone" maxlength="15" value="<?php echo set_value('telefone') ?>" class="form-control" id="inputTelefone" placeholder="(99) 9999-9999">
                    <?php echo form_error('telefone', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLink" class="col-sm-2 control-label">Link pessoal:</label>
                <div class="col-sm-10">
                    <input type="text" name="link" maxlength="100" value="<?php echo set_value('link') ?>" class="form-control" id="inputLink" placeholder="Rede Social/Currículo Lattes">
                    <?php echo form_error('link', '<span class="text-danger">', '</span>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescricao" class="col-sm-2 control-label"> Descrição: </label>
                <div class="col-sm-10">
                    <textarea name="descricao" rows="3" class="form-control" id="inputTextArea" placeholder="Fale sobre você e/ou formação acadêmica" ><?php echo set_value('descricao') ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default" type="submit"> Solicitar </button> 
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div class="col-lg-6">
    <div class="col-lg-10">
        <div class="panel panel-default" style="margin-top: 55px;">
            <div class="panel-body">
                <p class="text-justify" >
                    Obs: Colaboradores alimentam o sistema cadastrando as palavras indígenas.<br/>
                    A participação no sistema como Colaborador é recomendada e permitida apenas para as pessoas
                    diretamene ligadas ao resgate e preservação do vocabulário indígena. 
                </p>
            </div>
        </div>
        <p class="text-danger">
            (*) Campo obrigatório.
        </p>
    </div>
</div>