<?php

include 'properties.php';
	
	$t = new Constant();
        $host = getProperty($t->DB_HOST);
        echo $host;
       
?>