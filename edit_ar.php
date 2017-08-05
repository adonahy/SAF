<?php
    require 'ini.php';
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
                            $edit = $_POST['edit'];
                            if(empty($_POST) === false AND $edit == 'true'){
                                
                                $us                 =   $_POST['user_edit'];
                                
                                $query2  =   mysql_query("SELECT * FROM `permissions` WHERE user = '$us'");
                                $r2      =   mysql_fetch_array($query2);
                                
                                                
                                $productos             =   $r2['productos'];
                                $inventario            =   $r2['productos_inventario'];
                                $proveed               =   $r2['productos_provee'];
                                
                                
                                $ventas             =   $r2['ventas'];
                                $preorden           =   $r2['ventas_preorden'];
                                $ordencompras       =   $r2['ventas_ordencompras'];
                                $factura            =   $r2['ventas_facturacion'];
                                $clientes           =   $r2['ventas_clientes'];
                                                            
                                
                                $pagos              =  $r2['pago'];
                                $provee             =  $r2['pago_proveedores'];
                                $servicios          =  $r2['pago_servicios'];
                                $cuentas            =  $r2['pago_cuentas'];
                                $planilla           =  $r2['pago_planilla'];
                              
                                
                                $admin              =   $r2['administracion'];
                                $admin_cu           =   $r2['admin_c_u'];
                                $admin_eu           =   $r2['admin_e_u'];
                                $admin_ar           =   $r2['admin_ar'];
                                
                                
                            }
                            
                            
                                if(empty($_POST) === false AND $edit == 'guardar'){
                                
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
                                
                                
                                $query1 =   mysql_query("UPDATE `permissions` SET `productos`='$productos',`productos_inventario`='$inventario',`productos_provee`='$proveed',`ventas`='$ventas',`ventas_preorden`='$preorden',`ventas_ordencompras`='$ordencompras',`ventas_facturacion`='$factura',`ventas_clientes`='$clientes',`pago`='$pagos',`pago_proveedores`='$provee',`pago_servicios`='$servicios',`pago_cuentas`='$cuentas',`pago_planillas`='$planilla',`administracion`='$admin',`admin_c_u`='$admin_cu',`admin_e_u`='$admin_eu',`admin_ar`='$admin_ar' WHERE `permissions`.`user` = '$us'");
                                
                               
                                echo "<h3>Los permisos del usuario han sido editados!</h3>";
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
                                      
                                      <option value="<?php echo "$us";?>"><?php echo "$us";?></option>
									
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label">Permisos:</label>
                                  <table class="controls" width="60%" border="0"><!-- inicia tabla de ordenamiento para los permisos -->
                                      <tr>
                                          
                                          <th width="32%" align="center">
                                              <?php
                                                if($productos > 0){
                                              ?>
                                            <input type="checkbox" id="produc" name="produc" value="1" checked> Productos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="produc" name="produc" value="1"> Productos
                                              <?php } ?>
                                          </th>
                                          <th width="36%" align="center">
                                            
                                               <?php
                                                if($ventas > 0){
                                              ?>
                                            <input type="checkbox" id="ventas" name="ventas" value="1" checked> Ventas
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="ventas" name="ventas" value="1"> Ventas
                                              <?php } ?>
                                          </th>
                                          <th width="32%" align="center">
                                            
                                               <?php
                                                if($pagos > 0){
                                              ?>
                                            <input type="checkbox" id="pagos" name="pagos" value="1" checked> Pagos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="pagos" name="pagos" value="1"> Pagos
                                              <?php } ?>
                                          </th>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                               <?php
                                                if($inventario > 0){
                                              ?>
                                            <input type="checkbox" id="inven" name="inven" value="1" checked> Inventario
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="inven" name="inven" value="1"> Inventario
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($preorden > 0){
                                              ?>
                                            <input type="checkbox" id="preorden" name="preorden" value="1" checked> Pre-orden
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="preorden" name="preorden" value="1" > Pre-orden
                                              <?php } ?>
                                          </td>
                                         <td width="34%" align="left">
                                              <?php
                                                if($provee > 0){
                                              ?>
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1" checked> Proveedores
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1"> Proveedores
                                              <?php } ?>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              <?php
                                                if($proveed > 0){
                                              ?>
                                            <input type="checkbox" id="provee" name="provee" value="1" checked> Proveedores
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="provee" name="provee" value="1"> Proveedores
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($ordencompras > 0){
                                              ?>
                                            <input type="checkbox" id="ordencompras" name="ordencompras" value="1" checked> Orden de compras
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="ordencompras" name="ordencompras" value="1"> Orden de compras
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            <?php
                                                if($servicios > 0){
                                              ?>
                                            <input type="checkbox" id="servicios" name="servicios" value="1" checked> Servicios
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="servicios" name="servicios" value="1"> Servicios
                                              <?php } ?>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            &nbsp; 
                                              
                                          </td>
                                         <td width="33%" align="left" >
                                            
                                              <?php
                                                if($factura > 0){
                                              ?>
                                            <input type="checkbox" id="factu" name="factu" value="1" checked> Facturación
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="factu" name="factu" value="1"> Facturación
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            
                                              <?php
                                                if($cuentas > 0){
                                              ?>
                                            <input type="checkbox" id="cuentas" name="cuentas" value="1" checked> Cuentas
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="cuentas" name="cuentas" value="1"> Cuentas
                                              <?php } ?> 
											  
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              &nbsp;
                                          </td>
                                          <td width="33%" align="left" >
                                            <?php
                                              if($clientes > 0){
                                              ?>
                                            <input type="checkbox" id="clientes" name="clientes" value="1" checked> Clientes
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="clientes" name="clientes" value="1"> Clientes
                                              <?php } ?> 
                                            
                                          </td>
                                          <td width="34%" align="left">
                                            <?php
                                                if($planilla > 0){
                                              ?>
                                            <input type="checkbox" id="planilla" name="planilla" value="1" checked> Planillas
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="planilla" name="planilla" value="1"> Planillas
                                              <?php } ?> 
                                          </td>
                                      </tr>
                                      
                            
                                      <tr>
                                          <td width="33%" align="left">
                                            &nbsp;
                                          </td>
                                          <td width="33%" align="left" >
                                            &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
										  <th width="34%">
                                            <?php
                                               if($admin > 0){
                                              ?>
                                            <input type="checkbox" onclick="Admin();" id="admin" name="admin" value="1" checked> Administración
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="Admin();" id="admin" name="admin" value="1"> Administración
                                              <?php } ?>
                                          </th>
                                           &nbsp;
                                          <th width="33%">
                                            
                                          </th>
                                          <th width="34%">
                                           &nbsp;
                                          </th>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                              <?php
                                              if($admin_cu > 0){
                                              ?>
                                            <input type="checkbox" id="creacionusuarios" name="creacionusuarios" value="1" checked> Creación de usuarios
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="creacionusuarios" name="creacionusuarios" value="1"> Creación de usuarios
                                              <?php } ?>
                                              
											  
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
                                             <?php
                                              if($admin_eu > 0){
                                              ?>
                                            <input type="checkbox" id="eliminacionusuarios" name="eliminacionusuarios" value="1" checked> Eliminación de usuarios
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="eliminacionusuarios" name="eliminacionusuarios" value="1"> Eliminación de usuarios
                                              <?php } ?> 
                                              
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
                                           <?php
                                              if($admin_ar > 0){
                                              ?>
                                            <input type="checkbox" id="aroles" name="aroles" value="1" checked> Asignación de roles
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="aroles" name="aroles" value="1"> Asignación de roles
                                              <?php } ?> 
                                              
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
                                <input type="hidden" id="edit" name ="edit" value="guardar">
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
