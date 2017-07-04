<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `codigo`,`cantidad` FROM inventario_central WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['cantidad'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>