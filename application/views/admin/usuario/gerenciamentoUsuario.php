<h2>Gerenciamento de usuário</h2>
<?php
if (count($usuarios) == 0) {
    ?> <h4> Nenhum usuário cadastrado! </h4> <?php
} else {
    ?>
    <table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <th>Apelido</th>
            <th>Email</th>
            <th>Autor</th>
            <th>Status</th>
            <th>Tipo</th>
        </tr>
        <?php
        foreach ($usuarios as $usu) {
            ?>
            <tr>     
                <td><?php echo $usu->nomeUsuario ?></td>
                <td><?php echo $usu->apelidoUsuario ?></td>
                <td><?php echo $usu->emailUsuario ?></td>
                <td> 
                    <a href="javascript:void(0)" onclick="informacoesUsuario('<?php echo $usu->idUsuario ?>')">autor</a>
                </td>
                <td> <?php if ($usu->statusUsuario == 0) { ?>
                        Aguardando 
                        <small><a href="<?php echo base_url('usuario/habilitar_colaborador/' . $usu->idUsuario) ?>">Habilitar</a></small>
                        <small><a href="<?php echo base_url('usuario/reprovar_colaborador/' . $usu->idUsuario) ?>">Reprovar</a></small>
                        <?php
                    } else if ($usu->statusUsuario == 1) {
                        ?> Habilitado
                        <small><a href="<?php echo base_url('usuario/reprovar_colaborador/' . $usu->idUsuario) ?>">Reprovar</a></small>
                        <?php
                    } else {
                        ?> Reprovado 
                        <small><a href="<?php echo base_url('usuario/habilitar_colaborador/' . $usu->idUsuario) ?>">Habilitar</a></small>
                        <?php
                    }
                    ?> </td>
                <td><?php echo $usu->DescricaoTipoUsuario ?>
                    <?php if ($usu->idTipoUsuario == 2) { ?>
                    <small><a href="<?php echo base_url('usuario/habilitar_moderador/'.$usu->idUsuario) ?>">Tornar moderador</a></small>
                    <?php } else if ($usu->idTipoUsuario == 1) { ?>
                    <small><a href="<?php echo base_url('usuario/desabilitar_moderador/'.$usu->idUsuario) ?>">Remover Privilegios</a></small>
                    <?php } ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>