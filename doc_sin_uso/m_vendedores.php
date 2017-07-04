<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $flag   =   "";
    error_reporting(0);
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
    if($_POST['flag']==="save"){
        $id             =   $_POST['cod'];
        $nombre         =   $_POST['nombre'];
        $fecha_cumple   =   $_POST['date02'];
        $telefono       =   $_POST['tel'];
        $dir            =   $_POST['dir'];
        $correo         =   $_POST['correo'];
        
        $query1 =   mysql_query("UPDATE `vendedores` SET `nombre_vendedor` = '$nombre', `fecha_cumple` = '$fecha_cumple', `telefono` = '$telefono', `direccion` = '$dir', `correo` = '$correo' WHERE `vendedores`.`id_vendedor` = $id");
        $flag   =   "aviso";
        
        $u      =   $_SESSION['u'];
        $d      =   "Edito el vendedor: ";
        $t      =   "vendedores";
            
        insert_logs($da, $u, $d, $t, $nombre);
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
                    <a href="manto_vendedores.php">Mantenimiento de vendedores</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Edición de vendedores</a>
                </li>
			</ul>
                <?php
                    //echo $mayoreo;
                if($security == 'go'){
                    if($flag=="aviso"){
                        echo "<b>Vendedor editado con éxito!</b>";
                    }else{
                        $id     =   $_POST['cod'];
                        $query2 =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`fecha_cumple`,`fecha_ingreso`,`telefono`,`direccion`,`correo` FROM `vendedores` WHERE id_vendedor = '$id'");
                        $r2     =   mysql_fetch_array($query2);
                        
                        $n1     =   $r2['nombre_vendedor'];
                        $n2     =   $r2['fecha_cumple'];
                        $n3     =   $r2['fecha_ingreso'];
                        $n4     =   $r2['telefono'];
                        $n5     =   $r2['direccion'];
                        $n6     =   $r2['correo'];
                ?>
                <h1>Edición de vendedores</h1>
                <div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							<div class="control-group">
                                 <label class="control-label" for="date01">Fecha ingreso:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$n3";?>">
							  </div>
							
                                 <label class="control-label" for="nombre">Nombre: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nombre" name="nombre" value="<?php echo "$n1";?>">
							  </div>
                               <label class="control-label" for="tel">Teléfono: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="tel" name="tel" value="<?php echo "$n4";?>">
							  </div>
                                <label class="control-label" for="date02">Fecha cumpleaños:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo "$n2";?>">
							  </div>
                                   <label class="control-label" for="dir">Dirección: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="dir" name="dir" value="<?php echo "$n5";?>">
							  </div>
                                   <label class="control-label" for="correo">Correo: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="correo" name="correo" value="<?php echo "$n6";?>">
							  </div>
							</div>
                              
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag" name="flag" value="save">
                                <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>">
							</div>
						  </fieldset>
						</form>   

					</div>
       <?php }
                }else{?>
                    Usuario no registrado!
                <?php } ?>
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
