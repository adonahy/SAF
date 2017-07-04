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
          document.getElementById("cantidad").value = xmlhttp2.responseText;
        }
      }
      
       xmlhttp3.onreadystatechange = function() {
        if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200)
        {
          document.getElementById("c_unidad").value = xmlhttp3.responseText;
        }
      }
       
        xmlhttp4.onreadystatechange = function() {
        if(xmlhttp4.readyState == 4 && xmlhttp4.status == 200)
        {
          document.getElementById("subtotal").value = xmlhttp4.responseText;
        }
      }
      
      xmlhttp.open("GET","search_inventario.php?codigo="+codigo, true);
      xmlhttp.send();
      xmlhttp2.open("GET","search_inventario2.php?codigo="+codigo, true);
      xmlhttp2.send();
      xmlhttp3.open("GET","search_inventario3.php?codigo="+codigo, true);
      xmlhttp3.send();
      xmlhttp4.open("GET","search_inventario4.php?codigo="+codigo, true);
      xmlhttp4.send();
     
  }
</script>
    
<script>   
function sum_subtotal() {
    //alert("The input value has changed. The new value is: " + val);
    //var y = ++ val;
    var num1 = Number(document.getElementById("cantidad").value);
    var num2 = Number(document.getElementById("c_unidad").value);
    
    var tot = num1 * num2;
    
    document.getElementById("subtotal").value = tot;

}

function sum_total() {
    //alert("The input value has changed. The new value is: " + val);
    //var y = ++ val;
    var num1 = Number(document.getElementById("subtotal").value);
    var num2 = Number(document.getElementById("iva").value);
    
    var tot = num1 + num2;
    
    document.getElementById("total").value = tot;

}

</script>
    
    <?php
                
                if(empty($_POST)===false){
                    $fecha          =   $_POST['date01'];
                    $proveedor      =   $_POST['proveedor'];
                    $valor_factura  =   $_POST['v_factura'];
                    $ob             =   $_POST['observaciones'];
                    $codigo         =   $_POST['codigo'];
                    $des            =   $_POST['des'];
                    $cantidad       =   $_POST['cantidad'];
                    $costoxunidad   =   $_POST['c_unidad'];
                    $subtotal       =   $cantidad * $costoxunidad;
                    $iva            =   $_POST['iva'];
                    $total          =   $iva + $subtotal;
            
                    $query      =   mysql_query("INSERT INTO `ajustes_inv` (`id`, `fecha`, `proveedor`, `valor_factura`, `observaciones`, `codigo`, `descripcion`, `cantidad`, `costoxunidad`, `subtotal`, `iva`, `total`) VALUES (NULL, '$fecha', '$proveedor', '$valor_factura', '$ob', '$codigo', '$des', '$cantidad', '$costoxunidad', '$subtotal', '$iva', '$total')");
                    
                    $query2     =   mysql_query("UPDATE `inventario_central` SET `cantidad` = '$cantidad' WHERE `inventario_central`.`codigo` = '$codigo'");
                    
                    $fecha  =   date("m/d/Y");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Efectuo un ajuste de inventario en el codigo: ";
                    $t      =   "ajustes_inv, inventario_central";
            
                    insert_logs($fecha, $u, $d, $t, $codigo);
                    
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
                    <a href="#">Ajuste de Inventario</a>
				</li>
			</ul>
                <?php
                if($security == 'go'){ 
                    if($monica=="yes"){
                        echo "<h3>Ajuste realizado exitosamente!</h3>";
                    }
                ?>
                <h1>Ajuste de Inventario</h1>
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
							  <label class="control-label" for="proveedor">Nombre del proveedor: </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" id="proveedor" name="proveedor" >
							  </div><br>
                                <label class="control-label" for="v_factura">Valor Factura: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="v_factura" name="v_factura">
							  </div><br>
                                <label class="control-label" for="observaciones">Observaciones: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="observaciones" name="observaciones" placeholder="Ingresar todas las observaciones necesarias..." >
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
								<input type="text" class="span6 typeahead" id="cantidad" name="cantidad" placeholder="Ingresar la cantidad..." onchange="sum_subtotal();">
                                </div><br>
                                  <label class="control-label" for="c_unidad">Costo x Unidad: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="c_unidad" name="c_unidad" onchange="sum_subtotal();">
                                </div><br>
                                  <label class="control-label" for="subtotal">Subtotal: </label>
                                  <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="subtotal" name="subtotal" placeholder="Este campo sera llenado automaticamente..." >
                                </div><br>
                                  <label class="control-label" for="iva">IVA: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="iva" name="iva"  placeholder="Ingresar IVA correspondiente..." onchange="sum_total();">
                                </div><br>
                                  <label class="control-label" for="total">Total: </label>
                                  <div class="controls">
								<input disabled type="text" class="span6 typeahead" id="total" name="total" placeholder="Este campo sera llenado automaticamente...">
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
