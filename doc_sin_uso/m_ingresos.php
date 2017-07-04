<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ILH System</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
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
                    $f1 = 0;
                    if(empty($_POST)===false){
                    $fecha      = $_POST['date01'];
                    $bancotodo  = $_POST['banco'];
                    $cliente    = $_POST['cliente_a'];
                    $no_d       = $_POST['no_depo'];
                    $monto_b    = $_POST['monto'];
                    $razon      = $_POST['razon'];
                    $ob         = $_POST['ob'];
                    $u          = "Usuario registrado";
                    $d          = "Ingreso el monto de: " . $monto_b . " al banco: ";
                    $t          = "ingreso_bancos";
                    
                    $bancotodo_length  = strlen($bancotodo);
                    $esta              = strpos("$bancotodo", "-");

                    $banco          = substr($bancotodo,0,$esta);
                    $pos            = $esta + 1;
                    $cuenta         = substr($bancotodo,$pos,$bancotodo_length);
                        
                    $estado_b       = mysql_query("SELECT * FROM `estados_cuenta` ORDER BY fecha, id DESC LIMIT 1");
                    $result_estado  = mysql_fetch_array($estado_b);
                    $estado         = $result_estado['saldo'];
                    $s              = $estado + $monto_b;
                    
                    $query      = mysql_query("INSERT INTO `ingreso_bancos` (`id`, `fecha`, `banco`, `cuenta`, `cliente_afectado`, `no_deposito`, `monto`, `razon`, `observaciones`) VALUES (NULL, '$fecha', '$banco', '$cuenta', '$cliente', '$no_d', '$monto_b', '$razon', '$ob');");
                    $query2     = mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES ('NULL', '$fecha', '$no_d', '$razon', '$monto_b', '', '$s', '$banco','$cuenta')");
                    insert_logs($fecha, $u, $d, $t, $bancotodo);
                        
                    $f1 = "1";
                    }
                    
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
                    <a href="bancos.php">Bancos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingresos</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                    if ($f1>0){
                        echo "<h3>Ingreso guardado!</h3>";
                    }
                ?>
                <h1>Ingresos a Bancos</h1>
                					<div class="box-content">
						<form class="form-horizontal" method="post" action="">
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $f?>">
							  </div>
							</div>
							<div class="control-group">
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
                             <div class="control-group">
								<label class="control-label" for="cliente_a">Cliente: </label>
								<div class="controls">
								  <select id="cliente_a" name="cliente_a" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `clientes`");
                                      
                                      while($result_clientes=mysql_fetch_array($query)){
                                        $r_nombre=$result_clientes['nombre_fiscal'];
                                        $r_codigo=$result_clientes['codigo'];
                                    ?>
                                      <option value="<?php echo "$r_codigo";?>"><?php echo "$r_nombre";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                                 <label class="control-label" for="no_depo">Número de depósito: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="no_depo" name="no_depo" data-provide="typeahead" placeholder="Ingresar el número de depósito..." >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <label class="control-label" for="monto">Monto: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="No ingresar moneda, solo el monto..." >
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                                <div class="control-group">
								<label class="control-label" for="razon">Razón: </label>
								<div class="controls">
								  <select id="razon" name="razon" data-rel="chosen">
                                      <option value="Transferencia">Transferencia</option>
                                      <option value="Deposito">Deposito</option>
                                      <option value="Nota de Credito">Nota de Credito</option>
								  </select>
								</div>
							  </div>
                            <div class="control-group hidden-phone">
							  <label class="control-label" for="ob">Observaciones del ingreso: </label>
							  <div class="controls">
								<textarea class="cleditor2" id="ob" name="ob" rows="3"></textarea>
							  </div>
							</div>
                                
							</div>
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
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 <a href="http://e-technologyca.com" alt="ILH">E-Technology C.A.</a></span>
			
		</p>

	</footer>
	
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
