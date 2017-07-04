<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    //$flag   =   0;
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
    function search(codigo,costo)
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
                document.getElementById('des').innerHTML = xmlhttp.responseText;
            }
          }

          xmlhttp.open("GET","search_ofertas.php?codigo="+codigo, true);
          xmlhttp.send();

      }
    
    
    function sum_tot(valor, costo, nombre) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var tot = valor * costo;

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
				<a class="brand" href="index.php"><span>ILH System</span></a>
								
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
                    <a href="#">Bodega</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_egreso_materia_prima.php">Mantenimiento de egreso de materia prima</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Egreso de materia prima</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                if(empty($_POST['flag'])===false){
                    $flag   =   $_POST['flag'];
                    
                }else{
                    $flag   =   0;
                }
                
                if(empty($_POST)===false && $flag==1){
                        $fecha_ingreso  =   $_POST['date01'];
                        $no_orden       =   $_POST['n_o'];
                        $area           =   $_POST['area'];
                        $recibido       =   $_POST['recibio'];
                    
                        //$u          =   "Usuario Registrado";
                        $d          =   "Registro un nuevo egreso para la orden de producción: ";
                        $t          =   "egreso_productos_cabecera";
                        
                        $query=mysql_query("INSERT INTO `egreso_productos_cabecera` (`id_egreso`, `fecha_egreso`, `no_orden_prod`, `area`, `recibio`) VALUES (NULL, '$fecha_ingreso', '$no_orden', '$area', '$recibido')");
                        
                        insert_logs($da, $u, $d, $t, $no_factura);
                        //echo "<h3> Ingreso de producto realizado con éxito!</h3>";
                    }
                // ESTE IF ES PARA GUARDAR LA PARTE SECUNDARIA DEL INGRESO DEL PRODUCTO PERTENECIENTE A LO ELEGIDO DE LA ORDEN DE COMPRA
                if(empty($_POST)===false && $flag==2){
                    
                        $contador       =   $_POST['total'];
                        $eg             =   $_POST['no_eg'];
                    
                    while($contador>0){
                        $n_sel          =   "sel" . $contador;
                        $n_codigo       =   "cod" . $contador;
                        $n_des          =   "des" . $contador;
                        $n_cantidad     =   "can" . $contador;
                        $n_costo        =   "cos" . $contador;
                        
                        $select         =   $_POST["$n_sel"];
                        
                        if(isset($select)){
                        $codigo         =   $_POST["$n_codigo"];
                        $des            =   $_POST["$n_des"];
                        $cantidad       =   $_POST["$n_cantidad"];
                        $costo          =   $_POST["$n_costo"];
                        $total          =   $cantidad * $costo;
                    
                        $query5 =   mysql_query("INSERT INTO `egreso_productos_secundario` (`id`, `no_egreso`, `codigo`, `descripcion`, `cantidad`, `costo`, `total`) VALUES (NULL, '$eg', '$codigo', '$des', '$cantidad', '$costo', '$total')");
                        
                        $query7 =   mysql_query("SELECT `codigo`,`cantidad` FROM `inventario_central` WHERE `codigo` = '$codigo'");
                        $r7     =   mysql_fetch_array($query7);
                        $cantidad_actual=$r7['cantidad'];
                        $cantidad_actual=$cantidad_actual - $cantidad;
                        
                        $query8 =   mysql_query("UPDATE `inventario_central` SET `cantidad` = '$cantidad_actual' WHERE CONCAT(`inventario_central`.`codigo`) = '$codigo'");
                        
                        $query6 =   mysql_query("INSERT INTO `kardex_pt` (`id_kardex`, `fecha`, `codigo`, `observaciones`, `debe`, `haber`, `saldo`) VALUES (NULL, '$da', '$codigo', 'Se egreso producto', '$cantidad', '0', '$cantidad_actual')");
                        }
                        
                        $contador       =   $contador - 1;
                    }
                         echo    "<h3>Egreso efectuado exitosamente!</h3>";
                    }
                   
                ?>
                <h1>Mantenimiento de egreso de productos</h1>
                    <div class="box-content">
						<form class="form-horizontal" method="post" >
						  <fieldset>
                               <?php
                                if($flag==0){
                              ?>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
							</div>
							<div class="control-group">
                                <label class="control-label" for="n_o">No. Orden de producción: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="n_o" name="n_o" >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <div class="control-group">
                                <label class="control-label" for="area">Area: </label>
							  <div class="controls">
								  <select id="area" name="area" data-rel="chosen">
                                      <?php
                                        $query4 =   mysql_query("SELECT `id_area`, `descripcion_area` FROM `area`");
                                        
                                        while($r4     =   mysql_fetch_array($query4)){
                                            $id_area=   $r4['id_area'];
                                            $name_area=$r4['descripcion_area'];
                                      ?>
									<option value="<?php echo $id_area;?>"><?php echo $name_area;?></option>
                                      <?php
                                        }
                                      ?>
								  </select>
							  </div>
							</div>
                                <div class="control-group">
                                <label class="control-label" for="recibio">Recibio: </label>
							  <div class="controls">
								  <select id="recibio" name="recibio" data-rel="chosen">
                                      <?php
                                        $query4 =   mysql_query("SELECT `id_recibido`, `descripcion_recibido` FROM `lista_bodega_recibido`");
                                        
                                        while($r4     =   mysql_fetch_array($query4)){
                                            $id_recibido=   $r4['id_recibido'];
                                            $name_recibido=$r4['descripcion_recibido'];
                                      ?>
									<option value="<?php echo $id_recibido;?>"><?php echo $name_recibido;?></option>
                                      <?php
                                        }
                                      ?>
								  </select>
							  </div>
							</div>
							</div>
                             
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Siguiente</button>
                              <input type="hidden" id="flag" name="flag" value="1">
							</div>
                            <?php
                                }
                              // ESTE IF  ES PARA SABER SI YA SE GUARDO LA CABECERA, A PARTIR DE ACA YA SE DESPLIEGA LA TABLA DE LA ORDEN DE COMPRA
                              if($flag==1){
                            ?>
                                <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $fecha_ingreso; ?>">
							  </div>
							</div>
							<div class="control-group">
                                <label class="control-label" for="n_o">No. de egreso: </label>
                                  <div class="controls">
                                      <?php
                                        $query2 =   mysql_query("SELECT `id_egreso` FROM `egreso_productos_cabecera` ORDER BY `id_egreso` DESC LIMIT 1");
                                        $r2     =   mysql_fetch_array($query2);
                                        $id_eg  =   $r2['id_egreso'];
                                      ?>
								<input disabled type="text" class="span6 typeahead" id="n_e" name="n_e" value="<?php echo $id_eg; ?>">
							  </div><br>
                                <label class="control-label" for="n_o">No. Orden de producción: </label>
                                  <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="n_o" name="n_o" value="<?php echo $no_orden; ?>">
							  </div><br>
                                <label class="control-label" for="area">Area: </label>
                                  <div class="controls">
                                      <?php
                                        $query3 =   mysql_query("SELECT `id_area`, `descripcion_area` FROM `area` WHERE `id_area` = '$area'");
                                        $r3     =   mysql_fetch_array($query3);
                                  
                                        $name_area=$r3['descripcion_area'];
                                      ?>
								<input disabled type="text" class="span6 typeahead" id="area" name="area" value="<?php echo $name_area; ?>">
							  </div><br>
                                <label class="control-label" for="recibio">Recibio: </label>
                                  <div class="controls">
                                      <?php
                                        $query3 =   mysql_query("SELECT `id_recibido`, `descripcion_recibido` FROM `lista_bodega_recibido` WHERE `id_recibido` = $recibido");
                                        $r3     =   mysql_fetch_array($query3);
                                  
                                        $name_recibido=$r3['descripcion_recibido'];
                                      ?>
								<input disabled type="text" class="span6 typeahead" id="recibio" name="recibio" value="<?php echo $name_recibido; ?>">
							  </div><br>
							</div>
                              
            <!-- INICIA TABLA DE ORDEN DE COMPRA DENTRO DEL INGRESO ------------>
            <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>SELECCION</th>
								  <th>CODIGO</th>
                                  <th>DESCRIPCION</th>
                                  <th>CANTIDAD</th>
								  <th>COSTO</th>
                                  <th>TOTAL</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                              $query_todo   =   mysql_query("SELECT `id`,`no_orden_produccion`,`codigo`,`descripcion`,`cantidad`,`costo`,`total` FROM orden_produccion_secundario WHERE no_orden_produccion = '$no_orden'");
                              $count=0;
                              while($search=mysql_fetch_array($query_todo)){
                                  $id_selec     =   $search['id'];
                                  $codigo       =   $search['codigo'];
                                  $des          =   $search['descripcion'];
                                  $can          =   $search['cantidad'];
                                  $costo        =   $search['costo'];
                                  $total        =   $search['total'];
                                  $count        =   $count + 1;
                                  $name_cantidad=   "can" . $count;
                                  $name_total   =   "tot" . $count;
                                  $name_costo   =   "cos" . $count;
                                  $name_des     =   "des" . $count;
                                  $name_cod     =   "cod" . $count;
                                  $name_sel     =   "sel" . $count;
                                  
                          ?>
							<tr>
                                <td>
                                    <input type="checkbox" name="<?php echo "$name_sel";?>" id="<?php echo "$name_sel";?>" value="<?php echo "$id_selec";?>">
                                </td>
								<td class="center">
                                    <input disabled type="text" class="span6 typeahead" id="<?php echo "$name_cod";?>" name="<?php echo "$name_cod";?>" value="<?php echo "$codigo";?>">
                                    <input type="hidden" id="<?php echo "$name_cod";?>" name="<?php echo "$name_cod";?>" value="<?php echo "$codigo";?>">
                                </td>
								<td class="center">
                                    <span id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>"><?php echo "$des";?></span>
                                    <input type="hidden" id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>" value="<?php echo "$des";?>">
                                </td>
                                <td class="center">
                                    <input type="text" class="span6 typeahead" id="<?php echo "$name_cantidad"?>" name="<?php echo "$name_cantidad"?>" value="<?php echo $can; ?>" onkeyup="sum_tot(this.value,<?php echo "$costo";?>,'<?php echo "$name_total";?>');">
                                </td>
                                <td class="center">
                                    <span id="<?php echo "$name_costo";?>" name="<?php echo "$name_costo";?>"><?php echo "$costo";?></span>
                                    <input type="hidden" id="<?php echo "$name_costo";?>" name="<?php echo "$name_costo";?>" value="<?php echo "$costo";?>">
                                </td>
                                <td class="center">
                                    <span id="<?php echo "$name_total";?>" name="<?php echo "$name_total";?>"><?php echo "$total";?></span>
                                </td>
							</tr>
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
                <!-- FINALIZA TABLA DE ORDEN DE COMPRA DENTRO DEL INGRESO ------------>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag" name="flag" value="2">
                              <input type="hidden" id="total" name="total" value="<?php echo "$count";?>">
                              <input type="hidden" id="no_eg" name="no_eg" value="<?php echo "$id_eg";?>">
							</div>
                            <?php
                              }
                            ?>
						  </fieldset>
						</form>   

					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php }else{echo "Usuario no autorizado!";}?>
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
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
    </div>
	<div class="clearfix"></div>
	
	<?php
        require 'footer.php'
    ?>
	
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
