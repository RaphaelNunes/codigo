<?php
include './config.php';
$sql2 = mysql_query("SELECT descricao,tipo,valor FROM declaracao_bens WHERE id_politico = '$recurso'");
				$cont_declaracao_bens = mysql_num_rows($sql2);
				if ($cont_declaracao_bens > 0){	
					aba_politico_html('Declaração de Bens');	
				}

?>