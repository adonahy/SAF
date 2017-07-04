<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    //error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title><?php echo "$nombre_p "; ?></title>
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
				<a class="brand" href="index.php"><span><?php echo "$nombre_p "; ?></span></a>
								
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
                    <a href="#"> Gastos </a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_gastos_adici.php"> Gastos Academia </a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de Gastos Academia</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                     //if($_FILES['archivo']['name']){
                       //     $new_file_name = basename($_FILES["archivo"]["name"]);
                         //   $target_dir = "cxp/";
                           // $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
                            //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        //    move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file);
                    //    }
                    $lugar      =   $_POST['lugar'];
                    $fpago      =   $_POST['forma_pago'];
                    $bancotodo      =   $_POST['bancot'];
                    $descrip    =   $_POST['descrip'];
                    $total      =   $_POST['tot_factura'];
                                                     
                    $bancotodo_length  = strlen($bancotodo);
                    $esta              = strpos("$bancotodo", "-");

                    $banco          = substr($bancotodo,0,$esta);
                    $pos            = $esta + 1;
                    $cuenta         = substr($bancotodo,$pos,$bancotodo_length);
       
                    
                    $query2 =   mysql_query("INSERT INTO `gastos_academia` (`id_gastos`, `fecha`, `descripcion`, `lugar`, `forma_pago`, `banco`, `monto`) VALUES (NULL, '$da', '$descrip', '$lugar', '$fpago', '$bancotodo', '$total')");
                    
                    $query8 =   mysql_query("SELECT `id`,`saldo`,`banco`,`cuenta` FROM `estados_cuenta` WHERE banco = '$banco' AND cuenta = '$cuenta' ORDER BY id DESC LIMIT 1");
                    $r8     =   mysql_fetch_array($query8);
                    
                    $saldo_banco=   $r8['saldo'] - $total;
                    
                    $query6 =   mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES (NULL, '$da', '$lugar', 'pago gastos adicionales: $descrip', '0', '$total', '$saldo_banco', '$banco', '$cuenta')");
                    
                     $flag1 = "guardar";
                }
                
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
         
                
                //INICIA INGRESO DE DATOS DE CUENTAS POR PAGAR--------------------
                ?>
                <h1>Ingreso gastos de academia</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input type="text" class="input-medium datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
                             <label class=" control-label" for="no_documento">LUGAR: </label>
                                  <div class="controls">
                                      
								<input type="text" class="input-medium typeahead" id="lugar" name="lugar" value="" >
							  </div> 
                                <label class="control-label" for="proveedor">Forma de pago: </label>
								<div class="controls">
								  <select id="forma_pago" name="forma_pago" data-rel="chosen">
                                      <option value=""></option>
                                      <option value="Depósito">Depósito</option>
                                      <option value="Transacción">Transacción</option>
                                      <option value="Cheque">Cheque</option>
                                      <option value="Efectivo">Efectivo</option>
								  </select>
								</div>
                                	<label class="control-label" for="banco">BANCO Y CUENTA: </label>
								<div class="controls">
								  <select id="bancot" name="bancot" data-rel="chosen">
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
                                <label class="control-label" for="descrip">DESCRIPCION: </label>
								<div class="controls">
								  <select id="descrip" name="descrip" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query_ga=mysql_query("SELECT * FROM `lista_gastos_academia`");
                                      
                                      while($result_gastos=mysql_fetch_array($query_ga)){
                                        
                                        $r_na=$result_gastos['gasto']; 
                                    ?>
                                      <option value="<?php echo "$r_na";?>"><?php echo "$r_na";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
                                
                            <label class=" control-label" for="tot_factura">MONTO: </label>
                              <div class="controls">
								<input type="text" class="input-small typeahead" id="tot_factura" name="tot_factura" value="">
							  </div> 
							</div>
						
							<div class="form-actions">
                          
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag1" name="flag1" value="guardar">
                                
                                
							</div>
						  </fieldset>
						</form>   
               
                    
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Cuenta por pagar ingresada con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
    </div>
    <?php }else{ ?>
    Usuario no registrado!
    <?php } ?>
		
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
