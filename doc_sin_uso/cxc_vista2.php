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
	<title>IV System</title>
	<meta name="description" content="IV System">
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
				<a class="brand" href="index.html"><span>IV System</span></a>
								
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
                    <a href="#">Contabilidad</a>
                    <i class="icon-angle-right"></i>
                    <a href="bancos.php">Bancos</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_cxc.php">Cuentas por cobrar</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Resumen de cuenta por cobrar</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <!--INICIA TABLA DE MANTENIMIENTO------------------------------------->
                <h1>Resumen de cuentas por cobrar</h1>
            <div class="box-content">
                <?php
                    $id_cliente =   $_POST['cod'];
                    $query1     =   mysql_query("SELECT `id_cxc`,`id_cliente`,`saldo`,`no_recibo` FROM `cxc_cabecera` WHERE no_recibo  = '$id_cliente'");
                    $r1         =   mysql_fetch_array($query1);
                    $idcliente   =   $r1['id_cliente'];
                    $saldo      =   $r1['saldo'];
                    $idcxc      =   $r1['id_cxc'];
                    
                    
                    $queryd = mysql_query("SELECT `id_pedido`,`producto` FROM `pedidos_secundaria` WHERE `id_pedido` = '$id_cliente'");
                    $qd     = mysql_fetch_array($queryd);
    
                    $descrip    =   $qd['producto'];
                    
                    $queryc = mysql_query("SELECT `codigo`,`nombre_comercial` FROM `clientes` WHERE `codigo` = '$idcliente'");
                    $qc     = mysql_fetch_array($queryc);
    
                    $nombre_c = $qc['nombre_comercial'];
                    
                    $queryt =   mysql_query("SELECT `id_pedido`,`total` FROM `pedidos_cabecera` WHERE id_pedido = '$id_cliente'");
                    $t      =   mysql_fetch_array($queryt);
                    
                    $total = $t['total'];
    //echo "$id_cliente";
                    
                    $query6     =   mysql_query("SELECT `no_factura`,`serie`,`id_cliente`,`total` FROM `factu_principal` WHERE id_cliente = '$id_cliente' AND (estatus != '1' AND estatus != '2')");
                    while($r6=mysql_fetch_array($query6)){
                       $total  =   $r6['total'] + $total;
                       $docto  =   $r6['no_factura'];
                       $serie  =   $r6['serie'];
                        
                        $querys = mysql_query("SELECT `id_cxc`,`no_docto`,`v_abono` FROM `cxc_detalle` WHERE id_cxc = '$idcxc'");
                                    $abonos = 0;
                                    while($rs=mysql_fetch_array($querys)){
                                        $abonos = $abonos + $rs['v_abono'];
                                    }
                                    $saldo = $total_fac - $abonos;
                        
                       
                    }
                    
    //echo "$idcxc";
                ?>
            <h2>CLIENTE: &nbsp; <?php echo"$nombre_c";?></h2>
            <h2>TOTAL DEUDA: &nbsp; <?php echo"$total";?></h2>
            <h2>SALDO: &nbsp; <?php echo"$saldo";?></h2>
            <h2>DESCRIPCIÓN: &nbsp; <?php echo "$descrip";?></h2><br>
            
						<table class="table table-striped table-bordered bootstrap-datatable ">
						  <thead>
							  <tr>
								  <th>FECHA ABONO</th>
                                  <th>NO. FACTURA</th>
								  <th>VALOR ABONO</th>
                                  <th>FORMA DE PAGO</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
    
         
                             //$query2     =   mysql_query("SELECT `no_factura`,`serie`,`id_cliente`,`total` FROM `cxc_detalle` WHERE id_cxc = '$idcxc' ");
                            //while($r2=mysql_fetch_array($query2)){
                               // $factura        =   $r2['no_factura'];
                               // $serie          =   $r2['serie'];
                                $query3 =   mysql_query("SELECT `id_cxc`,`no_docto`,`f_pago`,`v_abono` FROM `cxc_detalle` WHERE id_cxc = '$idcxc' ");
                                while($r3=mysql_fetch_array($query3)){
                                    $valor_abono    = $r3['v_abono'];
                                   // $tot            = $r3['v_bono'];
                                   // $id_cxc         = $r3['id_cxc'];
                                    $nodocto        = $r3['no_docto'];
                                    $formapago      = $r3['f_pago'];
                                    $query4         = mysql_query("SELECT `id_cxc`,`fecha` FROM `cxc_cabecera` WHERE id_cxc = '$idcxc'");
                                    $r4             = mysql_fetch_array($query4);
                                    $fecha          = $r4['fecha'];
                                    $totala      =   $totala + $valor_abono;
                                
                            //echo "$idcxc";
                          ?>
							<tr>
				                <td class="center"><?php echo "$fecha";?></td>
				                <td class="center"><?php echo "$nodocto";?></td>
								<td class="center"><?php echo "$valor_abono";?></td>
                                <td class="center"><?php echo "$formapago";?></td>
							</tr>
                          <?php
                                 }
                          ?>
                              <tr>
                                      <td>
                                        <b>TOTAL</b>
                                      </td>
                                    <td></td>
                                      <td>
                                        <?php 
                                            $totala = number_format("$totala",2);
                                            echo "<b>$totala</b>";
                                        ?>
                                      </td>
                                  <td></td>
                                  </tr>
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
