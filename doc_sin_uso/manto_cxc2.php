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
    if(empty($_POST)===false && $_POST['id_old']!=""){
        $id =   $_POST['id_old'];
        
        $query1     =   mysql_query("SELECT `codigo`,`nombre_comercial` FROM `clientes` WHERE codigo = '$id'");
        $r1         =   mysql_fetch_array($query1);
        $name       =   $r1['nombre_comercial'];
        
        $query    =   mysql_query("DELETE FROM `clientes` WHERE `clientes`.`codigo` = '$id'");
        
         //$u          =   $_SESSION['u'];
         $d          =   "Elimino al cliente: ";
         $t          =   "clientes";
        
         insert_logs($da, $u, $d, $t, $name);
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
			
			<!-- start: Content ****************************************************** -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
                    <i class="icon-angle-right"></i>
				</li>
				<li>
                    <a href="#">Financiero S&T</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Cuentas por cobrar</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <!--INICIA TABLA DE MANTENIMIENTO------------------------------------->
                <h1>Mantenimiento de cuentas por cobrar</h1>
            <div class="box-content">
                <table>
                    <tr>
                        <td>
                            <form name="this2" method="post" action="agregar_cxc.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuenta por cobrar</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
                        </td>
                    </tr>
                </table>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>CODIGO CLIENTE</th>
								  <th>NOMBRE COMERCIAL</th>
                                  <th>OBSERVACIONES</th>
                                  <th>TOTAL</th>
                                  <th>SALDO</th>
								  <th>ACCION</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            $query2 =   mysql_query("SELECT `id_cxc`,`id_cliente`,`observaciones`, `no_recibo`, `saldo`  FROM `cxc_cabecera` ORDER BY id_cliente ");
                            while($r2=mysql_fetch_array($query2)){
                                $idcxc   = $r2['id_cxc'];
                                $ob     =       $r2['observaciones'];
                                $id_cliente =   $r2['id_cliente'];
                                $idp    =   $r2['no_recibo'];
                                
                                
                                
                                $query3 =   mysql_query("SELECT `codigo`,`nombre_comercial`,`nombre_fiscal` FROM `clientes` WHERE `codigo` = '$id_cliente'");
                                $r3     =   mysql_fetch_array($query3);
                                $n_c    =   $r3['nombre_comercial'];
                                //$n_f    =   $r3['nombre_fiscal'];
                                //$query4 =   mysql_query("SELECT `no_factura`,`serie`,`id_cliente`,`total`,`estatus` FROM `factu_principal` WHERE id_cliente = '$id_cliente' AND (estatus = '0' OR estatus = '3')");
                                if($id_old != $id_cliente){
                                    
                                    
                                $query4 = mysql_query("SELECT `id_cliente`,`id_pedido`,`total` FROM `pedidos_cabecera` WHERE `id_cliente` = '$id_cliente' AND estatus_factu = '1' AND estatus_cxc = '2' ORDER BY id_cliente DESC");
                                while($r4=mysql_fetch_array($query4)){
                                    $total  =   $r4['total'];
                                    $factura=   $r4['id_pedido'];
                                    $serie  =   $r4['serie'];
                                    
                                    $queryt = mysql_query("SELECT `saldo` FROM cxc_cabecera WHERE no_recibo = '$factura'");
                                    $qt     = mysql_fetch_array($queryt);
                                    
                                    $saldo  = $qt['saldo'];
                                    
                                    //$query5 = mysql_query("SELECT `id_cxc`,`no_docto`,`v_abono` FROM `cxc_detalle` WHERE `no_docto` = '$factura'");
                                   // $abonos = 0;
                                    //while($r5=mysql_fetch_array($query5)){
                                    //    $abonos = $abonos + $r5['v_abono'];
                                //    }
                                  //  $saldo = $total - $abonos;
                          ?>
							<tr>
				                <td class="center"><?php echo "$id_cliente";?></td>
				                <td class="center"><?php echo "$n_c";?></td>
                                <td class="center"><?php echo "Pedido - $factura";?></td>
                                <td class="center"><?php echo "$total";?></td>
                                <td class="center"><?php echo $saldo;?></td>
								<td class="center">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <form name="this1" method="post" action="cxc_vista.php">
                                                    <button type="submit" class="btn btn-info"><i class="halflings-icon white zoom-in"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$factura";?>"> 
                                                </form>
                                            </td>
                                            <td>
                                                <form name="this1" method="post" action="cxc_abonos.php">
                                                    <button type="submit" class="btn btn-success"><i class="halflings-icon white folder-open"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$factura";?>"> 
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
								</td>
							</tr>
                              <?php
                                    $id_old = $id_cliente;
                                } // Cierre if.
                                }
                            }
                              ?>
						  </tbody>
					  </table>            
					</div>
                <?php }else{ ?>
                    Usuario no registrado!
                <?php } ?>
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
	
	<?php require 'footer.php' ?>
	
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
