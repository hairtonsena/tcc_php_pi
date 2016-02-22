<?php

class Usuario {

    function habilitarColaborador($id_colaborador) {
        $verificarErro = 0;
        $flesh = "";

        $senhaGerada = rand(10000000, 99999999);



        if (!mysql_query("update usuario set statusUsuario=1 , senhaUsuario=" . $senhaGerada . " where idUsuario = " . $id_colaborador . " ;")) {
            $flesh = "Erro de update: " . mysql_error();
            $verificarErro = 1;
        }

        if ($verificarErro == 0) {
            if (!$consultarUsuario = mysql_query("SELECT * FROM usuario WHERE idUsuario=" . $id_colaborador . ";")) {
                $flesh = "Erro de consulta: " . mysql_error();
                $verificarErro = 1;
            } else {
                $linha = mysql_fetch_array($consultarUsuario);

                $para = $linha['emailUsuario'];

                $assunto = "Aprovação de colaborador";

                $mensagem = "Esta mensagem será enviada por email"
                        . "<br/><br/>"
                        . "Atenção :" . $linha['nomeUsuario'] . ", você foi aprovado (a) como colaborador do sistema ."
                        . "<br/><br/>"
                        . "Agradecemos pelo desejo de contribuir com este sistema que tem como objetivo preservar o linguajar dos povos indigenas.<br/>"
                        . "Os dados para acessar o sistema são:<br/>"
                        . "<br/>Apelido: " . $linha['apelidoUsuario']
                        . "<br/>Senha: " . $senhaGerada
                        . "<br/><br/> para acessar o sistema <a href=\"http://www.palavrasindigenas.com.br\">click aqui</a>"
                        . "<br/><br/>"
                        . "Desde já agradescemos.";

//                if(!$this->enviarEmailUsuario($para, $assunto, $mensagem)){
//                    $verificarErro =1;
//                    $flesh = "Erro ao tentar enviar Email para ususario";
//                }
            }
        }

        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function enviarEmailUsuario($para, $assunto, $mensagem) {
        $subject = $assunto;
        $from = "palavrasindigenas@yahoo.com.br"; //$_POST['remetente'];

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

    function desabilitarColaborador($id_colaborador) {
        $verificarErro = 0;
        $flesh = "";

        if (!mysql_query("update usuario set statusUsuario=-1  where idUsuario = " . $id_colaborador . " ;")) {
            $flesh = "Erro de update: " . mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
//            echo "<html><head><meta charset=\"utf-8\"/></head><body> ";
//            echo "Esta mensagem será enviada por email";
//            echo "<br/><br/>";
//            echo "Olá " . $arrayUsuario['nomeUsuario'] . ", você se tornou moderador do sistema " .";
//            echo "<br/><br/>";
//            echo "Agradecemos por contribuir mais afundo neste sistema. Seus dados para acesso continua o mesmo.";
////            echo "<br/>Apelido: " . $arrayUsuario['apelidoUsuario'];
////            echo "<br/>Senha: " . $senhaGerada;
//
//            echo "<br/><br/><br/><br/>";
//            echo "<a href=\"gerenciamentoUsuario.php\">Voltar ao gerenciamento de usuário</a> ";
//
//            echo "</body></html>";
        }

        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function habilitarModerador($id_moderador) {
        $verificarErro = 0;
        $flesh = "";

        if (!mysql_query("update usuario set idTipoUsuario=1  where idUsuario = " . $id_moderador . " ;")) {
            $flesh = "Erro de update: " . mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
//            echo "<html><head><meta charset=\"utf-8\"/></head><body> ";
//            echo "Esta mensagem será enviada por email";
//            echo "<br/><br/>";
//            echo "Olá " . $arrayUsuario['nomeUsuario'] . ", você se tornou moderador do sistema " .";
//            echo "<br/><br/>";
//            echo "Agradecemos por contribuir mais afundo neste sistema. Seus dados para acesso continua o mesmo.";
////            echo "<br/>Apelido: " . $arrayUsuario['apelidoUsuario'];
////            echo "<br/>Senha: " . $senhaGerada;
//
//            echo "<br/><br/><br/><br/>";
//            echo "<a href=\"gerenciamentoUsuario.php\">Voltar ao gerenciamento de usuário</a> ";
//
//            echo "</body></html>";
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function desabilitarModerador($id_moderador) {
        $verificarErro = 0;
        $flesh = "";

        if (!mysql_query("update usuario set idTipoUsuario=2  where idUsuario = " . $id_moderador . " ;")) {
            $flesh = "Erro de update: " . mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
//            echo "<html><head><meta charset=\"utf-8\"/></head><body> ";
//            echo "Esta mensagem será enviada por email";
//            echo "<br/><br/>";
//            echo "Olá " . $arrayUsuario['nomeUsuario'] . ", você se tornou moderador do sistema " .";
//            echo "<br/><br/>";
//            echo "Agradecemos por contribuir mais afundo neste sistema. Seus dados para acesso continua o mesmo.";
////            echo "<br/>Apelido: " . $arrayUsuario['apelidoUsuario'];
////            echo "<br/>Senha: " . $senhaGerada;
//
//            echo "<br/><br/><br/><br/>";
//            echo "<a href=\"gerenciamentoUsuario.php\">Voltar ao gerenciamento de usuário</a> ";
//
//            echo "</body></html>";
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

}
