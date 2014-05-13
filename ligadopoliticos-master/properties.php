<?php	
	class Constant{
  
		public $DB_HOST = "db.host=";
		public $DB_USER = "db.user=";
		public $DB_PASS = "db.pass=";
		public $DB_PLTC = "db.pltc=";
                public $DB_LOGIN_SPARQL = "db.login_sparql=";
                public $DB_URL_SPARQL = "db.url_sparql=";
                
	}	

	function getProperty($string){
                $path = getcwd();
                $nome_projeto = "ligadopoliticos-master";
                $pos = strripos($path, $nome_projeto);
                //pega uma string do tamanho de pos
                $parte = substr($path,0,$pos);
                $parte .= $nome_projeto;
                $parte.= "/application.properties";
		$dados = fopen($parte,"r");
		while (!feof($dados)) {

			$linha = fgets($dados, 4096);

			$pos = stripos($linha, $string);
			

			if($pos !== false) {
				
				$db= trim(str_replace($string,"",$linha));
				
			}
		
		}
			
		fclose($dados);
		
          
		return $db;	
	}

	
?>
