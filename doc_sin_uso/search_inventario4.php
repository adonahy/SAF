<?php
    require 'connection.php';

    $opt = $_GET['codigo'];
    
    $query = mysql_query("SELECT `codigo`,`descripcion`,`cantidad`,`costoxunidad` FROM inventario_central WHERE codigo = '$opt'");
    $r     = mysql_fetch_array($query);

    $costo    = $r['costoxunidad'];
    $cantidad = $r['cantidad'];
    $subtotal = $costo * $cantidad;
    echo "$subtotal";
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
