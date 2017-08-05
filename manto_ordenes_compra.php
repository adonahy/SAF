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
	<title>SAF</title>
	<meta name="description" content="SAF">
	<meta name="author" content="Mariles Rustrian">
	
	<!-- end: Meta -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<?php
    if(empty($_POST)===false){
        $id_delete  =   $_POST['id_old'];
        $query2     =   mysql_query("DELETE FROM `orden_compra_principal` WHERE CONCAT(`orden_compra_principal`.`id_orden_compra`) = '$id_delete'");
        $query1     =   mysql_query("DELETE FROM `orden_compra_secundaria` WHERE CONCAT(`orden_compra_secundaria`.`id_orden_compra`) = '$id_delete'");
        
        $u          =   "Usuario Registrado";       
        $d          =   "Elimino la orden de compra: ";
        $t          =   "orden_compra_principal";
        insert_logs($da, $u, $d, $t, $id_delete);
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
				<a class="brand" href="index.html"><span>ILH System</span></a>
								
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
                    <a href="#">Compras</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Mantenimiento de Ordenes de compra</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <!--INICIA TABLA DE MANTENIMIENTO------------------------------------->
                <h1>Mantenimiento de Ordenes de compra</h1>
            <div class="box-content">
                <table>
                            <tr>
                        <td>
                            <form name="this2" method="post" action="m_ordenes_compra_cabecera.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ORDEN DE COMPRA</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                <input type="hidden" id="flag" name="flag" value="0">
                            </form>
                        </td>
                                <td>
                            <form name="this2" method="post" action="manto_lugar_entrega.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LUGAR DE ENTREGA</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                <input type="hidden" id="flag" name="flag" value="0">
                            </form>
                        </td>
                    </tr>
                </table>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>NO.ORDEN COMPRA</th>
								  <th>FECHA</th>
                                  <th>PROVEEDOR</th>
                                  <th>CONTACTO</th>
                                  <th>ACCION</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                              $query_todo   =   mysql_query("SELECT `id_orden_compra`,`fecha_orden_compra`,`id_proveedor` FROM `orden_compra_principal` ORDER BY `id_orden_compra`");
                              
                              while($search=mysql_fetch_array($query_todo)){
                                  $id_view  =   "O." . $search['id_orden_compra'];
                                  $id       =   $search['id_orden_compra'];
                                  $fecha    =   $search['fecha_orden_compra'];
                                  $id_prov  =   $search['id_proveedor'];
                                  $query8   =   mysql_query("SELECT `id_proveedor`,`nombre_proveedor`,`contacto` FROM `proveedores` WHERE `id_proveedor` = '$id_prov'");
                                  $r8       =   mysql_fetch_array($query8);
                                  $nombre_prov=$r8['nombre_proveedor'];
                                  $contacto_prov=$r8['contacto'];
                       
                          ?>
							<tr>
								<td class="center"><?php echo "$id_view";?></td>
								<td class="center"><?php echo "$fecha";?></td>
                                <td class="center"><?php echo "$nombre_prov";?></td>
                                <td class="center"><?php echo "$contacto_prov";?></td>
                                <td class="center">
								    <table>
                                        <tr>
                                            <td>
                                                <form name="this" method="post">
                                                    <button type="submit" class="btn btn-danger"><i class="halflings-icon white trash"></i></button>
                                                    <input type="hidden" id="id_old" name="id_old" value="<?php echo "$id";?>"> 
                                                </form>
                                            </td>
                                            <td>
                                                <form name="this" method="post" action="imp_orden_compra.php">
                                                    <button type="submit" class="btn btn-info"><i class="halflings-icon white print"></i></button>
                                                    <input type="hidden" id="id_orden" name="id_orden" value="<?php echo "$id";?>"> 
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
								</td>
							</tr>
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
                <?php }else{echo "Usuario no autorizado!";} ?>
				</div><!--/span-->
			
			</div>
                <!--TERMINA TABLA DE MANTENIMIENTO------------------------------------>

<!--
			<div class="row-fluid">
				
			
       
	</div><!--/.fluid-container-->
	
			<!-- TERMINA: CONTENIDO ************************************************************** -->
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