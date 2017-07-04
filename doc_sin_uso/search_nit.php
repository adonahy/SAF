<?php
    require 'connection.php';

    $opt = $_GET['cliente'];
    
    $query = mysql_query("SELECT `nit`,`codigo` FROM clientes WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['nit'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>