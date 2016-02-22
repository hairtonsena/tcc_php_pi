<?php

class Lingua {

    function inserirLingua($nomeLingua, $observacaoLingua) {
        $verificarErro = 0;
        $flesh = "";
        $consultaLingua = mysql_query("SELECT * FROM lingua");
        if (!$consultaLingua) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            while ($linha = mysql_fetch_array($consultaLingua)) {
                if (strtolower($linha['nomeLingua']) == strtolower($nomeLingua)) {
                    $verificarErro = 1;
                    $flesh = "Esta lingua já existe!";
                    break;
                }
            }
        }
        if ($verificarErro == 0) {
            $salvarTipoLingua = mysql_query("INSERT INTO lingua(idLingua,nomeLingua,obsLingua)
         VALUES(NULL,'$nomeLingua','$observacaoLingua' )");

            if (!$salvarTipoLingua) {
                $flesh = mysql_error();
                $verificarErro = 1;
            } else {
                $verificarErro = 0;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function salvarLinguaAlterar($idLingua, $nomeLingua, $observacaoLingua) {
        $verificarErro = 0;
        $flesh = '';

        $consultaLingua = mysql_query("SELECT * FROM lingua");
        if (!$consultaLingua) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            while ($linha = mysql_fetch_array($consultaLingua)) {
                if (strtolower($linha['nomeLingua']) == strtolower($nomeLingua)) {
                    if (strtolower($linha['obsLingua']) == strtolower($observacaoLingua)) {
                        $verificarErro = 1;
                        $flesh = "Esta lingua já existe!";
                        break;
                    }
                }
            }
        }

        if ($verificarErro == 0) {
            $alterarTipoLingua = mysql_query("UPDATE lingua SET nomeLingua = '$nomeLingua', obsLingua = '$observacaoLingua' WHERE idLingua = $idLingua ");

            if (!$alterarTipoLingua) {
                $flesh = mysql_error();
                $verificarErro = 1;
            } else {
                $verificarErro = 0;
            }
        }
        return array("verificarErro" => $verificarErro, "flesh" => $flesh);
    }

    function excluirLingua($idLingua) {
        $verificarErro = 0;
        $flesh = '';

        $consultaLinguaPalavra = mysql_query("SELECT count(idPalavra) as total FROM palavra WHERE idLingua=" . $idLingua . ";");
        if (!$consultaLinguaPalavra) {
            $verificarErro = 1;
            $flesh = mysql_error();
        } else {
            $linha = mysql_fetch_array($consultaLinguaPalavra);
            if ($linha['total'] != 0) {
                $verificarErro = 1;
                $flesh = "Esta lingua não pode ser excluida pois esta sendo utilizada!";
            }
        }

        if ($verificarErro == 0) {
            $excluirTipoLingua = mysql_query("DELETE FROM lingua WHERE idLingua ='$idLingua'");
            if (!$excluirTipoLingua) {
                $flesh = mysql_error();
                $verificarErro = 1;
            }
        }
        return array("verrificarErro" => $verificarErro, "flesh" => $flesh);
    }

}
