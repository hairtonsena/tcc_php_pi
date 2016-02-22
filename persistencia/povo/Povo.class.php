<?php

class Povo {

    function inserirPovo($nomePovo, $observacaoPovo) {
        $verificarErro = 0;
        $flesh = '';

        $consultaPovo = mysql_query("SELECT * FROM povo");
        if (!$consultaPovo) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            while ($linha = mysql_fetch_array($consultaPovo)) {
                if (strtolower($linha['nomePovo']) == strtolower($nomePovo)) {
                    $verificarErro = 1;
                    $flesh = "Este povo já existe!";
                    break;
                }
            }
        }

        if ($verificarErro == 0) {
            $salvarPovo = mysql_query("INSERT INTO povo(idPovo,nomePovo,obsPovo)
         VALUES(NULL,'$nomePovo','$observacaoPovo' )");

            if (!$salvarPovo) {
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function salvaPovoAlterar($idPovo, $nomePovo, $observacaoPovo) {
        $verificarErro = 0;
        $flesh = '';

        $consultaPovo = mysql_query("SELECT * FROM povo");
        if (!$consultaPovo) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            while ($linha = mysql_fetch_array($consultaPovo)) {
                if (strtolower($linha['nomePovo']) == strtolower($nomePovo)) {
                    if (strtolower($linha['obsPovo']) == strtolower($observacaoPovo)) {
                        $verificarErro = 1;
                        $flesh = "Este povo já existe!";
                        break;
                    }
                }
            }
        }

        if ($verificarErro == 0) {
            $alterarPovo = mysql_query("UPDATE povo SET nomePovo = '$nomePovo',obsPovo = '$observacaoPovo' WHERE idPovo = $idPovo");
            // Executando o script slq no mysql
            if (!$alterarPovo) {
                // interrompendo o script se estiver com erro e mostrando o erro
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function excluirPovo($idPovo) {
        $verificarErro = 0;
        $flesh = '';

        $consultaPovoPalavra = mysql_query("SELECT count(idPalavra) as total FROM palavra WHERE idPovo=" . $idPovo . ";");
        if (!$consultaPovoPalavra) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            $linha = mysql_fetch_array($consultaPovoPalavra);
            if ($linha['total'] != 0) {
                $verificarErro = 1;
                $flesh = "Esta povo não pode ser excluido pois está sendo utilizado!";
            }
        }

        if ($verificarErro == 0) {
            // Comando sql mysql_query(para excluir um registro.
            $excluirPovo = mysql_query("DELETE FROM povo WHERE idPovo ='$idPovo'");
            // Execultando a quary no mysql
            if (!$excluirPovo) {
                // interrompendo script se a quary der algum erro e mostrando a mensagem de erro
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

}
