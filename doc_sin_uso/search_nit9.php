<?php
    require 'connection.php';

    $opt = $_GET['nit'];
    
    $query = mysql_query("SELECT `nit`,`codigo` FROM clientes WHERE nit = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['codigo'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>