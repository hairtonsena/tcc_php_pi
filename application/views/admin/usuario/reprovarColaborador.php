<?php
include '../../../conexao.php';
$id_colaborador = base64_decode($_GET['reprovar']);

if (!is_numeric($id_colaborador)) {
    die("Erro de colaborador!");
};

$consultarColaboradorExiste = "SELECT count(idUsuario) as total FROM usuario where idUsuario = " . $id_colaborador . " ";

if (!$resultadoConsulta = mysql_query($consultarColaboradorExiste)) {
    die("Erro de consulta" . mysql_error());
} else {
    $totalRegistro = mysql_fetch_array($resultadoConsulta);

    if ($totalRegistro['total'] == 0) {
        echo "Usuário invalido";
    } else if ($totalRegistro['total'] == 1) {

        if (!mysql_query("update usuario set statusUsuario=2 where idUsuario = 2 ;")) {
            die("Erro de update: " . mysql_error());
        } else {
            echo "O pedido e colaborador foi reprovador!";

            echo "<br/><br/><br/><br/>";
            echo "<a href=\"gerenciamentoUsuario.php\">Voltar ao gerenciamento de usuário</a> ";
        }
    }
}



