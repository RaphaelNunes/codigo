<?php include 'properties.php';
	
	$dados = new Constant;
	$host = getProperty($dados->DB_HOST);
	$user = getProperty($dados->DB_USER);
	$pass = getProperty($dados->DB_PASS);
	$pltc = getProperty($dados->DB_PLTC);
	
	$conexao = mysql_connect("localhost","root","123");
        if(!$conexao){
    		die('Não foi possível conectar: ' . mysql_error());
	}
	else
            echo 'Conexão bem sucedida';

	//$conexao = mysql_connect("localhost","root","");
	mysql_select_db($pltc, $conexao);
	mysql_set_charset("utf8");
        
 //       $sql1 = mysql_query("Select nome_cidade from cidade")or die (mysql_error());
 //while ($sql = mysql_fetch_array($sql1))
 //    echo $sql[nome_cidade]."</br>";

?>
