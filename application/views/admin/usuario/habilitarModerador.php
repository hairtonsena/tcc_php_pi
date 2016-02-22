<?php
include '../../../conexao.php';
$id_colaborador = base64_decode($_GET['moderador']);

if (!is_numeric($id_colaborador)) {
    die("Erro de colaborador!");
};

$consultarColaboradorExiste = "SELECT nomeUsuario, emailUsuario,apelidoUsuario, count(idUsuario) as total  FROM usuario where idUsuario = " . $id_colaborador . " group by 
	nomeUsuario, emailUsuario,apelidoUsuario ";

if (!$resultadoConsulta = mysql_query($consultarColaboradorExiste)) {
    die("Erro de consulta" . mysql_error());
} else {
    $arrayUsuario = mysql_fetch_array($resultadoConsulta);

    if ($arrayUsuario['total'] == 0) {
        echo "Usuário invalido";
    } else if ($arrayUsuario['total'] == 1) {

       // $senhaGerada = rand(10000000, 99999999);

        if (!mysql_query("update usuario set idTipoUsuario=1  where idUsuario = ".$id_colaborador." ;")) {
            die("Erro de update: " . mysql_error());
        } else {
            echo "<html><head><meta charset=\"utf-8\"/></head><body> ";
            echo "Esta mensagem será enviada por email";
            echo "<br/><br/>";
            echo "Olá " . $arrayUsuario['nomeUsuario'] . ", você se tornou moderador do sistema \"Palavras indiginas\" .";
            echo "<br/><br/>";
            echo "Agradecemos por contribuir mais a fundo neste sistema. Seus dados para acesso continua o mesmo.";
//            echo "<br/>Apelido: " . $arrayUsuario['apelidoUsuario'];
//            echo "<br/>Senha: " . $senhaGerada;

            echo "<br/><br/><br/><br/>";
            echo "<a href=\"gerenciamentoUsuario.php\">Voltar ao gerenciamento de usuário</a> ";

            echo "</body></html>";
        }
    }
}
