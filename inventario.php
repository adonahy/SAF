<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    //$security = "go"; // Mientras la seguridad no se aplica!
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title><?php echo "$nombre_p "; ?></title>
	<meta name="description" content="SAF">
	<meta name="author" content="Mariles Rustrian">
	
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	
	<!-- end: CSS -->
    
    
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<?php
    if(empty($_POST)===false && $_POST['id_old']!=""){
        $id     =   $_POST['id_old'];
        $opt    =   $_POST['fla'];
        
        if($opt != 'trash'){
       
        
        
        }else{
            $query7 = mysql_query("DELETE FROM `inventario` WHERE CONCAT(`inventario`.`id_producto`) = '$id'");
            
            
            
        
        }
        //************* FINISH: QUERY PARA Eliminar producto de inventario***************
       
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
			
			<!-- start: Content ****************************************************** -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
                    <i class="icon-angle-right"></i>
				</li>
				<li>
                    <a href="#"> Productos </a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Inventario</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <!--INICIA TABLA DE INVENTARIO------------------------------------->
                <h1>Inventario de Productos</h1>
            <div class="box-content">
                <table>
                    <tr>
                        <td>
                            <form name="this2" method="post" action="agregar_produc.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Producto</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
                        </td>
                    </tr>
                </table>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>FECHA DE INGRESO</th>
                                  <th>NOMBRE DEL PRODUCTO</th>
                                  <th>PROVEEDOR</th>
                                  <th>PRECIO DE COMPRA</th>
                                  <th>PRECIO A CLIENTE</th>
                                  <th>EXISTENCIA</th>
                                  <th>ACCION</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                                
                             $query_todo    =   mysql_query("SELECT * FROM `inventario`  ORDER BY id_producto ASC");
    
                              while($search=mysql_fetch_array($query_todo)){
                                 
                                  $id               =   $search['id_producto'];
                                  $producto         =   $search['nombre_producto'];
                                  $provee           =   $search['proveedor'];
                                  $precio_compra    =   $search['precio_compra'];
                                  $precio_venta     =   $search['precio_venta'];
                                  $existencia       =   $search['existencia'];
                                  $descrip          =   $search['descrip'];
                                  $fecha_ingreso    =   $search['fecha_ingreso'];
                                  
                            $query_provee = mysql_query("SELECT * FROM `proveedores` WHERE `id_proveedor` = '$provee'");
                                  $qprovee = mysql_fetch_array($query_provee);
                                  
                                  $nombre_provee    =   $qprovee['nombre_proveedor'];
                                                                  
                                  
                                 
                          ?>
							<tr>
								<td class="center"><?php echo "$fecha_ingreso";?></td>
                                <td class="center"><?php echo "$producto";?></td>
                                <td class="center"><?php echo "$nombre_provee";?></td>
                                <td class="center"><?php echo "Q."."$precio_compra";?></td>
                                <td class="center"><?php echo "Q."."$precio_venta";?></td>
                                <td class="center"><?php echo "$existencia";?></td>
                                <td class="center">
                              
                                            
                                            
                                                <form name="this" method="post" action="agregar_existen.php">
                                                    <input type="hidden" id="id" name="id" value="<?php echo "$id";?>"> 

                                                    <button type="submit" class="btn btn-warning"><i class="halflings-icon white plus"></i></button>
                                                    
                                                    
                                                </form>
                                             
                                                <form name="this1" method="post" >
                                                    <button type="submit" class="btn btn-danger" onclick="if(confirm('Desea eliminar este producto ')){
                                                    this.form.submit();}
                                                    else{ return false;
                                                    }" ><i class="halflings-icon white trash"></i></button>
                                                    <input type="hidden" id="id_old" name="id_old" value="<?php echo "$id";?>"> 
                                                    <input type="hidden" id="fla" name="fla" value="trash">
                                                     
                                                </form>
                                            </td>
                                            
                                        </tr>
                                   
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
                <?php }else{ echo "Usuario no autorizado!";} ?>
				</div><!--/span-->
			
			</div>
                <!--TERMINA TABLA DE MANTENIMIENTO------------------------------------>

<!--
			<div class="row-fluid">
				
			
       
	</div><!--/.fluid-container-->
	
			<!-- TERMINA: CONTENIDO ************************************************************** -->
		</div><!--/#content.span10-->
		<!--/fluid-row-->
    
		
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
