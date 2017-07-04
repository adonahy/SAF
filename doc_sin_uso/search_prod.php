<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `codigo`,`descripcion` FROM inventario_central WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['descripcion'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>