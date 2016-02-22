<?php

class Login {

    function logar($apelido, $senha) {
        $flesh = "";
        $verificarError = 0;
        if (!$resulte = mysql_query("SELECT * FROM usuario WHERE apelidoUsuario='" . $apelido . "' AND senhaUsuario='" . $senha . "' AND statusUsuario>=0 ;")) {
            $flesh = "Error sql" . mysql_error();
            $verificarError = 1;
        } else {
            $linha = mysql_fetch_array($resulte);
            if (empty($linha)) {
                $flesh = "Usuário invalido!";
                $verificarError = 1;
            } else {
                if ($linha['statusUsuario'] == 0) {
                    $flesh = "Aguarde a avaliação!";
                    $verificarError = 1;
                } else {
                    $_SESSION['user_id'] = $linha['idUsuario'];
                    $_SESSION['user_nome'] = $linha['nomeUsuario'];
                    $_SESSION['user_apelido'] = $linha['apelidoUsuario'];
                    $_SESSION['user_senha'] = $linha['senhaUsuario'];
                    $_SESSION['user_email'] = $linha['emailUsuario'];
                    $_SESSION['user_tipo'] = $linha['idTipoUsuario'];
                    $verificarError = 0;
                }
            }
        }
        return array("verificarError" => $verificarError, "flesh" => $flesh);
    }

    function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_nome']);
        unset($_SESSION['user_apelido']);
        unset($_SESSION['user_senha']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_tipo']);
    }

    function enviarSolicitacaoColaborador($nomeUsuario, $apelidoUsuario, $emailUsuario, $cpfUsuario, $telefoneUsuario, $linkUsuario, $descricaofoneUsuario, $idTipoUsuario, $statusUsuario) {
        $verificarErro = 0;
        $flesh = '';

        $consultaUsuario = mysql_query("SELECT * FROM usuario");
        if (!$consultaUsuario) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            while ($linha = mysql_fetch_array($consultaUsuario)) {
                if ($emailUsuario == $linha['emailUsuario']) {
                    $verificarErro = 1;
                    $flesh = "Email já está cadastrado no sistema!";
                    break;
                } else if ($cpfUsuario == $linha['cpfUsuario']) {
                    $verificarErro = 1;
                    $flesh = "CPF já está cadastrado no sistema!";
                    break;
                }
            }
        }


        if ($verificarErro == 0) {
            $cadastraUsuario = mysql_query("INSERT INTO usuario (idUsuario,nomeUsuario,apelidoUsuario,emailUsuario,cpfUsuario,telefoneUsuario,linkUsuario,descricaoUsuario,idTipoUsuario,statusUsuario) VALUES ('','" . $nomeUsuario . "','" . $apelidoUsuario . "','" . $emailUsuario . "','" . $cpfUsuario . "','" . $telefoneUsuario . "','" . $linkUsuario . "','" . $descricaofoneUsuario . "'," . $idTipoUsuario . "," . $statusUsuario . ")");
            if (!$resultado = $cadastraUsuario) {
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
//        $verificarErro = 1;
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function gerar_nova_senha_usuario($apelido_email) {

        $verificarErro = 0;
        $flesh = '';

        $consultarUsuarioExiste = mysql_query("SELECT * FROM usuario WHERE ((apelidoUsuario= '" . $apelido_email . "' or emailUsuario='" . $apelido_email . "')AND(statusUsuario=1));");
        if (!$consultarUsuarioExiste) {
            $flesh = mysql_error();
            $verificarErro = 1;
        } else {
            $senhaGerada = rand(10000000, 99999999);

            $linha = mysql_fetch_array($consultarUsuarioExiste);

            if (count($linha) > 1) {

                if (!mysql_query("update usuario set senhaUsuario=" . $senhaGerada . " where idUsuario = " . $linha['idUsuario'] . " ;")) {
                    $flesh = "Erro de update: " . mysql_error();
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    $para = $linha['emailUsuario'];
                    $assunto = "Nova senha para o sistema";
                    $mensagem = "Esta mensagem será enviada por email"
                            . "<br/><br/>"
                            . "Atenção :" . $linha['nomeUsuario'] . ", uma nova senha para o sistema foi gerada."
                            . "<br/><br/>"
                            . "Para acessar o sistema novamente você deve informar os dados abaixo.<br/>"
                            . "Os dados para acessar o sistema são:<br/>"
                            . "<br/>Apelido: " . $linha['apelidoUsuario']
                            . "<br/>Senha: " . $senhaGerada
                            . "<br/><br/> para acessar o sistema <a href=\"http://www.palavrasindigenas.com.br\">click aqui</a>"
                            . "<br/><br/>"
                            . "Desde já agradecemos.";

//                    if (!$this->enviarEmailUsuario($para, $assunto, $mensagem)) {
//                        $verificarErro = 1;
//                        $flesh = "Erro ao tentar enviar email para ususario!";
//                    }
                }
            } else {
                $flesh = "Apelido ou email não está presente no sistema!";
                $verificarErro = 1;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    private function enviarEmailUsuario($para, $assunto, $mensagem) {
        $subject = $assunto;

        $from = "palavrasindigenas@yahoo.com.brnet"; //$_POST['remetente'];

        $to = $para;

        $message = $mensagem;

        $bcc = null; // Esconder endereços de e-mails.

        $cc = null; // Qualquer destinatário pode ver os endereços de e-mail especificados nos campos To e Cc.

        $headers = sprintf('Date: %s%s', date("D, d M Y H:i:s O"), PHP_EOL);

        $headers .= sprintf('Return-Path: %s%s', $from, PHP_EOL);

        $headers .= sprintf('To: %s%s', $to, PHP_EOL);

        $headers .= sprintf('Cc: %s%s', $cc, PHP_EOL);

        $headers .= sprintf('Bcc: %s%s', $bcc, PHP_EOL);

        $headers .= sprintf('From: %s%s', $from, PHP_EOL);

        $headers .= sprintf('Reply-To: %s%s', $from, PHP_EOL);

        $headers .= sprintf('Message-ID: <%s@%s>%s', md5(uniqid(rand(), true)), $_SERVER['HTTP_HOST'], PHP_EOL);

        $headers .= sprintf('X-Priority: %d%s', 3, PHP_EOL);

        $headers .= sprintf('X-Mailer: PHP/%s%s', phpversion(), PHP_EOL);

        $headers .= sprintf('Disposition-Notification-To: %s%s', $from, PHP_EOL);

        $headers .= sprintf('MIME-Version: 1.0%s', PHP_EOL);

        $headers .= sprintf('Content-Transfer-Encoding: 8bit%s', PHP_EOL);

        $headers .= sprintf('Content-Type: text/html; charset="utf-8"%s', PHP_EOL);



        if (mail(null, $subject, $message, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function salvarNovaSenhaUsuario($senhaAtual, $novaSenha, $idUsuario) {
        $verificarErro = 0;
        $flesh = '';

        $consultaSenhaAtual = mysql_query("SELECT count(idUsuario) as existe FROM usuario WHERE (idUsuario =" . $idUsuario . ") AND (senhaUsuario='" . $senhaAtual . "');");
        if (!$consultaSenhaAtual) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            $linha = mysql_fetch_array($consultaSenhaAtual);

            if ($linha['existe'] == 0) {
                $verificarErro = 1;
                $flesh = "A senha atual esta incorreta!";
            }
        }

        if ($verificarErro == 0) {
            $salvarSenha = mysql_query("UPDATE usuario SET senhaUsuario ='" . $novaSenha . "' WHERE idUsuario=" . $idUsuario . ";");
            if (!$salvarSenha) {
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function salvarDadosUsuario($nomeUsuario, $apelidoUsuario, $emailUsuario, $cpfUsuario, $telefoneUsuario, $linkUsuario, $descricaofoneUsuario, $senhaAtual, $idUsuario) {
        $verificarErro = 0;
        $flesh = '';

        $consultaSenhaAtual = mysql_query("SELECT count(idUsuario) as existe FROM usuario WHERE (idUsuario =" . $idUsuario . ") AND (senhaUsuario='" . $senhaAtual . "');");
        if (!$consultaSenhaAtual) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            $linha = mysql_fetch_array($consultaSenhaAtual);

            if ($linha['existe'] == 0) {
                $verificarErro = 1;
                $flesh = "A senha atual esta incorreta!";
            }
        }

        if ($verificarErro == 0) {
            $salvarDados = mysql_query("UPDATE usuario SET nomeUsuario='" . $nomeUsuario . "',apelidoUsuario='" . $apelidoUsuario . "',emailUsuario='" . $emailUsuario . "',cpfUsuario='" . $cpfUsuario . "',telefoneUsuario='" . $telefoneUsuario . "',linkUsuario='" . $linkUsuario . "',descricaoUsuario='" . $descricaofoneUsuario . "' WHERE idUsuario=" . $idUsuario . ";");
            if (!$salvarDados) {
                $flesh = mysql_error();
                $verificarErro = 1;
            } else {
                $_SESSION['user_nome'] = $nomeUsuario;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

}
