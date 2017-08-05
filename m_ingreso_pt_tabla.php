<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
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
                    <a href="#">Bodega</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_bodega_pt.php">Mantenimiento de Ingreso Producto Terminado</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso Producto Terminado</a>
                </li>
			</ul>
                <?php
                if(empty($_POST)===false){
                            $flag1  =   $_POST['flag1'];
                            if($flag1==""){
                                $flag="no";
                        }
                }
                
                if(empty($_POST)===false){
                        $fecha      =   $_POST['date01'];
                        $no_ingreso =   $_POST['ingreso'];
                        $no_orden   =   $_POST['orden'];
                        $area       =   $_POST['area'];
                        $recibio    =   $_POST['recibio'];
                        $u          =   "Usuario Registrado";
                        $d          =   "Ingreso producto terminado: ";
                        $t          =   "bodega_ingreso_pt";
                        
                        $query2     =   mysql_query("INSERT INTO `bodega_ingreso_pt` (`id`,`fecha`,`no_orden`,`area`,`recibio`) VALUES (NULL,'$fecha','$no_orden','$area','$recibio')");
                        
                        //$query=mysql_query("INSERT INTO `inventario_central` (`codigo`,`descripcion`, `unidad_medida`) VALUES (NULL, '$des', '$unidad')");
                        
                        insert_logs($da, $u, $d, $t, $no_orden);
                        echo "<h3>Ingreso realizado con éxito!</h3>";
                }
                    
                ?>
                <h1>Ingreso Producto Terminado</h1>
                    <div class="box-content">
						<form class="form-horizontal" method="post" action="m_ingreso_pt_tabla2.php">
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $fecha; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="ingreso">No. Ingreso: </label>
                                  <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="ingreso" name="ingreso" value="<?php echo "$no_ingreso";?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <label class="control-label" for="orden">No. Orden de trabajo: </label>
                                  <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="orden" name="orden" value="<?php echo $no_orden; ?>">
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <div class="control-group">
								<label class="control-label" for="area">Area: </label>
								<div class="controls">
								  <select disabled id="area" name="area" data-rel="chosen">
                                      <?php
                                        $query4 =   mysql_query("SELECT `id_area`,`descripcion_area` FROM area WHERE id_area = '$area' ORDER BY id_area DESC");
                                        $result4    =   mysql_fetch_array($query4);
                                      
                                        $area_name  =   $result4['descripcion_area'];
                                        
                                      ?>
                                      <option value="<?php echo "$area";?>"><?php echo "$area_name";?></option>
                                      <?php
                                        $query3 = mysql_query("SELECT `id_area`,`descripcion_area` FROM area ORDER BY id_area DESC");
                                      
                                        while($result2=mysql_fetch_array($query3)){
                                            
                                            $id     =   $result2['id_area'];
                                            $des    =   $result2['descripcion_area'];
                                      ?>
                                            <option value="<?php echo "$id";?>"><?php echo "$des";?></option>
								      <?php
                                        }
                                      ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="recibio">Recibio: </label>
								<div class="controls">
								  <select disabled id="recibio" name="recibio" data-rel="chosen">
                                      <?php
                                        $query5 =   mysql_query("SELECT `id_recibido`,`descripcion_recibido` FROM lista_bodega_recibido WHERE id_recibido = '$recibio' ORDER BY id_recibido DESC");
                                        $result5    =   mysql_fetch_array($query5);
                                      
                                        $recibio_name  =   $result5['descripcion_recibido'];
                                        
                                      ?>
                                      <option value="<?php echo "$recibio";?>"><?php echo "$recibio_name";?></option>
                                      <?php
                                        $query3 = mysql_query("SELECT `id_recibido`,`descripcion_recibido` FROM lista_bodega_recibido ORDER BY id_recibido DESC");
                                      
                                        while($result2=mysql_fetch_array($query3)){
                                            
                                            $id     =   $result2['id_recibido'];
                                            $des    =   $result2['descripcion_recibido'];
                                      ?>
                                            <option value="<?php echo "$id";?>"><?php echo "$des";?></option>
								      <?php
                                        }
                                      ?>
								  </select>
								</div>
							  </div>
                   
							</div>
                <div class="row-fluid sortable">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Orden de trabajo: <?php echo "$no_orden";?></h2>
						
					</div>
                    <?php
                        $query6     =   mysql_query("SELECT `id`,`no_orden_trabajo`,`codigo`,`cantidad` FROM `orden_produccion_secundario` WHERE `no_orden_trabajo` = '$no_orden'");
                    ?>
					<div class="box-content">
						<table class="table table-striped">
							  <thead>
								  <tr>
									  <th>CONSERVAR</th>
                                      <th>CODIGO</th>
									  <th>DESCRIPCION</th>
									  <th>CANTIDAD</th>
									  <th>COSTO</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
                                  <?php
                                    $ctotal = 0;
                                    while($result6=mysql_fetch_array($query6)){
                                        $codigo_tabla   =   $result6['codigo'];
                                        $id_tabla       =   $result6['id'];
                                        $query7         =   mysql_query("SELECT `codigo`,`descripcion`,`costoxunidad` FROM `inventario_central` WHERE codigo='$codigo_tabla'");
                                        $result7        =   mysql_fetch_array($query7);
                                        $des_tabla      =   $result7['descripcion'];
                                        $cantidad_tabla =   $result6['cantidad'];
                                        $costo_tabla    =   $result7['costoxunidad'];
                                        $costo_tabla    =   $costo_tabla * $cantidad_tabla;
                                        $ctotal         =   $ctotal + $costo_tabla;
                                        $costo_tabla    =   "Q" . number_format("$costo_tabla",2);
                                        $name_check     =   "c" . $id_tabla;
                                        
                                  ?>
								<tr>
                                    <td class="center">
                                        <input type="checkbox" name="<?php echo "$name_check";?>" value="<?php echo"$id_tabla";?>">
                                        <br>
                                    </td>
									<td class="center"><?php echo "$codigo_tabla";?></td>
									<td class="center"><?php echo "$des_tabla";?></td>
									<td class="center"><?php echo "$cantidad_tabla";?></td>
									<td class="center"><?php echo "$costo_tabla";?></td>                                    
								</tr>     
                                <?php
                                    }
                                  $ctotal    =   "Q" . number_format("$ctotal",2);
                                  
                                ?>
                                  <tr>
                                    <td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
                                      <td class="center"><b>TOTAL</b></td>
									<td class="center"><b><?php echo "$ctotal";?></b></td>                                
								</tr>
							  </tbody>
						 </table>      
					</div>
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
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag1" name="flag1" value="guardar">
                                <input type="hidden" id="orden" name="orden" value="<?php echo "$no_orden";?>">
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>   

					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
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
	
	<footer>
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
