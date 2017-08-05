<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `id_producto`,`nombre_producto` FROM `inventario` WHERE id_producto = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['nombre_producto'];
    
    if($des==""){
        echo "<font color=\"red\">No existe</font>";
        return;
    }else{
        echo "<font color=\"green\">$des</font>";  
        return;
    }
    

?>