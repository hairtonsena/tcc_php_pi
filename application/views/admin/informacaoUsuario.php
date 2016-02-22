<?php

if (!empty($_POST['usuario'])) {
    include '../../persistencia/conexao/DB.class.php';
    $conectar = new DB();
    $conectar->conexao();

    $idUsuario = $_POST['usuario'];

    $consultaUsuario = mysql_query("SELECT * FROM usuario WHERE idUsuario = " . $idUsuario . " ;");

    if (!$consultaUsuario) {
        die(mysql_error());
    } else {
        $linha = mysql_fetch_array($consultaUsuario);

        echo "Nome: " . $linha['nomeUsuario'] . "<br/>";
        echo "Apelido: " . $linha['apelidoUsuario'] . "<br/>";
        echo "Email: " . $linha['emailUsuario'] . "<br/>";
        echo "Telefone: " . $linha['telefoneUsuario'] . "<br/>";
        echo "CPF: " . $linha['cpfUsuario'] . "<br/>";
        echo "Link: " . $linha['linkUsuario'] . "<br/>";
        echo "Descricao: " . $linha['descricaoUsuario'] . "<br/>";
    }
}