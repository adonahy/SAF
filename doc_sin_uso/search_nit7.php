<?php
    require 'connection.php';

    $opt = $_GET['nit'];
    
    $query = mysql_query("SELECT `nit`,`forma_pago` FROM clientes WHERE nit = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['forma_pago'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>