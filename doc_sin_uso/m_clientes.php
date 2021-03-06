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
    
    <?php
                
                if(empty($_POST)===false){
                    $fecha                 =    $_POST['date01'];
                    $nombre_comercial      =    $_POST['n_comercial'];
                    $nombre_fiscal         =    $_POST['n_fiscal'];
                    $codigo                =    $_POST['codigo'];
                    $nit                   =    $_POST['nit'];
                    $direccion_entrega     =    $_POST['d_entrega'];
                    $direccion_transporte  =    $_POST['d_transporte'];
                    $direccion_fiscal      =    $_POST['d_fiscal'];
                    $correo                =    $_POST['correo'];
                    $tel                   =    $_POST['tel'];
                    $nombre_contacto       =    $_POST['n_contacto'];
                    $telefono_contacto     =    $_POST['tel_contacto'];
                    $correo_contacto       =    $_POST['correo_contacto'];
                    $fecha_cumple_contacto =    $_POST['date02'];
                    $credito               =    $_POST['credito'];
                    
                    $query2 = mysql_query("SELECT `id_vendedor`,`id_user` FROM `vendedores` WHERE id_user = '$u'");
                    $r2     = mysql_fetch_array($query2);
                    $id_vendedor= $r2['id_vendedor'];
            
                    $query      =   mysql_query("INSERT INTO `clientes` (`fecha`, `nombre_comercial`, `nombre_fiscal`, `codigo`, `nit`, `direccion_fiscal`, `direccion_entrega`, `direccion_transporte`, `correo`, `tel`, `nombre_contacto`, `telefono_contacto`, `correo_contacto`, `fecha_cumple_contacto`, `credito`,`id_vendedor`) VALUES ('$fecha', '$nombre_comercial', '$nombre_fiscal', '$codigo', '$nit', '$direccion_fiscal','$direccion_entrega', '$direccion_transporte', '$correo', '$tel', '$nombre_contacto', '$telefono_contacto', '$correo_contacto', '$fecha_cumple_contacto','$credito','$id_vendedor')");
                    
                    $fecha  =   date("m/d/Y");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Ingreso un nuevo cliente a la base de dato: ";
                    $t      =   "clientes";
            
                    insert_logs($fecha, $u, $d, $t, $nombre_fiscal);
                    
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
                    <a href="manto_clientes.php">Mantenimiento de Clientes</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ficha de clientes</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                    if($monica=="yes"){
                        echo "<h3>Cliente ingresado exitosamente!</h3>";
                    }
                ?>
                <h1>Ficha de Clientes</h1>
                					<div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$da";?>">
							  </div>
							
                                 <label class="control-label" for="n_comercial">Nombre Completo: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="n_comercial" name="n_comercial">
							  </div>
                              <label class="control-label" for="nit">NIT: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nit" name="nit">
							  </div>
                             <?php 
                                $query1 =   mysql_query("SELECT `codigo` FROM `clientes` ORDER BY codigo DESC LIMIT 1");
                                $r1     =   mysql_fetch_array($query1);
                                $cod    =   $r1['codigo'] + 1;
                              ?>
                                   <label class="control-label" for="codigo">Código: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="codigo" name="codigo" value="<?php echo"$cod";?>">
							  </div>
                                  
                               	<label class="control-label" for="correo">Correo: </label>
								 <div class="controls">
								<input type="text" class="span6 typeahead" id="correo" name="correo" >
							  </div>
                                   <label class="control-label" for="tel">Teléfono: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="tel" name="tel" >
							  </div>
                              
                             <label class="control-label" for="date02">Fecha cumpleaños contacto:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo "$da";?>">
							  </div><br>    
                             
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
       <?php }else{echo "Usuario no autoriado!";}?>
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
