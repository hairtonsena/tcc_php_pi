<?php

class Palavra {

    function inserirPalavra($palavraPortugues, $palavraIndigena, $observacaoPalavra, $id_lingua, $id_povo, $id_usuario) {
        $verificarErro = 0;
        $flash = "";

        $consultaPalavra = mysql_query("SELECT * FROM palavra");
        if (!$consultaPalavra) {
            $flash = mysql_error();
            $verificarErro = 1;
        } else {
            while ($linha = mysql_fetch_array($consultaPalavra)) {
                if ((strtolower($linha['palavraPortugues']) == strtolower($palavraPortugues))and ( strtolower($linha['palavraIndigina']) == strtolower($palavraIndigena))and ( $linha['idPovo'] == $id_povo)and ( $linha['idLingua'] == $id_lingua)) {
                    $flash = "Está palavra já foi inserida!";
                    $verificarErro = 1;
                    break;
                }
            }
        }

//        $verificarErro = 1;
        if ($verificarErro == 0) {
            $salvarPalavra = mysql_query("INSERT INTO palavra(idPalavra,palavraPortugues,palavraIndigina,obsPalavra,idLingua,idPovo,idUsuario)
         VALUES(NULL,'$palavraPortugues','$palavraIndigena','$observacaoPalavra','$id_lingua','$id_povo','$id_usuario' )");
            if (!$salvarPalavra) {
                $flash = "Erro sql:" . mysql_error();
                $verificarErro = 1;
            }
        }

        $idUltimaPalavraInserida = NULL;
        if ($verificarErro == 0) {
            $consultaUltimaPalavra = mysql_query("SELECT * FROM palavra WHERE palavraPortugues='$palavraPortugues' AND palavraIndigina='$palavraIndigena' AND idLingua= $id_lingua AND idPovo=$id_povo AND idUsuario = $id_usuario ;");
            if (!$consultaUltimaPalavra) {
                $flash = mysql_error();
                $verificarErro = 1;
            } else {
                $linha = mysql_fetch_array($consultaUltimaPalavra);
                $idUltimaPalavraInserida = $linha['idPalavra'];
            }
        }

        return array("verificarErro" => $verificarErro, "flash" => $flash, "idUltimaPalavraInserida" => $idUltimaPalavraInserida);
    }

    function alterarPalavra($palavra_portugues, $palavra_indigena, $observacao_palavra, $id_tipo_lingua, $id_povo, $id_palavra) {

        $verificarErro = 0;
        $flesh = "";

        $consultaPalavra = mysql_query("SELECT * FROM palavra");
        if (!$consultaPalavra) {
            $flash = mysql_error();
            $verificarErro = 1;
        } else {
            while ($linha = mysql_fetch_array($consultaPalavra)) {
                if ((strtolower($linha['palavraPortugues']) == strtolower($palavra_portugues))and ( strtolower($linha['palavraIndigina']) == strtolower($palavra_indigena))and ( $linha['idPovo'] == $id_povo)and ( $linha['idLingua'] == $id_tipo_lingua)) {
                    if ($linha['obsPalavra'] == $observacao_palavra) {
                        $flesh = "Está palavra já foi inserida!";
                        $verificarErro = 1;
                        break;
                    }
                }
            }
        }

        if ($verificarErro == 0) {
            // comando sql para atualiar dados no tabela palavra
            $alterarPalavra = mysql_query("UPDATE palavra SET palavraPortugues = '$palavra_portugues',palavraIndigina = '$palavra_indigena',obsPalavra = '$observacao_palavra', idLingua = '$id_tipo_lingua',idPovo='$id_povo' 
         WHERE idPalavra = $id_palavra");

            // executando a sql no mysql
            if (!$alterarPalavra) {
                // interrompendo o script casa o sql estaja com erro e mostrando o erro.
                $flesh = mysql_error();
                $verificarErro = 1;
            } else {
                $verificarErro = 0;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function inserirImagemPalavra($nomeArquivo, $idPalavra) {
        $verificarErro = 0;
        $flesh = '';

        $inserirImagem = mysql_query("UPDATE palavra SET imagemPalavra = '$nomeArquivo' WHERE idPalavra = $idPalavra");

        if (!$inserirImagem) {
            $flesh = mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function inserirSomPalavra($nomeArquivo, $id_palavra) {
        $verificarErro = 0;
        $flesh = '';

        $inserirSom = mysql_query("UPDATE palavra SET somPalavra = '$nomeArquivo' WHERE idPalavra = $id_palavra");
        if (!$inserirSom) {
            $flesh = mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function excluir_palavra($idPalavra) {
        $verificarErro = 0;
        $flesh = '';

        $excluirTipoLingua = mysql_query("DELETE FROM palavra WHERE idPalavra ='$idPalavra'");

        if (!$excluirTipoLingua) {
            $flesh = mysql_error();
            $verificarErro = 1;
        } else {
            $verificarErro = 0;
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

}
