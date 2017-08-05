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
              ?>
			<!-- end: MAIN MENU ****************************************************** -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Advertencia!</h4>
					<p>Necesitas tener <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> habilitado en tu computadora!.</p>
				</div>
			</noscript>
			
			<!-- INICIA: CONTENIDO ****************************************************** --->
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
                
                if($security == 'go'){
                if(empty($_POST)===false){
                        $no_orden   =   $_POST['orden'];
                        
                        $query8     =   mysql_query("SELECT count(`id`) FROM `orden_produccion_secundario` WHERE no_orden_trabajo = '$no_orden' ");
                        $result8    =   mysql_fetch_array($query8);
                        $cantidad   =   $result8['count(`id`)'];
                        
                            $query9 =   mysql_query("SELECT `id`,`no_orden_trabajo` FROM `orden_produccion_secundario` WHERE no_orden_trabajo ='$no_orden'");
                            while($r9=mysql_fetch_array($query9)){
                                $v  =   "c" . $r9['id'];
                                $d  =   $_POST["$v"];
                                if($d>0){
                                    //echo "Se Guardara: $v";
                                    $query10    =   mysql_query("SELECT `id`,`codigo`,`cantidad` FROM `orden_produccion_secundario` WHERE id = '$d'");
                                    $result10   =   mysql_fetch_array($query10);
                                    
                                    $c_sumar    =   $result10['cantidad'];
                                    $c_codigo   =   $result10['codigo'];
                                    
                                    $query11    =   mysql_query("SELECT `codigo`,`cantidad`,`descripcion` FROM `inventario_central` WHERE codigo = '$c_codigo'");
                                    $result11   =   mysql_fetch_array($query11);
                                    $cantidad_old=  $result11['cantidad'];
                                    $c_new      =   $c_sumar + $cantidad_old;
                                    $des        =   $result11['descripcion'];
                                    
                                    $query12    =   mysql_query("UPDATE `inventario_central` SET `cantidad` = '$c_new' WHERE CONCAT(`inventario_central`.`codigo`) = '$c_codigo'");
                                        
                                    echo    "<h3>Se sumo la cantidad de: $c_sumar al producto: $des</h3><br>";
                                    $query14=mysql_query("SELECT `id_kardex`,`codigo`,`saldo` FROM `kardex_pt` WHERE codigo = '$c_codigo' ORDER BY `id_kardex` DESC");
                                    $result14=mysql_fetch_array($query14);
                                    $saldo = $result14['saldo'] + $c_sumar;
                                    
                                    $query13=mysql_query("INSERT INTO `kardex_pt` (`id_kardex`, `fecha`, `codigo`, `observaciones`, `debe`, `haber`, `saldo`) VALUES (NULL, '$da', '$c_codigo', 'Se añadio producto', '0', '$c_sumar', '$saldo')");
                                    
                                }else{
                                    //echo "Se Eliminara: $v";
                                    echo "No se añadieron ciertos productos de la orden de producción!";
                                }
                                
                            }
                }
                     
                    /*
                        $u          =   "Usuario Registrado";
                        $d          =   "Ingreso producto terminado: ";
                        $t          =   "bodega_ingreso_pt";
                        
                        $query2     =   mysql_query("UPDATE `orden_produccion` SET `cantidad` = '22.00' WHERE CONCAT(`orden_produccion`.`id`) = '1';)");
                        //$query=mysql_query("INSERT INTO `inventario_central` (`codigo`,`descripcion`, `unidad_medida`) VALUES (NULL, '$des', '$unidad')");
                        
                        insert_logs($da, $u, $d, $t, $no_orden);
                        //echo "<h3>Ingreso realizado con éxito!</h3>";*/
                
                    
                ?>
               
               <!-- <h1>Ingreso Producto Terminado</h1>
                    
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
