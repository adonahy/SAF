<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    //$can = $_GET['can'];
    
    $query = mysql_query("SELECT `codigo`,`costoxunidad` FROM inventario_central WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['costoxunidad'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>