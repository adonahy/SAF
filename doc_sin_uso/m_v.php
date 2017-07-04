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
                    <a href="#">Ventas</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_vendedores.php">Mantenimiento de vendedores</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Asignación de vendedores</a>
                </li>
			</ul>
                <?php
                if(empty($_POST)===false && $_POST['flag']=="save"){
                        $nombre         =   $_POST['nombre'];
                        $fecha_cumple   =   $_POST['date02'];
                        $fecha_ingreso  =   $_POST['date01'];
                        $telefono       =   $_POST['tel'];
                        $dir            =   $_POST['dir'];
                        $correo         =   $_POST['correo'];
                        $user           =   $_POST['usuar'];
                    
                        $u          =   $_SESSION['u'];
                        $d          =   "Ingreso un nuevo vendedor: ";
                        $t          =   "vendedores";
                        
                        $query=mysql_query("INSERT INTO `vendedores` (`id_vendedor`, `nombre_vendedor`, `fecha_cumple`, `fecha_ingreso`, `telefono`, `direccion`, `correo`, `id_user`) VALUES ('', '$nombre', '$fecha_cumple', '$fecha_ingreso', '$telefono', '$dir', '$correo', '$user')");
                        
                        insert_logs($da, $u, $d, $t, $nombre);
                        echo "<h3>Nuevo vendedor ingresado con éxito!</h3>";
                    }
                if($security == 'go'){
                ?>
                <h1>Ingreso de vendedores</h1>
                <div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							<div class="control-group">
                                 <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$da";?>">
							  </div>
							
                                 <label class="control-label" for="nombre">Nombre: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nombre" name="nombre">
							  </div>
                               <label class="control-label" for="tel">Teléfono: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="tel" name="tel" >
							  </div>
                                <label class="control-label" for="date02">Fecha cumpleaños:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo "$da";?>">
							  </div>
                                   <label class="control-label" for="dir">Dirección: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="dir" name="dir">
							  </div>
                                   <label class="control-label" for="correo">Correo: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="correo" name="correo" >
							  </div>
                                <label class="control-label" for="usuar">Usuario: </label>
                                <div class="controls">
								  <select id="usuar" name="usuar" data-rel="chosen">
                                    <?php
                                      $query=mysql_query("SELECT * FROM `users`");
                                      
                                      while($result_usuarios=mysql_fetch_array($query)){
                                        $r=$result_usuarios['user'];
                                    ?>
                                      <option value="<?php echo "$r";?>"><?php echo "$r";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag" name="flag" value="save">
							</div>
						  </fieldset>
						</form>   

					</div>
                <?php }else{?>
                    Usuario no registrado!
                <?php } ?>
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
	
	<?php require 'footer.php' ?>
	
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
