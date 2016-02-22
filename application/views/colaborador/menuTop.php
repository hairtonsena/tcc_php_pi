<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Palavras Indigenas</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="active"><a href="<?php echo base_url() ?>"> Início </a></li>
                <!--<li><a href="./?acao=nova_palavra"> Cadastro Palavras </a></li>-->
                <li><a href="<?php echo base_url("palavras/minhas") ?>"> Minhas palavras </a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ajuda <span class="caret"></span> </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url('sobre') ?>">Sobre o sistema</a></li>
                        <li><a href="<?php echo base_url('sobre/artigo') ?>">Artigo</a></li>
                        <li><a href="<?php echo base_url('sobre/manual') ?>">Manual do usuário</a></li>
                        <li><a href="<?php echo base_url('sobre/gravar_pronuncia') ?>">Gravar pronuncia</a></li>
                        <li><a href="<?php echo base_url('sobre/gravar_imagem') ?>">Gravar imagem</a></li>
                        <li><a href="<?php echo base_url('sobre/fale_conosco') ?>">Fale conosco</a></li>
                        <li><a href="<?php echo base_url('sobre/extra') ?>">Extra</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-edit"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./?acao=alterar_senha">Alterar senha</a></li>
                        <li><a href="./?acao=alterar_dados">Alterar dados</a></li>
                    </ul>
                </li>

                <li><p class="navbar-text"><?php echo $this->session->userdata('nome_usuario') ?> </p></li> 
                <li><a class="" href="<?php echo base_url("passe/logout") ?>"><i class="glyphicon glyphicon-log-out"></i>Sair</a></li>

            </ul>
        </div><!--/.navbar-collapse -->
    </div><!--/.container-fluid -->
</nav>
