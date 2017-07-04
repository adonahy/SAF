<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `codigo`,`descripcion`,`cantidad`,`costoxunidad` FROM inventario_central WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $can   = $r['cantidad'];
    echo "$can";
    return;

/*
if ($opt == "1111111"){
	      echo 'todo va bien!';
        return;
}else{
    echo 'ya casi va bien!';
        return;
}
*/
?>
