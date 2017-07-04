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
    
<script type="text/javascript">    
    
function search(codigo)
   {
      var xmlhttp;
      var xmlhttp2;
      var xmlhttp3;
      var xmlhttp4;
      
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        xmlhttp2=new XMLHttpRequest();
        xmlhttp3=new XMLHttpRequest();
        xmlhttp4=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp4=new ActiveXObject("Microsoft.XMLHTTP");
      }	
 
      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("des").value = xmlhttp.responseText;
        }
      }
      xmlhttp2.onreadystatechange = function() {
        if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
        {
          document.getElementById("total").value = xmlhttp2.responseText;
        }
      }
      
      xmlhttp.open("GET","search_inventario.php?codigo="+codigo, true);
      xmlhttp.send();
      xmlhttp2.open("GET","search_inventario2.php?codigo="+codigo, true);
      xmlhttp2.send();
     
  }
</script>
    
<script>   

function sum_total() {
    //alert("The input value has changed. The new value is: " + val);
    //var y = ++ val;
    var num1 = Number(document.getElementById("cantidad").value);
    var num2 = Number(document.getElementById("total").value);
    
    var tot = num2 - num1;
    
    document.getElementById("total").value = tot;

}

</script>

<?php
                
                if(empty($_POST)===false){
                    $fecha          =   $_POST['date01'];
                    $no_docto       =   $_POST['n_documento'];
                    $cliente        =   $_POST['cliente'];
                    $no_orden       =   $_POST['n_orden_produccion'];
                    $codigo         =   $_POST['codigo'];
                    $descripcion    =   $_POST['des'];
                    $cantidad       =   $_POST['cantidad'];
                    $total          =   $_POST['total'];
    
                    $query      =   mysql_query("INSERT INTO `despacho_mp` (`id`, `fecha`, `no_docto`, `cliente`, `no_orden`, `codigo`, `descripcion`, `cantidad`, `total`) VALUES (NULL, '$fecha', '$no_docto', '$cliente', '$no_orden', '$codigo', '$descripcion', '$cantidad', '$total')");
                    
                    $query3     =   mysql_query("SELECT `codigo`,`cantidad` FROM `inventario_central` WHERE codigo = '$codigo'");
                    $r          =   mysql_fetch_array($query3);
                    $r_cantidad =   $r['cantidad'];
                    
                    $fecha  =   date("m/d/Y");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Efectuo un despacho de materia en el código: " . $codigo . " por una cantidad de: ";
                    $t      =   "ingeso_pt, inventario_central";
            
                    insert_logs($fecha, $u, $d, $t, $cantidad);
                    
                    $cantidad   =   $r_cantidad - $cantidad;
                    
                    $query2     =   mysql_query("UPDATE `inventario_central` SET `cantidad` = '$cantidad' WHERE `inventario_central`.`codigo` = '$codigo'");
                    
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
			
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
					<i class="icon-angle-right"></i>
                    <a href="#">Contabilidad</a> 
					<i class="icon-angle-right"></i>
                    <a href="inventario.php">Inventario</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Despacho Materia Prima</a>
				</li>
			</ul>
                <?php
                if($security == 'go'){ 
                    if($monica=="yes"){
                        echo "<h3>Despacho realizado exitosamente!</h3>";
                    }
                ?>
                <h1>Despacho Materia Prima</h1>
                					<div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$da";?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="n_documento">No. documento: </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" id="n_documento" name="n_documento" >
							  </div><br>
                              <div class="control-group">
								<label class="control-label" for="cliente">Cliente: </label>
								<div class="controls">
								  <select id="cliente" name="cliente" data-rel="chosen">
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
                                <label class="control-label" for="n_orden_produccion">No. Orden Producción: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="n_orden_produccion" name="n_orden_produccion" placeholder="Ingresar todas las observaciones necesarias..." >
                                </div><br>
                                <label class="control-label" for="codigo">Código: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="codigo" name="codigo" placeholder="Ingresar codigo del producto..." onchange="search(this.value);">
                                </div><br>
                                  <label class="control-label" for="des">Descripción: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="des" name="des" placeholder="Este campo sera llenado automaticamente..." >
                                </div><br>
                                  <label class="control-label" for="cantidad">Cantidad: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="cantidad" name="cantidad" placeholder="Ingresar la cantidad..." onchange="sum_total();">
                                </div><br>
                                  <label class="control-label" for="total">Total: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="total" name="total" placeholder="Este campo sera llenado automaticamente..." >
                                </div><br>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php 
                }else{
                    echo "Usuario no autorizado!";
                }
                ?>
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
