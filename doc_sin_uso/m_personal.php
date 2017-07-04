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
			<?php
                if(empty($_POST)===false){
                    $nombre_1           =   $_POST['nombre1'];
                    $nombre_2           =   $_POST['nombre2'];
                    $ape_1              =   $_POST['ape1'];
                    $ape_2              =   $_POST['ape2'];
                    $cedula             =   $_POST['cedula'];
                    $registro           =   $_POST['registro'];
                    $dpi                =   $_POST['dpi'];
                    $nit                =   $_POST['nit'];
                    $originario         =   $_POST['originario'];
                    $departamento       =   $_POST['depto'];
                    $fecha_nacimiento   =   $_POST['fecha_nac'];
                    $estado_civil       =   $_POST['estado_civil'];
                    $vivienda           =   $_POST['vivienda'];
                    $telefono_movil     =   $_POST['tel_movil'];
                    $emergencia_avisar  =   $_POST['avisar'];
                    $telefono_avisar    =   $_POST['telefono_avisar'];
                    $notas_emergencia   =   $_POST['notas_emergencia'];
                    $empresa            =   $_POST['empresa'];
                    $cargo              =   $_POST['cargo'];
                    $fecha_ingreso      =   $_POST['fecha_ing'];
                    $fecha_egreso       =   $_POST['fecha_eg'];
                    $sueldo_base        =   $_POST['sueldo'];
                    $boni_decreto       =   $_POST['boni_decreto'];
                    $boni_empresa       =   $_POST['boni_empresa'];
                    $otros              =   $_POST['boni_otros'];
                    $af_igss            =   $_POST['af_igss'];
                    $af_irtra           =   $_POST['af_irtra'];
                    $direccion_igss     =   $_POST['cert_igss'];
                    $fecha_re           =   $_POST['fecha_re'];
                    $nota_igss_irtra    =   $_POST['nota_igss_irtra'];
                    $estatus            =   $_POST['estatus'];
                        
                    $query  =   mysql_query("INSERT INTO `planillas` (`id`, `nombre_1`, `nombre_2`, `ape_1`, `ape_2`, `cedula`, `registro`, `dpi`, `nit`, `originario`, `departamento`, `fecha_nacimiento`, `estado_civil`, `vivienda`, `telefono_movil`, `emergencia_avisar`, `telefono_emergencia`, `notas_emergencia`, `compania`, `cargo`, `fecha_ingreso`, `fecha_egreso`, `sueldo_base`, `boni_decreto`, `boni_empresa`, `otros`, `af_igss`, `af_irtra`, `direccion_igss`, `fecha_re`, `nota_igss_irtra`, `estatus`) VALUES (NULL, '$nombre_1', '$nombre_2', '$ape_1', '$ape_2', '$cedula', '$registro', '$dpi', '$nit', '$originario', '$departamento', '$fecha_nacimiento', '$estado_civil', '$vivienda', '$telefono_movil', '$emergencia_avisar', '$telefono_avisar', '$notas_emergencia', '$empresa', '$cargo', '$fecha_ingreso', '$fecha_egreso', '$sueldo_base', '$boni_decreto', '$boni_empresa', '$otros', '$af_igss', '$af_irtra', '$direccion_igss', '$fecha_re', '$nota_igss_irtra', '$estatus')");
                    
                $u      =   "Usuario Registrado";
                $d      =   "Ingreso el personal: ";
                $t      =   "planillas";
                $u_e    =   $nombre_1 . " " . $ape_1;
                insert_logs($f, $u, $d, $t, $u_e);
            
                $monica = "yes";
                }
            ?>
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
                    <a href="#">Ingreso de personal</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                    $id     =   new_id();
                ?>
                <h1>Ficha de personal</h1>
                    <div class="box-content">
						<form class="form-horizontal" action="" method="post">
						  <fieldset>
                              <?php 
                                    if($monica == "yes"){
                                        echo "<h3>Personal ingresado!</h3>";
                                    }
                              ?>
                              <div class="control-group">
                              <label class="control-label" for="ide">Id: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="ide" name="ide" value="<?php echo "$id"; ?>">
							  </div><br>
                              <label class="control-label" for="nombre1">1er Nombre: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nombre1" name="nombre1" >
							  </div><br>
                               <label class="control-label" for="nombre2">2do Nombre: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nombre2" name="nombre2" >
							  </div><br>
                                 <label class="control-label" for="ape1">1er Apellido: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="ape1" name="ape1">
							  </div><br>
                                 <label class="control-label" for="ape2">2do Apellido: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="ape2" name="ape2" >
							  </div><br>
                    <h2>Identificación:</h2>
                               <label class="control-label" for="cedula">No. de cedula: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="cedula" name="cedula" >
							  </div><br>
                                 <label class="control-label" for="registro">No. de registro: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="registro" name="registro"  >
							  </div><br>
                                 <label class="control-label" for="dpi">No. DPI: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="dpi" name="dpi"  >
							  </div><br>
                                 <label class="control-label" for="nit">NIT: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nit" name="nit" >
							  </div><br>
                    <h2>Nacionalidad:</h2>
                               <label class="control-label" for="originario">Originario de: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="originario" name="originario" >
							  </div><br>
                                 <label class="control-label" for="depto">Departamento: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="depto" name="depto" >
							  </div><br>
                                 
							  <label class="control-label" for="fecha_nac">Fecha Nacimiento:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_nac" name="fecha_nac" value="<?php echo "$f";?>">
							  </div>
							
                                 <label class="control-label" for="estado_civil">Estado Civil: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="estado_civil" name="estado_civil"  >
							  </div>
                    <h2>Dirección:</h2>
                               <label class="control-label" for="vivienda">Vivienda: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="vivienda" name="vivienda"  >
							  </div><br>
                                   <label class="control-label" for="tel_movil">Telefono Movil: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="tel_movil" name="tel_movil" >
							  </div><br>
                                   <label class="control-label" for="avisar">En caso de emergencia avisar a: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="avisar" name="avisar"  >
							  </div><br>
                                   <label class="control-label" for="telefono_avisar">Telefono: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="telefono_avisar" name="telefono_avisar" >
							  </div><br>
                                <label class="control-label" for="notas_emergencia">Notas: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="notas_emergencia" name="notas_emergencia">
							  </div><br>
                    <h2>Empresa:</h2>
                               	<label class="control-label" for="empresa">Compañia: </label>
								<div class="controls">
								  <select id="empresa" name="empresa" data-rel="chosen">
                                      <option value="Industrias LH">Industrias LH</option>
								  </select>
								</div><br>
                                   <label class="control-label" for="cargo">Cargo: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="cargo" name="cargo"  >
							  </div><br>
                                   <label class="control-label" for="fecha_ing">Fecha de Ingreso:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_ing" name="fecha_ing" value="<?php echo "$f"?>">
							  </div><br>
                                  <label class="control-label" for="fecha_eg">Fecha de Egreso:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_eg" name="fecha_eg" value="">
							  </div><br>
                    <h2>Salarios:</h2>
                               <label class="control-label" for="sueldo">Sueldo Base: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="sueldo" name="sueldo" >
							  </div><br>
                                   <label class="control-label" for="boni_decreto">Bonificación Decreto: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_decreto" name="boni_decreto" >
							  </div><br>
                                   <label class="control-label" for="boni_empresa">Bonificación Empresa: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_empresa" name="boni_empresa"  >
							  </div><br>
                                   <label class="control-label" for="boni_otros">Otros: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="boni_otros" name="boni_otros"  >
							  </div><br>
                    <h2>IGSS e IRTRA</h2>
                                <label class="control-label" for="af_igss">No. de Afiliación IGSS: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="af_igss" name="af_igss" >
							  </div><br>
                                  <label class="control-label" for="af_irtra">No. de Afiliación IRTRA: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="af_irtra" name="af_irtra" >
							  </div><br>
                                  <label class="control-label" for="cert_igss">Direccion Para Certificado IGSS: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="cert_igss" name="cert_igss"  >
							  </div><br>
                                  <label class="control-label" for="fecha_re">Fecha de Recontratación:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="fecha_re" name="fecha_re" value="">
							  </div><br>
                                  <label class="control-label" for="nota_igss_irtra">Nota: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nota_igss_irtra" name="nota_igss_irtra" >
							  </div><br>
                    <h2>Estatus de Empleado:</h2>
                                  <label class="control-label" for="estatus">Empleado Activo: </label>
                                <div class="controls">
								  <select id="estatus" name="estatus" data-rel="chosen">
                                      <option value="1">ACTIVO</option>
                                      <option value="0">INACTIVO</option>
								  </select>
								</div><br>
                                     </div><br>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
       <?php }else{
                    echo "Usuario no autorizado!";
                }
                ?>
	</div><!--/.fluid-container-->
	
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
