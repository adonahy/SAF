<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>SAF</title>
	<meta name="description" content="SAF">
	<meta name="author" content="Mariles Rustrian">
	
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	
		
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
				<a class="brand" href="index.php"><span>SAF</span></a>
								
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
				<?php
                //inicia verificación de $_POST
                if(empty($_POST)===false){
                    
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
                    
                    $query2     =   mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES ('NULL', '$fecha', '', '$razon', '', '$monto', '', '$banco','$cuenta')");
                    
                    $query_search_estado=mysql_query("SELECT `id` FROM `estados_cuenta` ORDER BY id DESC LIMIT 1");
                    $result_search_estado=mysql_fetch_array($query_search_estado);
                    $id_estado=$result_search_estado['id'];
                    
                    $query      =   mysql_query("INSERT INTO `ingresos_ext` (`id`, `fecha`, `empleado`, `sueldo_base`, `boni_decreto`, `boni_empresa`, `horas_extra`, `boni_prod`, `razon`, `banco`, `cuenta`, `id_estado`) VALUES (NULL, '$fecha', '$empleado', '', '', '$boni_empresa', '$horas_extra', '$boni_prod', '$razon', '$banco', '$cuenta', '$id_estado')");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Efectuo un ingreso extraordinario, al empleado con ID: " . "$empleado por un monto de: ";
                    $t      =   "ingresos_ext";
                    
                    insert_logs($fecha, $u, $d, $t, $monto);
                    
                    $monica =   "yes";
                }
            ?>
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
                if($security == 'go'){
                    if($monica == "yes"){
                        echo "<h3>Actividad realizada con exito!</h3>";
                    }
                ?>
                <form class="form-horizontal" method="post" action="">
						  <fieldset>
                              
                              <?php  
                              
                    $query_p    =   mysql_query("SELECT `id`,`sueldo_base`,`estatus` FROM `planillas` WHERE estatus = '1'");
                    
                    $qp         =   mysql_fetch_array($query_p);
                    
                    $sueldo_base=   $qp['sueldo_base'];
                              
                              
                              
                              ?>
                <h1>Ingresos Extraordinarios</h1>
                        <div class="box-content">
                            <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$f";?>">
							  </div><br>
                            <div class="control-group">
								<label class="control-label" for="empleado">Empleado: </label>
								<div class="controls">
								  <select name="empleado" id="empleado" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT `id`,`nombre_1`,`ape_1`,`estatus` FROM `planillas` WHERE estatus = '1'");
                                      
                                      while($result_planillas=mysql_fetch_array($query)){
                                        $nombre=$result_planillas['nombre_1'];
                                        $apellido=$result_planillas['ape_1'];
                                        $id=$result_planillas['id'];
                                    ?>
                                      <option value="<?php echo "$id"?>"><?php echo "$nombre " . "$apellido";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                            <label class="control-label" for="boni_empresa">Sueldo: </label>
                                  <div class="controls">
                                      <span><?php echo "$sueldo_base";  ?></span>
								<input type="hidden" class="span6 typeahead" id="boni_empresa" name="boni_empresa" >
							  </div><br>
                                <label class="control-label" for="boni_empresa">Bonificación Empresa: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_empresa" name="boni_empresa" >
							  </div><br>
                                <label class="control-label" for="horas">Horas extra: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="horas" name="horas" >
							  </div><br>     
                            <label class="control-label" for="boni_productividad">Bonificación Productividad: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_productividad" name="boni_productividad" >
							  </div><br>
                            <label class="control-label" for="razon">Razon: </label>
								<div class="controls">
								  <select id="razon" name="razon" data-rel="chosen">
                                      <option>Planilla</option>
                                      <option>Bono 14</option>
                                      <option>Aguinaldo</option>
								  </select>
								</div><br>
                            <div class="control-group">
								<label class="control-label" for="banco">Nombre del banco y cuenta: </label>
								<div class="controls">
								  <select id="banco" name="banco" data-rel="chosen">
                                      <option value=""></option>
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
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   
<?php 
                }else{
                    echo "Usuario no autorizado!";
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
