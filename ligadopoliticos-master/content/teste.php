<?php
        
include '../properties.php';
	
	$t = new Constant();
        $host = getProperty($t->DB_HOST);
        $path = getcwd();
        echo '<br>'.$path;
        echo '<br>'.$host;
      
        
?>