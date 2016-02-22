<?php
include '../../conexao.php';

if ((isset($_GET['pesquisarPalavra']) && (isset($_GET['opcaoPesquisa'])))) {

    $opcaoPesquisa = $_GET['opcaoPesquisa'];
    $pesquisarPalavra = $_GET['pesquisarPalavra'];

    if ($opcaoPesquisa == 'portugues') {

        $consultaPalavra = "SELECT * FROM palavra p inner join lingua l on(p.idLingua=l.idLingua) WHERE palavraPortugues='" . $pesquisarPalavra . "'order by palavraPortugues";
    } else if ($opcaoPesquisa == 'indigena') {
        $consultaPalavra = "SELECT * FROM palavra p inner join lingua l on(p.idLingua=l.idLingua) WHERE palavraIndigina='" . $pesquisarPalavra . "'order by palavraPortugues";
    } else if ($opcaoPesquisa == 'tipo') {
        $consultaPalavra = "SELECT * FROM palavra p inner join lingua l on(p.idLingua=l.idLingua)  WHERE l.nomeLingua='" . $pesquisarPalavra . "'order by palavraPortugues";
    }
} else {
    $consultaPalavra = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) order by palavraPortugues";
}
?>
<html>
    <head>
        <title>
            Ver Palavra
        </title>
        <!-- setar os caracterer especiais (ç,~,`) para o padrão pt br (Portugues) -->
        <meta charset="utf-8"/>
    </head>
    <body>      
        <h3>Palavras</h3>
        <a href="../../cpainel.php" > <= Menu Principal </a> <br/> <br/>
        <a href="formPalavra.php"> Cadastrar Nova Palavra</a> 
        <div style="width: 100%">

            <div style="width: 60%; float: left">
                <form action="verPalavra.php" method="GET" > <br/>
                    <input type="radio" name="opcaoPesquisa" value="portugues" id="abc" />Portugues
                    <input type="radio" name="opcaoPesquisa" value="indigena" id="abc" />Indigena
                    <input type="radio" name="opcaoPesquisa" value="tipo" id="abc"/>Lingua
                    <br/>
                    <input type="text" name="pesquisarPalavra" size="50" value="" />
                    <input type="submit" value="Pesquisar"/>
                </form>
            </div>
            <div style="width: 40%; float: right; text-align: right">
                <br/>
                <br/>
                <a href="verPalavra.php" >Ver Todos </a> 
                |
                <a href="relatorio.php" > Gerar Relatorio </a> 
            </div>
        </div>
        <table width="100%" border="1"> 
            <thead> 
                <tr> 
                    <th>Id</th>
                    <th>Palavra Portugues</th>
                    <th>Palavra Indigena</th>
                    <th>Lingua</th>
                    <th>Observacão</th>  
                    <th>Imagem</th>
                    <th>Som</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$resultadoPalavra = mysql_query($consultaPalavra)) {
                    die(mysql_error());
                } else {
                    $linha = mysql_fetch_array($resultadoPalavra);
                    do {
                        echo "
                     <tr>
                                <td>" . $linha['idPalavra'] . "</td>
                                <td>" . $linha['palavraPortugues'] . "</td>
                                <td>" . $linha['palavraIndigina'] . "</td>
                                <td>" . $linha['nomeLingua'] . "</td>
                                <td>" . $linha['obsPalavra'] . "</td>
                                    <td>"
                        ?>  <a href="inserirImagemPalavra.php?idPalavra=<?php echo $linha['idPalavra'] ?>">Alterar Foto</a> <br/>
                    <img src="<?php echo "../../controle/palavra/imagem/" . $linha['imagemPalavra'] ?>" width="100" height="100" /> <?php echo"</td>
                     <td>" ?>  <a href="inserirSomPalavra.php?idPalavra=<?php echo $linha['idPalavra'] ?>">Alterar Som</a> <br/>
                    <audio controls>
                        <source src="<?php echo "../../controle/palavra/sons/" . $linha['somPalavra'] ?>" type="audio/mp3" > 
                    </audio>    
                    <?php
                    echo"</td> 
                                <td><a href='formAlterarPalavra.php?palavra=" . base64_encode($linha['idPalavra']) . "'>Alterar</a></td>
                                <td><a href='../controle/palavra/excluir_palavra.php?palavra=" . base64_encode($linha['idPalavra']) . "'>Excluir</a></td>
                            </tr>";
                } while ($linha = mysql_fetch_array($resultadoPalavra));
            }
            ?>
        </tbody>
    </table>
</body>
</html>