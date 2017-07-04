<?php
    require 'connection.php';

    $opt = $_GET['nit'];
    
    $query = mysql_query("SELECT `nit`,`direccion_fiscal` FROM clientes WHERE nit = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['direccion_fiscal'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>