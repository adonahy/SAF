<?php
    require 'ini.php';
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
	<link rel="shortcut icon" href="img/icon-tasks.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<script>
function busqueda() {

    var num1 = Number(document.getElementById("no_transferencia_b").value);
    
    document.getElementById("old").value = num1;

}


</script>

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
                    require 'connection.php';
                    require 'user.php';
                    require 'core.php';
                    error_reporting(0);
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
                    <a href="#">Contabilidad</a>
                    <i class="icon-angle-right"></i>
                    <a href="bancos.php">Bancos</a>
                    <i class="icon-angle-right"></i>
                    <a href="m_egresos.php">Egresos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Transferencias</a>
                </li>
			</ul>
                <?php if($security == 'go'){  ?>
                <h1>Transferencias</h1>
                    <div class="box-content">   
                        
                        <form class="form-horizontal" action="" method="post">
                            <fieldset>     
                                <label class="control-label" for="no_transferencia_b">Buscar: </label>
                                <div class="controls">
                                    <?php
                                    $opt=$_POST['opt'];
                                    
                        if (empty($_POST)===false AND $opt=="buscar"){
                            $old_trans  = $_POST['no_transferencia_b'];
                                    ?>
                                    
                                     <input type="text" class="span6 typeahead" id="no_transferencia_b" name="no_transferencia_b" value="<?php echo "$old_trans"?>" >                
                                    <?php }else{ ?>
                            <input type="text" class="span6 typeahead" id="no_transferencia_b" name="no_transferencia_b" data-provide="typeahead" placeholder="Ingresar número de transferencia..." >                
                                    <input type="hidden" name="opt" id="opt" value="buscar"> 
                        <?php }?>
				                    
							  <button type="submit" class="btn btn-primary" >Buscar</button>
							     </div>
                            </fieldset>
                        </form>
                        <?php
                        $f=0;
                        $opt=$_POST['opt'];
                        if (empty($_POST)===false AND $opt=="guardar"){
                            
                            $fecha             = $_POST['date01'];
                            $banco_t           = $_POST['banco'];
                            
                            $bancotodo_length  = strlen($banco_t);
                            $esta              = strpos("$banco_t", "-");

                            $banco   = substr($banco_t,0,$esta);
                            $pos     = $esta + 1;
                            $cuenta  = substr($banco_t,$pos,$bancotodo_length);
                            
                            $trans   = $_POST['no_transferencia'];
                            $old_trans  = $_POST['old'];
                            
                            $monto   = $_POST['monto'];
                            $tipo_trans        = $_POST['tipo_transferencia'];
                            $u          =   "Usuario registrado";
                            $monto_new  = "Q" . number_format("$monto",2);
                            $d      =   "Efectuo un egreso de: " . $monto_new . " del banco: " . $banco . " en la cuenta: " ;
                            $t      =   "egreso_transferencias";
                            
                            $query3     =   mysql_query("SELECT * FROM `egreso_transferencias` WHERE no_transferencia = '$old_trans'");
                            $result     =   mysql_fetch_array($query3);
                            
                            if($result['fecha']!=""){
                                $query4 = mysql_query("UPDATE `egreso_transferencias` SET `no_transferencia` = '$trans', `monto` = '$monto', `tipo_transferencia` = '$tipo_trans' WHERE `egreso_transferencias`.`no_transferencia` = '$old_trans'");
                                $query5 = mysql_query("UPDATE `estados_cuenta` SET `fecha` = '$fecha', `no_docto` = '$trans', `concepto` = '$tipo_trans', `debito` = '$monto' WHERE `no_docto` = '$old_trans';");
                                $d      =   "Efectuo una modificacion en egreso de: " . $monto_new . " del banco: " . $banco . " en la cuenta: " ;
                                insert_logs($fecha, $u, $d, $t, $cuenta);
                                $f = 3;
                            }else{
                                $query2  = mysql_query("INSERT INTO `egreso_transferencias` (`fecha`, `banco`, `cuenta`, `no_transferencia`, `monto`, `tipo_transferencia`) VALUES ('$fecha', '$banco', '$cuenta', '$trans', '$monto', '$tipo_trans')");
                                
                                $estado_b       = mysql_query("SELECT * FROM `estados_cuenta` ORDER BY fecha, id DESC LIMIT 1");
                                $result_estado  = mysql_fetch_array($estado_b);
                                $estado         = $result_estado['saldo'];
                                $s              = $estado - $monto;
                                
                                $query4     = mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES ('NULL', '$fecha', '$trans', '$tipo_trans', '', '$monto', '$s', '$banco', '$cuenta')");
                            insert_logs($fecha, $u, $d, $t, $cuenta);
                                $f = 1;
                            }
                            
                            
                        }else{
                            if ($opt=="buscar"){
                                $f = 2;
                                $trans      =   $_POST['no_transferencia_b'];
                                $query3     =   mysql_query("SELECT * FROM `egreso_transferencias` WHERE no_transferencia = '$trans'");
                                $busqueda   =   mysql_fetch_array($query3);
                                $fecha_b    =   $busqueda['fecha'];
                                $banco_b    =   $busqueda['banco'];
                                $cuenta_b   =   $busqueda['cuenta'];
                                $monto_b    =   $busqueda['monto'];
                                $tipo_b     =   $busqueda['tipo_transferencia'];
                            }
                        }
                        ?>
						<form class="form-horizontal" action="" method="post">
						  <fieldset>
                              <?php
                                if ($f==1){
                                    echo "<h3>Egreso procesado exitosamente! </h3></br> ". $result['fecha'];
                                }else if($f==3){
                                    echo "<h3>Egreso modificado!</h3></br>";
                                }
                              $fecha = date("m/d/Y");
                              ?>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
                                <?php
                                  if($f!=2){
                                ?>
								    <input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$fecha";?>">
                                <?php
                                  }else{
                                ?>
                                    <input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$fecha_b";?>">
                                <?php  
                                  }
                                ?>
							  </div>
							</div>
							<div class="control-group">
							 <div class="control-group">
								<label class="control-label" for="banco">Nombre del banco y cuenta: </label>
								<div class="controls">
								  <select id="banco" name="banco" data-rel="chosen">
                                       <?php
                                      
                                    if($f!=2){
                                        ?>
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
                                    }else{
                                    ?>
                                      <option value="<?php echo "$banco_b";?>-<?php echo "$cuenta_b";?>"><?php echo "$banco_b";?> - <?php echo "$cuenta_b";?></option>
                                    <?php
                                    }
                                    ?>
									
								  </select>
								</div>
							  </div><br>
                                  <label class="control-label" for="no_transferencia">Numero de transferencia: </label>
                                  <div class="controls">
                                       <?php
                                        if($f!=2){
                                      ?>
								<input type="text" class="span6 typeahead" id="no_transferencia" name="no_transferencia" data-provide="typeahead" placeholder="Ingresar el numero de transferencia..." >
								<?php
                                        }else{
                                      ?>
                                <input type="text" class="span6 typeahead" id="no_transferencia" name="no_transferencia" data-provide="typeahead" value="<?php echo "$trans";?>" >
                                       <?php
                                        }
                                      ?>
							  </div><br>
                                       <label class="control-label" for="monto">Monto: </label>
                                  <div class="controls">
                                      <?php
                                        if($f!=2){
                                      ?>
                                      <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="No ingresar moneda, solo el monto..." >
                                      <?php
                                        }else{
                                      ?>
                                      <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" value="<?php echo "$monto_b";?>" >
                                      <?php
                                        }
                                      ?>
								<!--<p class="help-block">Start typing to activate auto complete!</p>-->
							  </div><br>
                             <div class="control-group">
								<label class="control-label" for="tipo_transferencia">Tipo de transferencia: </label>
								<div class="controls">
								  <select id="tipo_transferencia" name="tipo_transferencia" data-rel="chosen">
                                      <?php
                                        if($f!=2){
                                      ?>
									<option value="Planilla">Planilla</option>
                                    <option value="Pago importacion">Pago Importación</option>
                                    <option value="Pago impuestos">Pago Impuestos</option>
									<!--<option>Q Quetzales</option>-->
                                      <?php
                                        }else{
                                      ?>
                                      <option value="<?php echo "$tipo_b";?>"><?php echo "$tipo_b";?></option>
                                      <?php
                                        }
                                      ?>
								  </select>
								</div>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" onclick="busqueda();">Guardar</button>
                              <!--<button type="submit" class="btn btn-primary">Imprimir</button>
                              <button type="submit" class="btn btn-primary">Modificar</button>-->
							  <button type="reset" class="btn">Cancelar</button>
                                <input type="hidden" name="opt" id="opt" value="guardar"> 
                                <input type="hidden" name="old" id="old" value="">
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
