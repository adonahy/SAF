<?php
    require 'connection.php';

    $opt = $_GET['cliente'];
    
    $query = mysql_query("SELECT `codigo`,`id_vendedor` FROM clientes WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);
    
    $idvendedor = $r['id_vendedor'];

    $query2 = mysql_query("SELECT * FROM `vendedores` WHERE id_vendedor = '$idvendedor'");
    $r2     = mysql_fetch_array($query2);

    $des    = $r2['nombre_vendedor'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>