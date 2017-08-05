<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    $can = $_GET['can'];
    
    $query = mysql_query("SELECT `id_producto`,`precio_venta` FROM inventario WHERE id_producto = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['precio_venta'];
    $des   = $des * $can;
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>