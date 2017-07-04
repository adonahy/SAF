<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ILH System</title>
	<meta name="description" content="ILH System">
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
    function search(codigo,name)
       {
          var xmlhttp;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp.onreadystatechange = function() {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(name).innerHTML = xmlhttp.responseText;
            }
          }

          xmlhttp.open("GET","search_orden.php?codigo="+codigo, true);
          xmlhttp.send();

      }
    
    
    function sum_tot(valor, costo, nombre) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(costo).value;
        var tot = valor * num1;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(nombre).innerHTML = '<font color=\"green\">'+tot+'</font>';

    }
    
     function sum_tot2(valor, cantidad, nombre) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(cantidad).value;
        var tot = valor * num1;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(nombre).innerHTML = '<font color=\"green\">'+tot+'</font>';

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
				<a class="brand" href="index.html"><span>ILH System</span></a>
								
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
                    <a href="#">Compras</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_ordenes_compra.php">Mantenimiento de ordenes de compra</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de ordenes de compra</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                //INICIA IF PARA GUARDAR CABECERA DE LA ORDEN DE COMPRA----------------
                if(empty($_POST)===false && $_POST['flag1']=="next"){
                        $id_orden_compra    =   $_POST['ingreso'];
                        $id_orden_prod      =   $_POST['orden'];
                        $fecha              =   $_POST['date01'];
                        $tiempo_entrega     =   $_POST['tiempo'];
                        $condicion_pago     =   $_POST['condicion_pago'];
                        $moneda             =   $_POST['moneda'];
                        $lugar_entrega      =   $_POST['lugar'];
                        $horario_entrega    =   $_POST['horario'];
                        $id_prov            =   $_POST['proveedor'];
                        $observaciones      =   $_POST['ob'];
                        $estatus            =   0;
                    
                        $u          =   "Usuario Registrado";
                        $d          =   "Ingreso la orden de compra: ";
                        $t          =   "orden_compra_principal";
                        
                        $query2     =   mysql_query("INSERT INTO `orden_compra_principal` (`id_orden_compra`, `id_orden_prod`, `fecha_orden_compra`, `tiempo_entrega`, `condicion_pago`, `mondeda`, `lugar_entrega`, `horario_entrega`, `id_proveedor`, `observaciones`, `estatus`) VALUES (NULL, '$id_orden_prod', '$fecha', '$tiempo_entrega', '$condicion_pago','$moneda', '$lugar_entrega', '$horario_entrega', '$id_prov', '$observaciones', '$estatus')");
                        
                        insert_logs($da, $u, $d, $t, $id_orden_compra);
                        //echo "<h3>Orden de compra ingresada con éxito!</h3>";
                        $flag1  =   "next";
                }
                //FINALIZA IF PARA GUARDAR CABECERA DE LA ORDEN DE COMPRA----------------
                
                //INICIA IF PARA GUARDAR EL CUERPO DE LA ORDEN DE COMPRA----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                        $id_orden_compra    =   $_POST['ingreso'];
                        
                        $count = 0;
                        while($count < 5){ 
                                 
                                  $count        =   $count + 1;
                                  
                                  $name_cod     =   "cod" . $count;
                                  $name_ref     =   "ref" . $count;
                                  $name_cantidad=   "can" . $count;
                                  $name_costo   =   "cos" . $count;
                            
                                  $cod  =   $_POST["$name_cod"];
                                  $ref  =   $_POST["$name_ref"];
                                  $can  =   $_POST["$name_cantidad"];
                                  $cos  =   $_POST["$name_costo"];
                                  $tot  =   $can * $cos;
                        
                        $query4     =   mysql_query("SELECT `codigo`,`descripcion` FROM `inventario_central` WHERE codigo = '$cod'");
                        $r4         =   mysql_fetch_array($query4);
                        $des        =   $r4['descripcion'];
                        
                        $query2     =   mysql_query("INSERT INTO `orden_compra_secundaria` (`id_control`, `id_orden_compra`, `codigo`, `descripcion`, `referencia`, `cantidad`, `costo`, `total`) VALUES (NULL, '$id_orden_compra', '$cod', '$des', '$ref', '$can', '$cos', '$tot')");
                            
                           // echo "$cod, $des, $ref, $can, $cos, $tot <br>";
                        }
                    
                        $flag1  =   "guardar";
                }
                //FINALIZA IF PARA GUARDAR EL CUERPO DE LA ORDEN DE COMPRA----------------
                ?>
                <h1>Ingreso Ordenes de compra</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="ingreso">No. Orden de compra: </label>
                                  <div class="controls">
                                      <?php
                                        $query1     =   mysql_query("SELECT `id_orden_compra` FROM `orden_compra_principal` ORDER BY `id_orden_compra` DESC LIMIT 1");
                                        $result1    =   mysql_fetch_array($query1);
                                        $codigo     =   $result1['id_orden_compra'] + 1;
                                      ?>
								<input type="text" class="span6 typeahead" id="ingreso" name="ingreso" value="<?php echo "$codigo";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <label class="control-label" for="orden">No. Orden de trabajo: </label>
                              <div class="controls">
								<input type="text" class="span6 typeahead" id="orden" name="orden" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <div class="control-group">
								<label class="control-label" for="tiempo">Tiempo de entrega: </label>
								<div class="controls">
								  <select id="tiempo" name="tiempo" data-rel="chosen">
                                      <option value=""></option>
                                     
                                      <option value="8">8 días</option>
                                      <option value="15">15 días</option>
                                      <option value="20">20 días</option>
                                      <option value="30">30 días</option>
								    
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="condicion_pago">Condiciones de pago: </label>
								<div class="controls">
								  <select id="condicion_pago" name="condicion_pago" data-rel="chosen">
                                      <option value=""></option>
                                     
                                      <option value="Crédito">Crédito</option>
                                      <option value="Crédito">Contado</option>
								    
								  </select>
								</div>
							  </div>
                            <div class="control-group">
								<label class="control-label" for="moneda">Moneda: </label>
								<div class="controls">
								  <select id="moneda" name="moneda" data-rel="chosen">
                                      <option value=""></option>
                                     
                                      <option value="Quetzales">Quetzales Q</option>
                                      <option value="Dolares">Dolares $</option>
								    
								  </select>
								</div>
							  </div>
                            <div class="control-group">
								<label class="control-label" for="lugar">Lugar de entrega: </label>
								<div class="controls">
								  <select id="lugar" name="lugar" data-rel="chosen">
                                      <option value=""></option>
                                      
                                      <?php
                                        $query3 = mysql_query("SELECT `id_lugar`,`descripcion_lugar` FROM `lugar_entrega`");
                                        
                                        while($r3     = mysql_fetch_array($query3)){
                                            
                                            $id_lugar   =   $r3['id_lugar'];
                                            $name_lugar =   $r3['descripcion_lugar'];
                                      ?>
                                     
                                      <option value="<?php echo "$id_lugar";?>"><?php echo "$name_lugar";?></option>
                                      
								    <?php
                                        }
                                    ?>
								  </select>
								</div>
							  </div>
                            <label class="control-label" for="horario">Horario de entrega: </label>
                              <div class="controls">
								<input type="text" class="span6 typeahead" id="horario" name="horario" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
							</div>
                              <div class="control-group">
								<label class="control-label" for="proveedor">Proveedor: </label>
								<div class="controls">
								  <select id="proveedor" name="proveedor" data-rel="chosen">
                                      <option value=""></option>
                                      
                                      <?php
                                        $query3 = mysql_query("SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedores`");
                                        
                                        while($r3     = mysql_fetch_array($query3)){
                                            
                                            $id_prov    =   $r3['id_proveedor'];
                                            $name_prov  =   $r3['nombre_proveedor'];
                                      ?>
                                     
                                      <option value="<?php echo "$id_prov";?>"><?php echo "$name_prov";?></option>
                                      
								    <?php
                                        }
                                    ?>
								  </select>
								</div>
                                <label class="control-label" for="ob">Observaciones: </label>
                              <div class="controls">
								<input type="text" class="span6 typeahead" id="ob" name="ob" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
							  </div>
							<div class="form-actions">
                            <?php
                                if($flag1=="no"){
                            ?>
							  <button type="submit" class="btn btn-primary">Buscar</button>
                              <input type="hidden" id="flag1" name="flag1" value="yes">
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
                                    }else if($flag1=="next"){
                                ?>
                        <form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $fecha; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="ingreso">No. Orden de compra: </label>
                                  <div class="controls">
                                      <?php
                                        $query1     =   mysql_query("SELECT `id_orden_compra` FROM `orden_compra_principal` ORDER BY `id_orden_compra` DESC LIMIT 1");
                                        $result1    =   mysql_fetch_array($query1);
                                        $codigo     =   $result1['id_orden_compra'];
                                      ?>
								<input disabled type="text" class="input-medium typeahead" id="ingresoo" name="ingresoo" value="<?php echo "$codigo";?>">
                                <input type="hidden" id="ingreso" name="ingreso" value="<?php echo "$codigo";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <label class="control-label" for="orden">No. Orden de producción: </label>
                              <div class="controls">
								<input disabled type="text" class="input-medium typeahead" id="orden" name="orden" value="<?php echo "$id_orden_prod";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <div class="control-group">
								<label class="control-label" for="tiempo">Tiempo de entrega: </label>
								<div class="input-medium controls">
								  <select disabled id="tiempo" name="tiempo" data-rel="chosen">
                                      <option value=""><?php echo "$tiempo_entrega";?></option>
                                     
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="condicion_pago">Condiciones de pago: </label>
								<div class="controls">
								  <select disabled id="condicion_pago" name="condicion_pago" data-rel="chosen">
                                     
                                      <option value=""><?php echo "$condicion_pago";?></option>
								    
								  </select>
								</div>
							  </div>
                            <div class="control-group">
								<label class="control-label" for="moneda">Moneda: </label>
								<div class="controls">
								  <select disabled id="moneda" name="moneda" data-rel="chosen">
                                     
                                      <option value=""><?php echo "$moneda";?></option>
								    
								  </select>
								</div>
							  </div>
                            <div class="control-group">
								<label class="control-label" for="lugar">Lugar de entrega: </label>
								<div class="controls">
								  <select disabled id="lugar" name="lugar" data-rel="chosen">
                               
                                      <option value=""><?php echo "$lugar_entrega";?></option>
                                      
								  </select>
								</div>
							  </div>
                            <label class="control-label" for="horario">Horario de entrega: </label>
                              <div class="controls">
								<input disabled type="text" class="input-medium typeahead" id="horario" name="horario" value="<?php echo "$horario_entrega";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
							</div>
                              <div class="control-group">
								<label class="control-label" for="proveedor">Proveedor: </label>
								<div class="controls">
								  <select disabled  id="proveedor" name="proveedor" data-rel="chosen">
                                      
                                      <?php
                                        $query3 = mysql_query("SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedores` WHERE id_proveedor = '$id_prov'");
                                        
                                        while($r3     = mysql_fetch_array($query3)){
                                            
                                            $id_prov    =   $r3['id_proveedor'];
                                            $name_prov  =   $r3['nombre_proveedor'];
                                      ?>
                                     
                                      <option value=""><?php echo "$name_prov";?></option>
                                      
								    <?php
                                        }
                                    ?>
								  </select>
								</div>
                                <label class="control-label" for="ob">Observaciones: </label>
                              <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="ob" name="ob" value="<?php echo "$observaciones";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
							  </div>
                    
                     <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>CODIGO</th>
                                  <th>DESCRIPCION</th>
                                  <th>REFERENCIA</th>
								  <th>CANTIDAD</th>
                                  <th>COSTO</th>
                                  <th>TOTAL</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            
                              $count=0;
                            // comienza loop para la creacion de la tabla de ingreso de los distintos productos a solicitar en la orden de compra!
                              while($count < 5){ 
                                 
                                  $count        =   $count + 1;
                                  
                                  $name_cod     =   "cod" . $count;
                                  $name_des     =   "des" . $count;
                                  $name_ref     =   "ref" . $count;
                                  $name_cantidad=   "can" . $count;
                                  $name_costo   =   "cos" . $count;
                                  $name_total   =   "tot" . $count;
                                 
                                  
                          ?>
							<tr>
								<td class="center">
                                    <input  type="text" class="input-small typeahead" id="<?php echo "$name_cod";?>" name="<?php echo "$name_cod";?>" onkeyup="search(this.value,'<?php echo "$name_des";?>');">
                                </td>
								<td class="center">
                                    <span id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>"></span>
                                </td>
                                <td class="center">
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_ref"?>" name="<?php echo "$name_ref"?>" value="" >
                                </td>
                                <td class="center">
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_cantidad"?>" name="<?php echo "$name_cantidad"?>" value="" onkeyup="sum_tot(this.value,'<?php echo "$name_costo";?>','<?php echo "$name_total";?>');">
                                </td>
                                <td class="center">
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_costo";?>" name="<?php echo "$name_costo";?>" onkeyup="sum_tot(this.value,'<?php echo "$name_cantidad";?>','<?php echo "$name_total";?>');">
                                   
                                </td>
                                <td class="center">
                                    <span id="<?php echo "$name_total";?>" name="<?php echo "$name_total";?>"></span>
                                </td>
							</tr>
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
							<div class="form-actions">
                            <?php
                                if($flag1=="next"){
                            ?>
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag1" name="flag1" value="guardar">
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
                            } else if($flag1=="guardar"){
                                echo "<h3>Orden de compra ingresada con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php }else{echo "Usuario no autorizado!";} ?>
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
    </div>
		
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
	
<?php require 'footer.php'?>
	
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
