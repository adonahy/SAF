<?php
    require 'connection.php';

    $opt = $_GET['cliente'];
    
    $query = mysql_query("SELECT `codigo`,`tel` FROM clientes WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $des   = $r['tel'];
    
    if($des==""){
        echo "No existe";
        return;
    }else{
        echo "$des";  
        return;
    }
    

?>