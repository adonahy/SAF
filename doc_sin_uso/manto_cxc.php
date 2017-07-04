<?php
    require 'ini.php';
   // require 'connection.php';
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
        
         $u          =   $_SESSION['u'];
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
                <?php
                           // echo "$u";
                    $query2 =   mysql_query("SELECT `user`,`conta_cxc` FROM `permissions` WHERE user = '$u'");
                    $r2     =   mysql_fetch_array($query2);
                    $per    =   $r2['conta_cxc'];
                            if($per > 0){
                                
                                if($u=="admin"){
                                $query3 =   mysql_query("SELECT `id_control`,`fecha`,`no_docto`,`serie`,`cliente`,`id_vendedor`,`total`,`saldo`,`estatus` FROM `cxc` ORDER BY id_control ASC");
                                    }
                                else {
                                    $query_c = mysql_query("SELECT `id_vendedor`,`id_user` FROM `vendedores` WHERE id_user = '$u'");
                                    $rc     = mysql_fetch_array($query_c);
                                    $id_vendedor= $rc['id_vendedor'];
                                     $query3 =   mysql_query("SELECT `id_control`,`fecha`,`no_docto`,`serie`,`cliente`,`id_vendedor`,`total`,`saldo`,`estatus` FROM `cxc` WHERE id_vendedor = '$id_vendedor' ORDER BY id_control ASC");
                                }
                          ?>
                <table>
                    <tr>
                        <td>
                            <form name="this2" method="post" action="agregar_cxc.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuenta por cobrar</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
                        </td>
                    </tr>
                </table>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  
								  <th>FECHA</th>
                                  <th>NO. PEDIDO</th>
                                  <th>NOMBRE CLIENTE</th>
                                  <th>VENDEDOR</th>
                                  <th>TOTAL</th>
                                  <th>SALDO</th>
                                  <th>ESTATUS</th>
								  <th>ACCION</th>
							  </tr>
						  </thead>   
						  <tbody>
                              <?php
                                while($r3=mysql_fetch_array($query3)){
                                    $id     =   $r3['id_control'];
                                    $fe     =   $r3['fecha'];
                                    $nf     =   $r3['serie']. " - " . $r3['no_docto'];
                                    $to     =   $r3['total'];
                                    $es     =   $r3['estatus'];
                                    $id_c   =   $r3['cliente'];
                                    $id_v   =   $r3['id_vendedor'];
                                    $query4 =   mysql_query("SELECT `codigo`,`nombre_comercial` FROM `clientes` WHERE codigo = '$id_c'");
                                    $r4     =   mysql_fetch_array($query4);
                                    $name_comer=$r4['nombre_comercial'];
                                    $sa     =   $r3['saldo'];
                                    
                                    $query5 =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor` FROM `vendedores` WHERE id_vendedor = '$id_v'");
                                    $r5     =   mysql_fetch_array($query5);
                                    
                                    $vende  =   $r5['nombre_vendedor'];
                              ?>
							<tr>
								<td class="center"><?php echo "$fe";?></td>
                                <td class="center"><?php echo "$nf";?></td>
                                <td class="center"><?php echo "$name_comer";?></td>
                                <td class="center"><?php echo "$vende";?></td>
                                <td class="center"><?php echo "$to";?></td>
                                <td class="center"><?php echo "$sa";?></td>
                                <?php
                                  if($es>0){
                                ?>
                                <td class="center"><span class="label label-success">Cancelada</span></td>
                                <?php
                                  }else{
                                ?>
                                <td class="center"><span class="label label-important">Activa</span></td>
                                <?php
                                  }
                                ?>
								<td class="center">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <form name="this1" method="post" action="cxc_vista.php">
                                                    <button type="submit" class="btn btn-info"><i class="halflings-icon white search"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>"> 
                                                </form>
                                            </td>
                                            <td>
                                                <form name="this1" method="post" action="cxc_abonos.php">
                                                    <button type="submit" class="btn btn-success"><i class="halflings-icon white folder-open"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>"> 
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
                  <?php
                                }else{
                                    echo "Usuario no cuenta con permisos de administrador!";
                                }
                          ?>
					</div>
                <?php }else{ ?>
                    Usuario no registrado!
                <?php } ?>
				</div><!--/content-->
			
			</div><!--/fluid-container-->

	
			<!-- TERMINA: CONTENIDO ************************************************************** -->
		
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
