<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `id_producto`,`nombre_producto` FROM inventario WHERE id_producto = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['nombre_producto'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>