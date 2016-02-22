<?php
if (!empty($_POST['palavra'])) {
    include '../../persistencia/conexao/DB.class.php';
    $conectar = new DB();
    $conectar->conexao();

    $idPalavra = $_POST['palavra'];

    $consultaUsuarioPalavra = mysql_query("SELECT * FROM palavra P 
inner join usuario U on(P.idUsuario=U.idUsuario)
WHERE P.idPalavra = " . $idPalavra . " ;");

    if (!$consultaUsuarioPalavra) {
        die(mysql_error());
    } else {
        $linha = mysql_fetch_array($consultaUsuarioPalavra);
        echo "Nome: " . $linha['nomeUsuario'] . "<br/>";
        echo "Email: " . $linha['emailUsuario'];
    }
}