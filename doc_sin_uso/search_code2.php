<?php
    require 'connection.php';

    $opt = $_GET['code'];
    
    $query = mysql_query("SELECT `codigo`,`direccion_fiscal` FROM clientes WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['direccion_fiscal'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>