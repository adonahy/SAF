<?php
    require 'connection.php';

    $opt = $_GET['cliente'];
    
    $query = mysql_query("SELECT `codigo`,`nombre_comercial` FROM clientes WHERE codigo = '$opt'");
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