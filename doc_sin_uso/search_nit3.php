<?php
    require 'connection.php';

    $opt = $_GET['nit'];
    
    $query = mysql_query("SELECT `nit`,`nombre_contacto` FROM clientes WHERE nit = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['nombre_contacto'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>