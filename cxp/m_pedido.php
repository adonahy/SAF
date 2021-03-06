<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    //error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ST System</title>
	<meta name="description" content="ST System">
	<meta name="author" content="Alexander Jauregui">
	<meta name="keyword" content="Dashboard, Admin">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<script type="text/javascript">    
    function search(codigo,name,producto,pu,producto2,pu2)
       {
          var xmlhttp_ex;
          var xml_producto;
          var xml_pu;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_ex  =   new XMLHttpRequest();
            xml_producto=   new XMLHttpRequest();
            xml_pu      =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_ex  =   new ActiveXObject("Microsoft.XMLHTTP");
            xml_producto=   new ActiveXObject("Microsoft.XMLHTTP");
            xml_pu      =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_ex.onreadystatechange = function() {
            if(xmlhttp_ex.readyState == 4 && xmlhttp_ex.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(name).innerHTML = xmlhttp_ex.responseText;
            }
          }
          
          xml_producto.onreadystatechange = function() {
            if(xml_producto.readyState == 4 && xml_producto.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(producto).innerHTML = xml_producto.responseText;
                document.getElementById(producto2).value = xml_producto.responseText;
            }
          }
          
          xml_pu.onreadystatechange = function() {
            if(xml_pu.readyState == 4 && xml_pu.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(pu).innerHTML = xml_pu.responseText;
                document.getElementById(pu2).value = xml_pu.responseText;
            }
          }

          xmlhttp_ex.open("GET","search_ex.php?codigo="+codigo, true);
          xmlhttp_ex.send();
          xml_producto.open("GET","search_prod.php?codigo="+codigo, true);
          xml_producto.send();
          xml_pu.open("GET","search_pu.php?codigo="+codigo, true);
          xml_pu.send();

      }
    
    
    function sum_tot(valor, precio, nombre, iva, value_total) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(precio).value;
        var tot = valor * num1;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(nombre).innerHTML = '<font color=\"green\">'+tot+'</font>';
        //document.getElementById(total).innerHTML = '<font color=\"green\">'+tot+'</font>';
        document.getElementById(value_total).value = tot;
        sum_tot2();
        
    }
    
    function sum_tot2() {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var tot1    =   Number(document.getElementById('subtotal1').value);
        var tot2    =   Number(document.getElementById('subtotal2').value);
        var tot3    =   Number(document.getElementById('subtotal3').value);
        var tot4    =   Number(document.getElementById('subtotal4').value);
        var tot5    =   Number(document.getElementById('subtotal5').value);
        var gran_total  =  tot1 + tot2 + tot3 + tot4 + tot5;

        //  document.getElementById("tot_bi").value = tot; 
        document.getElementById('span_subtotal').innerHTML = '<font color=\"green\">'+gran_total+'</font>';
        document.getElementById('span_grantotal').innerHTML = '<font color=\"green\">'+total_iva+'</font>';
        document.getElementById('gran_tota').value = gran_total;
        //document.getElementById('span_grantotal').innerHTML = '<font color=\"green\">'+gran_total+'</font>';
    }
    
    function sum_totst(valor, cantidad, totalst, value_totalst) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var can = document.getElementById(cantidad).value;
        var tot = valor * can;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(totalst).innerHTML = '<font color=\"green\">'+tot+'</font>';
        document.getElementById(value_totalst).value = tot;
        sum_totst2();
    }
    
    function sum_totst2() {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var tot1    =   Number(document.getElementById('totalst21').value);
        var tot2    =   Number(document.getElementById('totalst22').value);
        var tot3    =   Number(document.getElementById('totalst23').value);
        var tot4    =   Number(document.getElementById('totalst24').value);
        var tot5    =   Number(document.getElementById('totalst25').value);
        var gran_total  =   tot1 + tot2 + tot3 + tot4 + tot5;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById('span_costo_st').innerHTML = '<font color=\"green\">'+gran_total+'</font>';
    }
    
    function recalcular(cantidad,costo,costo_visual){
        //alert('Recalculo...Cantidad: '+cantidad+' Costo: '+costo+' Costo Visual: '+costo_visual);
        var v_costo = document.getElementById(costo).value;
        var tot     = cantidad * v_costo;
        //alert('resultado: '+ tot);
        document.getElementById(costo_visual).innerHTML = '<font color=\"green\">'+tot+'</font>';
    }
    
    function sum_total(valor, total, sum1, sum2, value_grantotal) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(sum1).value;
        var num2 = document.getElementById(sum2).value;
        var tot = valor * num1 * num2;
        var tot = tot.toFixed(2);

        //  document.getElementById("tot_bi").value = tot;
        
        document.getElementById(total).innerHTML = '<font color=\"green\">'+tot+'</font>';
        document.getElementById(value_grantotal).value = tot;
        sum_total2();
        //sum_tot2();
    }
    
    function sum_total2() {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var tot1    =   Number(document.getElementById('total21').value);
        var tot2    =   Number(document.getElementById('total22').value);
        var tot3    =   Number(document.getElementById('total23').value);
        var tot4    =   Number(document.getElementById('total24').value);
        var tot5    =   Number(document.getElementById('total25').value);
        var gran_total  =   tot1 + tot2 + tot3 + tot4 + tot5;
        gran_total      =   gran_total.toFixed(2);

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById('span_grantotal').innerHTML = '<font color=\"green\">'+gran_total+'</font>';
    }
    
    //************ IVA *******************//
    
    function tot_iva(valor, value_totiva){
        
        //var gran_tot = document.getElementById(gran_total).value;
        var totiva = Number(document.getElementById('iva').value);
        //var tota_iva = tot_iva + gran_total;
        
       // document.getElementById('total_iva').innerHTML = '<font color=\"green\">'+tot_iva+'</font>';
        document.getElementById(value_totiva).value = totiva;
        
        sum_tot2();
        
    }
    
    
    //*********** FIN IVA *******************//
    
    //************ Calcular Gran total + impuesto ******************//////
    
    function tot_ivatotal(valor, iva, value_ivatot){
        
        
        var tot_iva    = Number(document.getElementById('gran_tota').value);
        var toiva           = valor;
        
        document.getElementById(value_ivatot).value = tot_iva;
        //document.getElementById('span_grantotal').innerHTML = '<font color=\"green\">'+toiva+'</font>';
        
    }
    
    //************ Fin de calcular gran total + impuesto ********////////
    
     function suma(cantidad,total,codigo,total2)
       {
          var xmlhttp_total;
          var precio;
          var tot;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_total  =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_total  =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_total.onreadystatechange = function() {
            if(xmlhttp_total.readyState == 4 && xmlhttp_total.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
              //document.getElementById(total).innerHTML = xmlhttp_total.responseText;
                codigo = document.getElementById(codigo).value;
                document.getElementById(total).innerHTML = xmlhttp_total.responseText;
                document.getElementById(total2).value = xmlhttp_total.responseText;
            }
          }
          
          cod = document.getElementById(codigo).value;

          xmlhttp_total.open("GET","search_pu2.php?codigo="+cod+"&can="+cantidad, true);
          xmlhttp_total.send();

      }
    
   
    
    function search_cliente(cliente)
       {
           var xmlhttp_nit;
           var xmlhttp_telefono;
           
          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_nit                 =   new XMLHttpRequest();
            xmlhttp_telefono            =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_nit                 =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_telefono            =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_nit.onreadystatechange = function() {
            if(xmlhttp_nit.readyState == 4 && xmlhttp_nit.status == 200)
            {
              
                document.getElementById("nit").value = xmlhttp_nit.responseText;
            }
          }
          
          xmlhttp_telefono.onreadystatechange = function() {
            if(xmlhttp_telefono.readyState == 4 && xmlhttp_telefono.status == 200)
            {
          
                document.getElementById("tel").value = xmlhttp_telefono.responseText;
            }
          }
          
         
          xmlhttp_nit.open("GET","search_nit.php?cliente="+cliente, true);
          xmlhttp_nit.send();
          xmlhttp_telefono.open("GET","search_nit2.php?cliente="+cliente, true);
          xmlhttp_telefono.send();   
       }
   
</script>
<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"><span>ST System</span></a>
								
				<!-- start: Header Menu --> 
				<?php
                    require 'user.php';
                ?>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: MAIN MENU **************************************************** -->
		      <?php
                require 'side_bar.php';
              ?>
			<!-- end: MAIN MENU ****************************************************** -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Advertencia!</h4>
					<p>Necesitas tener <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> habilitado en tu computadora!.</p>
				</div>
			</noscript>
			
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>
                    <a href="#">Ventas</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_pedidos.php">Mantenimiento de pedidos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de pedidos</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                //INICIA IF PARA GUARDAR CABECERA DE la factura----------------
                if(empty($_POST)===false && $_POST['flag1']=="next"){
                        $pedido     =   $_POST['no_pedido'];
                        $fecha      =   $_POST['date01'];
                        $id_cliente =   $_POST['nombre_cliente'];
                      //  $id_vendedor=   $_POST['vendedor'];
                        $fecha_viaje=   $_POST['date02'];
                        $estatus    =   0;
                    
                        $queryv     =   mysql_query("SELECT `codigo`,`nombre_comercial`, `id_vendedor`  FROM `clientes` WHERE codigo = '$id_cliente'");
                        $qv         =   mysql_fetch_array($queryv);
                    
                        $id_vendedor=   $qv['id_vendedor'];
                        
                        $d          =   "Ingreso el pedido: ";
                        $t          =   "pedidos_cabecera";
                        
                        $query2     =   mysql_query("INSERT INTO `pedidos_cabecera` (`id_pedido`, `fecha_pedido`, `fecha_despacho`, `id_cliente`, `id_vendedor`, `transporte_departamental`, `observaciones`, `estatus_factu`) VALUES ('$pedido', '$fecha', '$fecha_viaje', '$id_cliente', '$id_vendedor', '', '', '$estatus')");
                        
                        insert_logs($da, $u, $d, $t, $pedido);
                        //echo "<h3>Orden de compra ingresada con éxito!</h3>";
                        $flag1  =   "next";
                }
              
                
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
                //INICIA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                        $conta        =   $_POST['contador'];
                        $pedido       =   $_POST['pedido'];
                        //echo "El PEDIDO ES: " . $pedido;
                        $count = 0;
                        $total_f = 0;
                        $impuesto   =   $_POST['iva'];
                        while($count < $conta){ 
                            $count      =   $count + 1;
                            
                            $name_cantidad    =   "cantidad" . $count;
                            $name_des         =   "des" . $count;
                            $name_cosst       =   "cosst" . $count;
                            $name_precio      =   "precio" . $count;
                            $name_proveedor   =   "proveedor" . $count;     
                           // $name_impuesto    =   "impuesto" . $count;
                            
                            $cantidad   =   $_POST["$name_cantidad"];
                            $des        =   $_POST["$name_des"];
                            $cosst      =   $_POST["$name_cosst"];
                            $precio     =   $_POST["$name_precio"];
                            $proveedor  =   $_POST["$name_proveedor"];
                            $total      =   $cantidad * $precio;
                            
                            //$total      =   $subtotal * $impuesto;
                            
                            //echo "<br>El impuesto es: " . $impuesto;
                            $total_f    =   $total_f + ($cantidad * $precio);
                            $total_iva  =   $total_f + (($cantidad * $precio)+$impuesto);
                            
                            
                        
                        $query6 =   mysql_query("UPDATE `pedidos_cabecera` SET `total_siniva` = '$total_f', `total` = '$total_iva', `impuesto` = '$impuesto' WHERE CONCAT(`pedidos_cabecera`.`id_pedido`) = '$pedido';");
                            if($total > 0){
                        $query8 =   mysql_query("INSERT INTO `pedidos_secundaria` (`id_control`, `id_pedido`, `cantidad`, `producto`, `costo`, `precio`, `id_proveedor`, `sub_total`,`impuesto`,`total`) VALUES (NULL, '$pedido', '$cantidad', '$des', '$cosst', '$precio', '$proveedor', '$total', '', '') ");
                            }
                           // echo "$cod, $des, $ref, $can, $cos, $tot <br>";
                        }
                    //echo "<br> El total a modificar fue de: " . $total_f;
                        $flag1  =   "guardar";
                }
                //FINALIZA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                
                //INICIA LA CABECERA DE EL PEDIDO--------------------
                ?>
                <h1>Ingreso de pedidos</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
                             <label class=" control-label" for="no_pedido">NO. PEDIDO: </label>
                                  <div class="controls">
                                      <?php
                                        $query1     =   mysql_query("SELECT `id_pedido` FROM `pedidos_cabecera` ORDER BY `id_pedido` DESC LIMIT 1");
                                        $result1    =   mysql_fetch_array($query1);
                                        $codigo     =   $result1['id_pedido'] + 1;
                                      ?>
								<input type="text" class="input-medium typeahead" id="no_pedido" name="no_pedido" value="<?php echo "$codigo";?>">
							  </div><br>    
							</div>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                <tr>
                                    <td>
                                        <label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>
                                        <div class="controls">
								           
                                            <select id="nombre_cliente" name="nombre_cliente" onchange="search_cliente(this.value);" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    $query_c = mysql_query("SELECT `id_vendedor`,`id_user` FROM `vendedores` WHERE id_user = '$u'");
                                                    $rc     = mysql_fetch_array($query_c);
                                                    $id_vendedor= $rc['id_vendedor'];
                                                    $query2   =   mysql_query("SELECT `codigo`,`nombre_comercial` FROM `clientes` WHERE id_vendedor = '$id_vendedor' ORDER BY `codigo` DESC");
                                      
                                                    while($result2=mysql_fetch_array($query2)){
                                                        $name       =   $result2['nombre_comercial'];
                                                        $id         =   $result2['codigo'];
                                                ?>
                                                        <option value="<?php echo "$id";?>"><?php echo "$name";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div>
                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="nit">NIT: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="nit" name="nit">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="tel">TELEFONO: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="tel" name="tel">
							            </div>
                                    </td>
                                </tr>
							    <tr>
                                    <td>
                                        <div class="control-group">
							  <label class="control-label" for="date02">FECHA DE VIAJE:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo $da; ?>">
							  </div>   
							</div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="vendedor" name="vendedor" >
							            </div>
                                    </td>
                                </tr>
                                
                            </table>
							</div>
							<div class="form-actions">
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
							</div>
						  </fieldset>
						</form>     
                                <?php
                                //-----------FINALIZA LA CABECERA DE EL PEDIDO----------------
                                    }else if($flag1=="next"){
                                //-----------INICIA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                                        $fecha       =   $_POST['date01'];
                                        $no_pedido   =   $_POST['no_pedido'];
                                        $id_cliente  =   $_POST['nombre_cliente'];
                                        $nit         =   $_POST['nit'];
                                        $tel         =   $_POST['tel'];
                                        $fecha_v     =   $_POST['date02'];
                                        //$id_vendedor =   $_POST['vendedor'];
                                
                                $query4 =   mysql_query("SELECT `codigo`,`nombre_comercial`, `id_vendedor`  FROM `clientes` WHERE codigo = '$id_cliente'");
                                $r4     =   mysql_fetch_array($query4);
                                $cliente=   $r4['nombre_comercial'];
                                $id_vendedor =  $r4['id_vendedor'];
                                
                                $query5 =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor` FROM `vendedores` WHERE id_vendedor = '$id_vendedor'");
                                $r5     =   mysql_fetch_array($query5);
                                $v_name =   $r5['nombre_vendedor'];
                        
                                ?>
                        <form class="form-horizontal" method="post" >
						  <fieldset>
                              <table border="0" style="width:100%">
                                  <tr>
                                      <td>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
                                </td>
                                      <td>
                                      
                                      </td>
                                </tr>
                                      <tr>
                                          <td>
                             <label class=" control-label" for="no_pedido">NO. PEDIDO: </label>
                                  <div class="controls">
								<input disabled type="text" class="input-medium typeahead" id="no_pedido" name="no_pedido" value="<?php echo "$no_pedido";?>">
							  </div><br>    
							</div>
                                  </td>
                              <td>
                                  <label class="control-label" for="iva">IVA:</label>
							  <div class="controls">
								<input  type="text" class="input-medium typeahead" id="iva" name="iva" onkeyup="tot_iva(this.value,'total_iva2' );" required >
							  </div>
                              </td>
                              </tr>
                              </table>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                <tr>
                                    <td>
                                        <label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>
                                        <div class="controls">
								            <!--<input type="text" class="input-xlarge typeahead" id="nombre_cliente" name="nombre_cliente"  onkeyup="search_cliente(this.value);">-->
                                            <select disabled id="nombre_cliente" name="nombre_cliente" onchange="search_cliente(this.value);" data-rel="chosen">
									           <option value="<?php echo "$cliente";?>"><?php echo "$cliente";?></option>
							            </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="nit">NIT: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="nit" name="nit" value="<?php echo "$nit";?>">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="tel">TELEFONO: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="tel" name="tel" value="<?php echo "$tel";?>">
							            </div>
                                    </td>
                                </tr>
							    <tr>
                                    <td>
                                        <div class="control-group">
							  <label class="control-label" for="date02">FECHA DE VIAJE:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo $fecha_v; ?>">
							  </div>   
							</div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="vendedo" name="vendedo" value="<?php echo "$v_name";?>">
								        </div> 
                                    </td>
                                </tr>
                                
                            </table>
							</div>
                     <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                  
                                  <th>CANTIDAD</th>
                                  <th>DESCRIPCION</th>
								  <th>COSTO UNITARIO S&T</th>
                                  <th>COSTO TOTAL S&T</th>
                                  <th>PRECIO</th>
                                  <th>PROVEEDOR</th>
                                  <th>TOTAL</th>
                                <!--  <th>IMPUESTO</th>
                                  <th>TOTAL</th> -->
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            
                              $count=0;
                            // comienza loop para la creacion de la tabla de ingreso de los distintos productos a solicitar en el pedido!
                              while($count <= 5){ 
                                 
                                  $count        =   $count + 1;
                                  
                                  $name_cantidad    =   "cantidad" . $count;
                                  $name_des         =   "des" . $count;
                                  $name_cosst       =   "cosst" . $count;
                                  $name_precio      =   "precio" . $count;
                                  $name_proveedor   =   "proveedor" . $count;
                                  $name_subtotal    =   "subtotal" . $count;
                                  $name_subtotal2   =   "subtotal2" . $count;
                                  $name_impuesto    =   "impuesto" . $count;
                                  $name_total       =   "total" . $count;
                                  $name_total2      =   "total2" . $count;
                                  $name_total_st    =   "totalst" . $count;
                                  $name_total_st2   =   "totalst2" . $count;
                                  
                          ?>
							<tr>
								<td class="center">
                                <input type="text" class="input-small typeahead" id="<?php echo "$name_cantidad";?>" name="<?php echo "$name_cantidad";?>" onkeyup="sum_tot(this.value,'<?php echo "$name_precio";?>','<?php echo "$name_subtotal";?>','iva','<?php echo "$name_subtotal2";?>'); recalcular(this.value,'<?php echo "$name_cosst";?>','<?php echo "$name_total_st";?>');">
                            
                                </td>
								<td class="center">
                                    <textarea class="cleditor2" id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>" rows="4"></textarea>
                                </td>
                                <td>
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_cosst";?>" name="<?php echo "$name_cosst";?>" onkeyup="sum_totst(this.value,'<?php echo "$name_cantidad";?>','<?php echo "$name_total_st";?>','<?php echo "$name_total_st2";?>');">
                                </td>
                                <td>
                                    <span id="<?php echo "$name_total_st";?>" name="<?php echo "$name_total_st";?>"></span>
                                    <input type="hidden" id="<?php echo "$name_total_st2";?>" name="<?php echo "$name_total_st2";?>" value="">
                                </td>
                                <td>
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_precio";?>" name="<?php echo "$name_precio";?>" onkeyup="sum_tot(this.value,'<?php echo "$name_cantidad";?>','<?php echo "$name_subtotal";?>','iva','<?php echo "$name_subtotal2";?>');">
                                </td>
                                <td>
                                    <select class="input-medium" id="<?php echo "$name_proveedor";?>" name="<?php echo "$name_proveedor";?>" data-rel="chosen">
                                           <?php
                                                $query7 =   mysql_query("SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedores`");
                                                while($r7     =   mysql_fetch_array($query7)){
                                                    $proveedor = $r7['nombre_proveedor'];
                                                    $id_prov   = $r7['id_proveedor'];
                                            ?> 
									       <option value="<?php echo"$id_prov";?>"><?php echo"$proveedor";?></option>   
                                        <?php
                                                }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span id="<?php echo "$name_subtotal";?>" name="<?php echo "$name_subtotal";?>"></span>
                                    <input type="hidden" id="<?php echo "$name_subtotal2";?>" name="<?php echo "$name_subtotal2";?>" value="">
                                </td>
                                <!--<td>
								        <select class="input-small" id="<?php echo "$name_impuesto";?>" name="<?php echo "$name_impuesto";?>" onchange="sum_total(this.value, '<?php echo "$name_total";?>', '<?php echo "$name_cantidad";?>', '<?php echo "$name_precio";?>', '<?php echo "$name_total2";?>');" data-rel="chosen">
                                           <option value="0"></option> 
									       <option value="1.19">SI</option>  
                                           <option value="1">NO</option>  
                                        </select>
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_total";?>" name="<?php echo "$name_total";?>"></span>
                                   <input type="hidden" id="<?php echo "$name_total2";?>" name="<?php echo "$name_total2";?>" value="">
                              </tr>-->
                          <?php
                              }
                          ?>
                              <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>TOTAL COSTO S&T</b>
                                </td>
                                <td>
                                    <span id='span_costo_st' name='span_costo_st'></span>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>TOTAL SUBTOTAL</b>
                                </td>
                                <td>
                                    <span id='span_subtotal' name='span_subtotal'></span>
                                </td>
                                <td>
                                
                                </td>
                                <td>
                                
                                </td>  
                              </tr>
                              
                              <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                                                        
                                </td>
                                <td>
                                    <b>TOTAL GRAN TOTAL</b>
                                </td>
                                <td>
                                    <input type="hidden" id="total_iva2" name="total_iva2" value="" >
                                    <input type="hidden" id="gran_tota" name="gran_tota" value="" onkeyup="tot_ivatotal(this.value,'total_iva2','span_grantotal')">
                                    <span id='span_grantotal' name='span_grantotal'></span>
                                    
                                    
                                </td>
                                  
                              </tr>
						  </tbody>
					  </table>            
					</div>
							<div class="form-actions">
                            <?php
                                if($flag1=="next"){
                            ?>
                                
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag1" name="flag1" value="guardar">
                              <input type="hidden" id="contador" name="contador" value="<?php echo"$count";?>">
                              <input type="hidden" id="pedido" name="pedido" value="<?php echo"$pedido";?>">
                              
                              
                            <?php
                                }else{
                            ?>
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>  
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Pedido ingresado con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
    </div>
    <?php }else{ ?>
    Usuario no registrado!
    <?php } ?>
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Ajustes</h3>
		</div>
		<div class="modal-body">
			<p>Aca se configuran los ajustes...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
			<a href="#" class="btn btn-primary">Salvar cambios</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<?php require 'footer.php';?>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	
        <script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	   
        <script src="js/jquery.flot.js"></script>
	
        <script src="js/jquery.flot.pie.js"></script>
	
        <script src="js/jquery.flot.stack.js"></script>
	
        <script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
