<?php
include './properties.php';
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
        
function consulta($sparql){
error_reporting(E_ALL);
ini_set("display_errors", 1);

$dados = new Constant;
$login = getProperty($dados->DB_LOGIN_SPARQL);
$url_sparql = getProperty($dados->DB_URL_SPARQL);

      //definindo o formato de retorno dos dados
       $format = 'application/sparql-results+json';
       //definindo a consulta
$consulta = $sparql;
//codificando a consulta
       $url = urlencode($consulta);
       //concatenando as string para formar a url de consulta
$sparqlURL = $url_sparql.'?query='.$url;

/*Setando o cabecalho da requisicao */
//usando a fun����o curl para conectar com o allegrograph
$curl = curl_init();//inicializando o curl
   curl_setopt($curl, CURLOPT_USERPWD, $login); //usuario e senha do banco
       curl_setopt($curl, CURLOPT_URL, $sparqlURL);//definindo a url de consulta
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Recebe o retorno da consulta como uma string
       curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept: '.$format));//definido o formato de retorno desejado
       $resposta = curl_exec( $curl );//executando o curl e armazenando a resposta numa variavel
       curl_close($curl);//fechando o curl
       
     
       ///////// come��ando a manipula����o de dados/////////////
       $objects = array();      
       $resultado = json_decode($resposta);//Decodificando o objecto json
       
       //pegando o valor de interesse no array//
       foreach($resultado->results->bindings as $reg){// primeiro loop
           $obj = new stdClass();
            foreach($reg as $field => $value){
                $obj->$field = $value->value;
            }
            $objects[] = $obj;
}//sai do segundo loop
           
           //return $objects[0];
 return $objects;          
}   
              
           $sparql = '
         SELECT ?tipo ?rua ?bairro ?cidade ?estado ?CEP ?CNPJ ?telefone ?disque ?site
WHERE	{
 	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> po:Place ?tipo }.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> vcard:street-address ?rua }.
	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> polbr:district ?bairro}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> vcard:locality ?cidade}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> geospecies:State ?estado}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> vcard:postal-code ?CEP}.
	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> polbr:CNPJ ?CNPJ}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> foaf:phone ?telefone}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> foaf:phone ?disque}.
  	OPTIONAL{ <http://ligadonospoliticos.com.br/politico/10> foaf:homepage ?site}.
  }';
       ///////////////////////////////////////////////////////////////////
       /*Imprimindo dados na tela */
       echo "<pre>";
      // print_r("/////////////////////////////////////////");
      // print_r($resposta);
      // print_r("/////////////////////////////////////////");
       //print_r("Imprimindo objecto json");
      // print_r($resultado);
       //print_r($objects);
       $objects = consulta($sparql);
       $row =  objectToArray($objects);
       foreach ($row as $r)
       {
           print_r($r["disque"]);
           echo '<br>';
       }
       echo "</pre>";
       ////////////////////////////////////////////////////////////////////
       
       
?>