<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `id_producto`,`precio_venta` FROM `inventario` WHERE id_producto = '$opt'");
    $r     = mysql_fetch_array($query);

    $cos   = $r['precio_venta'];
    
    if($cos==""){
        echo "No existe";
        return;
    }else{
        echo "<font color=\"green\">$cos</font>";  
        return;
    }
    

?>