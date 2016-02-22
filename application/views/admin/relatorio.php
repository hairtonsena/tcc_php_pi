<?php

include '../../persistencia/conexao/DB.class.php';

// instanciando a classe de conexão com o banco de dados
$conexao = new DB();
// acessando o metodo de conexao na classe
$conexao->conexao();

$consultaPalavra = "SELECT * FROM palavra p inner join lingua l on(p.idLingua=l.idLingua) inner join povo pv on(pv.idPovo=p.idPovo) order by palavraPortugues";
//Query simples para busca dos dados
$busca = mysql_query($consultaPalavra) or die(mysql_error());
//VerificaÃ§Ã£o das linhas encontradas.

$ver = mysql_fetch_array($busca);
?>
<?php

$html = '<html>
    <head>
        <title>
            Palavras Indigenas
        </title>
        <meta charset="utf-8"/>
    </head>
    <body> 
        <center><h2>Palavras Indígenas</h3></center>
        <center><h3>Relatório com todas as palavras indígenas cadastradas no sistema</h3></center>
        <center><h4>Para saber mais acesse: www.palavrasindigenas.com.br</h4></center>
        <table border="1" width="100%"> 
            <thead> 
                <tr>
                    <th>Palavra Portugues</th>
                    <th>Palavra Indígena</th>
                    <th>Lingua</th> 
                    <th>Povo</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>';

if (!$resultadoPalavra = mysql_query($consultaPalavra)) {
    die(mysql_error());
} else {
    $linha = mysql_fetch_array($resultadoPalavra);
    do {

        $html .= "
                <tr>
                    <td>" . $linha['palavraPortugues'] . "</td>
                    <td>" . $linha['palavraIndigina'] . "</td>
                    <td>" . $linha['nomeLingua'] . "</td>
                    <td>" . $linha['nomePovo'] . "</td>
                    <td>" . $linha['obsPalavra'] . "</td>
                </tr>";
    } while ($linha = mysql_fetch_array($resultadoPalavra));
}
$html .= '

            </tbody>
        </table>

    </body>
</html>';
?>
<?php

mysql_free_result($busca);

//Aqui nós chamamos a class do dompdf
require_once('../../dompdf/dompdf_config.inc.php');

//É fundamental definir o TIMEZONE de nossa região para que não tenhamos problemas com a geração.
date_default_timezone_set('America/Sao_Paulo');

//Aqui eu estou decodificando o tipo de charset do documento, para evitar erros nos acentos das letras e etc.
//$html = utf8_decode($html);
//Instanciamos a class do dompdf para o processo
$dompdf = new DOMPDF();

//Aqui nós damos um LOAD (carregamos) todos os nossos dados e formatações para geração do PDF
$dompdf->load_html($html);

//Aqui nós damos início ao processo de exportação (renderizar)
$dompdf->render();

//por final forçamos o download do documento, coloquei a nomenclatura com a data e mais um string no final.
$dompdf->stream(date('d/m/Y') . '_palavras_indigenas.pdf');
?>