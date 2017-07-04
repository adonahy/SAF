<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `codigo`,`descripcion` FROM `inventario_central` WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['descripcion'];
    
    if($des==""){
        echo "<font color=\"red\">No existe</font>";
        return;
    }else{
        echo "<font color=\"green\">$des</font>";  
        return;
    }
    

?>