<?php

// Clase para conexão com banco de dados
class DB {

    // variaveis de conexão
    function conexao() {
      //  $host = 'localhost';
      //  $user = 'palavras_root';
      //  $senha = 'palavra';
      //  $database = 'palavras_indigenas';

       $host = 'localhost';
       $user = 'root';
       $senha = '';
       $database = 'palavras_indigenas';


        if (!$conexao = mysql_connect($host, $user, $senha)) {
            die("Erro ao tentar conectar ao banco!");
        }

        if (!$selecao = mysql_select_db($database, $conexao)) {
            die("Erro ao tentar selecionar o banco!");
        }


        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');

        return $selecao;
    }

}
