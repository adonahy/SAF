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
                    <a href="#">Compras</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_proveedores.php">Mantenimiento de proveedores</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de nuevo proveedor</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                if(empty($_POST)===false){
                        $fecha              =   $_POST['date01'];
                        $nombre_proveedor   =   $_POST['n_p'];
                        $direccion          =   $_POST['dir'];
                        $nit                =   $_POST['nit'];
                        $correo             =   $_POST['c_e'];
                        $contacto           =   $_POST['contacto'];
                        $tel_proveedor      =   $_POST['no_tel_proveedor'];
                        $tel_contacto       =   $_POST['no_tel_contacto'];
                        $limite             =   $_POST['limite'];
                        $dias               =   $_POST['dias_credito'];
                    
                        //$u          =   "Usuario Registrado";
                        $d          =   "Agrego un nuevo proveedor: ";
                        $t          =   "proveedores";
                    
                    $query1 =   mysql_query("SELECT `id_proveedor` FROM `proveedores` ORDER BY id_proveedor DESC LIMIT 1");
                    $r1     =   mysql_fetch_array($query1);
                    $id_prov=   $r1['id_proveedor'] + 1;
                        
                        $query=mysql_query("INSERT INTO `proveedores` (`id_proveedor`, `fecha_creacion`, `nombre_proveedor`, `direccion`, `nit`, `correo`, `contacto`, `no_telefono_proveedor`, `no_telefono_contacto`, `limite_credito`, `dias_credito`) VALUES ('$id_prov', '$fecha', '$nombre_proveedor', '$direccion', '$nit', '$correo', '$contacto', '$tel_proveedor', '$tel_contacto', '$limite', '$dias')");
                        
                        insert_logs($da, $u, $d, $t, $nombre_proveedor);
                        echo "<h3>Proveedor ingresado con éxito!</h3>";
                    }
                    
                ?>
                <h1>Mantenimiento de proveedores</h1>
                    <div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
							</div>
							<div class="control-group">
                                <label class="control-label" for="n_p">Nombre Proveedor: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="n_p" name="n_p" >
							
							  </div><br>
                                
							  </div><br>
                                <label class="control-label" for="c_e">Correo Electronico: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="c_e" name="c_e" >
							
							  </div><br>
                                <label class="control-label" for="contacto">Contacto: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="contacto" name="contacto">
								
							  </div><br>
                                <label class="control-label" for="no_tel_proveedor">No. teléfono proveedor: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="no_tel_proveedor" name="no_tel_proveedor">
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
               <?php }else{echo "Usuario no autorizado!";} ?>
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
	
<?php require 'footer.php'; ?>
	
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
