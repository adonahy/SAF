<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag = "no";
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
    
<?php
                $flag=$_POST['flag'];
                //inicia verificación de $_POST
                if(empty($_POST)===false){
                    
                    $id_search      =   $_POST['id_search'];
                    
                    $query1         =   mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod`,`razon`,`banco`,`cuenta`,`id_estado` FROM `ingresos_ext` WHERE id = '$id_search'");
                    $result1        =   mysql_fetch_array($query1);
                    
                    $fecha          =   $result1['fecha'];
                    $empleado       =   $result1['empleado'];
                    //$sueldo_base    =   $_POST['sueldo'];
                    //$boni_decreto   =   $_POST['boni_decreto'];
                    $boni_empresa   =   $result1['boni_empresa'];
                    $horas_extra    =   $result1['horas_extra'];
                    $boni_prod      =   $result1['boni_prod'];
                    $razon          =   $result1['razon'];
                    $banco          =   $result1['banco'];
                    $cuenta         =   $result1['cuenta'];
                    $id_estado      =   $result1['id_estado'];
                    
                    $query2         =   mysql_query("SELECT `id`,`nombre_1`,`ape_1` FROM `planillas` WHERE id = '$empleado'");
                    $result2        =   mysql_fetch_array($query2);
                    $nombre         =   $result2['nombre_1'];
                    $apellido       =   $result2['ape_1'];
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Efectuo un ingreso extraordinario, al empleado con ID: " . "$empleado por un monto de: ";
                    $t      =   "ingresos_ext";
                    
                    insert_logs($fecha, $u, $d, $t, $monto);
                    
                    //$monica =   "yes";
                }
    
    // ESTE if es el que actualiza los datos una vez modificados
    
                if(empty($_POST)===false AND $flag=="go"){
                    
                    $id_up          =   $_POST['id_up'];
                    $id_up_estado   =   $_POST['id_up_estado'];
                    $fecha          =   $_POST['date01'];
                    $empleado       =   $_POST['empleado'];
                    //$sueldo_base    =   $_POST['sueldo'];
                    //$boni_decreto   =   $_POST['boni_decreto'];
                    $boni_empresa   =   $_POST['boni_empresa'];
                    $horas_extra    =   $_POST['horas'];
                    $boni_prod      =   $_POST['boni_productividad'];
                    $razon          =   $_POST['razon'];
                    $bancotodo      =   $_POST['banco'];
                    $monto          =   $boni_empresa + $boni_prod;
                    
                    $bancotodo_length  = strlen($bancotodo);
                    $esta              = strpos("$bancotodo", "-");

                    $banco          = substr($bancotodo,0,$esta);
                    $pos            = $esta + 1;
                    $cuenta         = substr($bancotodo,$pos,$bancotodo_length);
                    
                    $query_search_estado=mysql_query("SELECT `id` FROM `estados_cuenta` ORDER BY id DESC LIMIT 1");
                    $result_search_estado=mysql_fetch_array($query_search_estado);
                    $id_estado=$result_search_estado['id']+1;
                    
                    $query      =   mysql_query("UPDATE `ingresos_ext` SET `fecha` = '$fecha', `empleado` = '$empleado', `boni_empresa` = '$boni_empresa', `horas_extra` = '$horas_extra', `boni_prod` = '$boni_prod', `razon` = '$razon', `banco` = '$banco', `cuenta` = '$cuenta' WHERE CONCAT(`ingresos_ext`.`id`) = '$id_up';");
                    
                    $query2     =   mysql_query("UPDATE `estados_cuenta` SET `fecha` = '$fecha', `concepto` = '$razon', `debito` = '$monto', `banco` = '$banco', `cuenta` = '$cuenta' WHERE CONCAT(`estados_cuenta`.`id`) = '$id_up_estado';");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Actualizo un ingreso extraordinario, al empleado con ID: " . "$empleado por un monto de: ";
                    $t      =   "ingresos_ext";
                    
                    insert_logs($fecha, $u, $d, $t, $monto);
                    
                    $monica =   "yes";
                }
            ?>

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
                $f=date("m/d/Y");
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
                    <a href="#">Contabilidad</a>
                    <i class="icon-angle-right"></i>
                    <a href="planillas.php">Planillas</a>
                    <i class="icon-angle-right"></i>
                    <a href="ingreso_e_new.php">Ingresos Extraordinarios</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingresos Extraordinarios</a>
                </li>
			</ul>
                <?php 
                    if($monica == "yes"){
                        echo "<h3>Se actualizo el ingreso con exito!</h3>";
                    }else{
                ?>
                <form class="form-horizontal" method="post" action="">
						  <fieldset>
                <h1>Ingresos Extraordinarios</h1>
                        <div class="box-content">
                            <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$fecha";?>">
							  </div><br>
                            <div class="control-group">
								<label class="control-label" for="empleado">Empleado: </label>
								<div class="controls">
								  <select name="empleado" id="empleado" data-rel="chosen">
                                      <option value="<?php echo "$empleado"?>"><?php echo "$nombre " . "$apellido";?></option>
								  </select>
								</div>
							  </div>
                                <label class="control-label" for="boni_empresa">Bonificación Empresa: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_empresa" name="boni_empresa" value="<?php echo "$boni_empresa";?>">
							  </div><br>
                                <label class="control-label" for="horas">Horas extra: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="horas" name="horas" value="<?php echo "$horas_extra";?>">
							  </div><br>     
                            <label class="control-label" for="boni_productividad">Bonificación Productividad: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_productividad" name="boni_productividad" value="<?php echo "$boni_prod";?>">
							  </div><br>
                            <label class="control-label" for="razon">Razon: </label>
								<div class="controls">
								  <select id="razon" name="razon" data-rel="chosen">
                                      <option value="<?php echo "$razon";?>"><?php echo "$razon";?></option>
                                      <option value="Planilla">Planilla</option>
                                      <option value="Bono 14">Bono 14</option>
                                      <option value="Aguinaldo">Aguinaldo</option>
								  </select>
								</div><br>
                            <div class="control-group">
								<label class="control-label" for="banco">Nombre del banco y cuenta: </label>
								<div class="controls">
								  <select id="banco" name="banco" data-rel="chosen">
                                      <option value="<?php echo "$banco" . "-" . "$cuenta";?>"><?php echo "$banco" . " - " . "$cuenta";?></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `bancos`");
                                      
                                      while($result_bancos=mysql_fetch_array($query)){
                                        $r=$result_bancos['nombre'];
                                        $r2=$result_bancos['cuenta'];  
                                    ?>
                                      <option value="<?php echo "$r";?>-<?php echo "$r2";?>"><?php echo "$r";?> - <?php echo "$r2";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                            </div><br>
                        
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag" name="flag" value="go">
                              <input type="hidden" id="id_up" name="id_up" value="<?php echo "$id_search";?>">
                              <input type="hidden" id="id_up_estado" name="id_up_estado" value="<?php echo "$id_estado";?>">
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   
<?php
                    }
?>
					</div>

	
			<!-- TERMINA: CONTENIDO ************************************************************** -->
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
	
	<div class="clearfix"></div>
	
	<?php
        require 'footer.php';
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
