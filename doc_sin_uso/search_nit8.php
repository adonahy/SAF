<?php
    require 'connection.php';

    $opt = $_GET['nit'];
    
    $query = mysql_query("SELECT `nit`,`direccion_transporte` FROM clientes WHERE nit = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['direccion_transporte'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>