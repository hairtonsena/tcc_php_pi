<h1>Projeto Dener</h1>
<div style="text-align: right">
    <?php if ($usuarioLogado == TRUE) { ?>
        Ola, <?php echo $_SESSION['user_nome'] ?> | <a href="controle/usuario/logout.php">Sair</a>
    <?php } else { ?>
        <a href = "<?php echo base_url("passe") ?>" > Login </a> |
        <a href = "apresentacao/seguranca/cadastra_usuario.php" > Cadastrar </a>
    <?php } ?>
</div>
<div class="menu">
    <ul>
        <li><a href="./"> Home </a></li>
    </ul>
</div>
<br/>

