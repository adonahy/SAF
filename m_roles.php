<?php
    require 'ini.php';
    
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
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	
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
				<a class="brand" href="index.php"><span>SAF</span></a>
								
				<!-- start: Header Menu --> 
		<?php
                require 'connection.php';
                require 'user.php';
                require 'core.php';
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
                    <a href="#">Administración</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_roles.php">Mantenimiento de roles</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de permisos</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <h1>Permisos de Usuarios</h1>
                    <div class="box-content">
                        <?php
                            if(empty($_POST) === false){
                                
                                $us                 =   $_POST['usuar'];
                                
                                $productos          =   $_POST['produc'];
                                $inventario         =   $_POST['inven'];
                                $proveed            =   $_POST['provee'];
                                
                               
                                
                                $ventas             =   $_POST['ventas'];
                                $preorden           =   $_POST['preorden'];
                                $ordencompras       =   $_POST['ordencompras'];
                                $factura            =   $_POST['factu'];
                                $clientes           =   $_POST['clientes'];
                                
                                
                                
                                $pagos              =   $_POST['pagos'];
                                $provee             =   $_POST['proveedores'];
                                $servicios          =   $_POST['servicios'];
                                $cuentas            =   $_POST['cuentas'];
                                $planilla           =   $_POST['planilla'];
                              
                                
                                $admin              =   $_POST['admin'];
                                $admin_cu           =   $_POST['creacionusuarios'];
                                $admin_eu           =   $_POST['eliminacionusuarios'];
                                $admin_ar           =   $_POST['aroles'];
                                
                                                      
                                $query1 =   mysql_query("INSERT INTO `permissions` (`user`, `productos`, `productos_inventario`, `productos_provee`, `ventas`, `ventas_preorden`, `ventas_ordencompras`, `ventas_facturacion`, `ventas_clientes`, `pago`, `pago_proveedores`, `pago_servicios`, `pago_cuentas`, `pago_planillas`, `administracion`, `admin_c_u`, `admin_e_u`, `admin_ar`) VALUES ('$us', '$productos', '$inventario', '$proveed', '$ventas', '$preorden', '$ordencompras', '$factura', '$clientes', '$pagos','$provee','$servicios','$cuentas','$planilla','$admin', '$admin_cu', '$admin_eu', '$admin_ar')");
                                
                                
                                echo "<h3>Los permisos del usuario han sido guardados!</h3>";
                            } else {
                                //echo "<h3>" . output_errors($errors) . "</h3><br>";
                            }
                        ?>
						<form id="f1" name="f1" class="form-horizontal" method="post" >
						  <fieldset>
                              <label class="control-label" for="date_01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date_01" name="date_01" value="<?php echo $da; ?>">
							  </div><br>     
                              <div class="control-group">
								<label class="control-label" for="usuar">Usuario: </label>
								<div class="controls">
								  <select id="usuar" name="usuar" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `users`");
                                        
                                      while($result_usuarios=mysql_fetch_array($query)){
                                        $r=$result_usuarios['user'];
                                    ?>
                                      <option value="<?php echo "$r";?>"><?php echo "$r";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label">Permisos:</label>
                                  <table class="controls" width="60%" border="0"><!-- inicia tabla de ordenamiento para los permisos -->
                                      <tr>
                                          <!--<td width="13%">$codigo</td>
                                          <td height="5" style="font-size:6px">&nbsp;</td>-->
                                          <th width="32%" align="center">
                                            <input type="checkbox" id="produc" name="produc" value="1"> Productos
                                
                                          </th>
                                          <th width="36%" align="center">
                                            <input type="checkbox" id="ventas" name="ventas" value="1"> Ventas
                                          </th>
                                          <th>
                                         <input type="checkbox" id="pagos" name="pagos" value="1"> Pagos
                                          </th>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="inven" name="inven" value="1"> Inventario
                                          </td>
                                          <td width="33%" align="left" >
                                             <input type="checkbox" id="preorden" name="preorden" value="1" > Pre-orden
                                          </td>
                                          <td width="34%" align="left">
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1"> Proveedores
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="provee" name="provee" value="1"> Proveedores
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="ordencompras" name="ordencompras" value="1"> Orden de compras
                                          </td>
                                          <td width="34%" align="left">
                                           <input type="checkbox" id="servicios" name="servicios" value="1"> Servicios
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                             &nbsp;
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="factu" name="factu" value="1"> Facturación
                                          </td>
                                          <td width="34%" align="left">
                                            <input type="checkbox" id="cuentas" name="cuentas" value="1"> Cuentas
                                          </td>
                                      </tr>
                                     <tr>
                                          <td width="33%" align="left">
                                            &nbsp;
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="clientes" name="clientes" value="1"> Clientes
                                          </td>
                                          <td width="34%" align="left">
                                            <input type="checkbox" id="planilla" name="planilla" value="1"> Planillas
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                           
                                          </td>
                                          <td width="33%" align="left" >
                                            &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <th width="33%">
                                             <input type="checkbox" onclick="Admin();" id="admin" name="admin" value="1"> Administración
                                          </th>
                                          <th width="33%">
                                             &nbsp;
                                          </th>
                                          <th width="34%">
                                            &nbsp;
                                          </th>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                           <input type="checkbox" id="creacionusuarios" name="creacionusuarios" value="1"> Creación de usuarios
                                          </td>
                                          <td width="33%" align="left" >
                                            &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                          <input type="checkbox" id="eliminacionusuarios" name="eliminacionusuarios" value="1"> Eliminación de usuarios
                                          </td>
                                          <td width="33%" align="left" >
                                            &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                             <input type="checkbox" id="aroles" name="aroles" value="1"> Asignación de roles
                                          </td>
                                          <td width="33%" align="left" >
                                             &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      
                                  </table>
							  </div>
                              
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn" >Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
       <?php }else{echo "Usuario no autorizado!";} ?>
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
