<?php
    require 'ini.php';
    require 'core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title><?php echo "$nombre_p "; ?></title>
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
    
<script>
    function todas(){
    
        document.getElementById('conta2').checked = !document.getElementById('conta2').checked;
        
   
    }
    
    function alumnos() {

        document.f1.inscripcion.click();
        document.f1.pago.click();
        document.f1.tarea.click();
        document.f1.lista_alumnos.click();
        /*document.f1.factu.click();
        document.f1.gadicionales.click();
		document.f1.reportef.click();*/
      
				

    }
    
    function gastos() {
    
        document.f1.gadicionales.click();
        document.f1.gacademia.click();
        /*document.f1.pedidos.click();
        document.f1.pfinales.click();
        document.f1.reportev.click();*/
    }

   /* function Compras() {
    
        document.f1.proveedores.click();
      
    }*/
    
    
    
     function Admin() {
    
        document.f1.creacionusuarios.click();
        document.f1.eliminacionusuarios.click();
        document.f1.aroles.click();
        document.f1.bancos.click();
        document.f1.admin_r.click();

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
				<a class="brand" href="index.php"><span><?php echo "$nombre_p "; ?></span></a>
								
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
                                
                                                
                                $alumno             =   $r2['alumnos'];
                                $inscripcion        =   $r2['inscripciones'];
                                $pago               =   $r2['pagos'];
                                $tarea              =   $r2['tareas'];
								$lista_alum         =   $r2['lista_alumnos'];
                               /* $facturacion        =   $_POST['factu'];
                                $gadicionales       =   $_POST['gadicionales'];
                                $conta_reportes     =   $_POST['reportef'];*/
                                
                                $gastos             =   $r2['gastos'];
                                $gastos_adicionales =   $r2['gastos_adicionales'];
                                $gastos_academia    =   $r2['gastos_academia'];
                                /*$ventas_pedido      =   $_POST['pedidos'];
                                $ventas_pedidofinal =   $_POST['pfinales'];
                                $ventas_reportes    =   $_POST['reportev'];
                                
                                
                                $compras            =   $_POST['compras'];
                                $compras_mproveedores=  $_POST['proveedores'];*/
                              
                                
                                $admin              =   $r2['administracion'];
                                $admin_cu           =   $r2['admin_c_u'];
                                $admin_eu           =   $r2['admin_e_u'];
                                $admin_ar           =   $r2['admin_ar'];
                                $bancos             =   $r2['admin_bancos'];
                                $admin_reportes     =   $r2['admin_reportes'];
                                
                            }
                            
                            
                                if(empty($_POST) === false AND $edit == 'guardar'){
                                
                                $us                 =   $_POST['usuar'];
                                
                                $alumno             =   $_POST['alumno'];
                                $inscripcion        =   $_POST['inscripcion'];
                                $pago               =   $_POST['pago'];
                                $tarea              =   $_POST['tarea'];
								$lista_alum         =   $_POST['lista_alumnos'];
                               /* $facturacion        =   $_POST['factu'];
                                $gadicionales       =   $_POST['gadicionales'];
                                $conta_reportes     =   $_POST['reportef'];*/
                                
                                $gastos             =   $_POST['gasto'];
                                $gastos_adicionales =   $_POST['gadicionales'];
                                $gastos_academia    =   $_POST['gacademia'];
                                /*$ventas_pedido      =   $_POST['pedidos'];
                                $ventas_pedidofinal =   $_POST['pfinales'];
                                $ventas_reportes    =   $_POST['reportev'];
                                
                                
                                $compras            =   $_POST['compras'];
                                $compras_mproveedores=  $_POST['proveedores'];*/
                              
                                
                                $admin              =   $_POST['admin'];
                                $admin_cu           =   $_POST['creacionusuarios'];
                                $admin_eu           =   $_POST['eliminacionusuarios'];
                                $admin_ar           =   $_POST['aroles'];
                                $bancos             =   $_POST['bancos'];
                                $admin_reportes     =   $_POST['admin_r'];
                                
                                $query1 =   mysql_query("UPDATE `permissions` SET `alumnos` = '$alumno', `inscripciones` = '$inscripcion', `pagos` = '$pago', `tareas` = '$tarea', `lista_alumnos` = '$lista_alum', `gastos` = '$gastos', `gastos_adicionales` = '$gastos_adicionales', `gastos_academia` = '$gastos_academia', `administracion` = '$admin', `admin_c_u` = '$admin_cu', `admin_e_u` = '$admin_eu', `admin_ar` = '$admin_ar', `admin_bancos` = '$bancos', `admin_reportes` = '$admin_reportes' WHERE `permissions`.`user` = '$us'");
                                
                                $de="Se editaron los permisos del usuario: ";
                                $t="permissions";
                                //echo "$u, $p, $d";
                                //register_user($u, $p, $d);
                                insert_logs($da, $u, $de, $t, $us);
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
                                          <!--<td width="13%">$codigo</td>
                                          <td height="5" style="font-size:6px">&nbsp;</td>-->
                                          <th width="32%" align="center">
                                              <?php
                                                if($alumno > 0){
                                              ?>
                                            <input type="checkbox" onclick="alumnos();" id="alumno" name="alumno" value="1" checked> Alumnos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="alumnos();" id="alumno" name="alumno" value="1"> Alumnos
                                              <?php } ?>
                                          </td>
                                          <th width="36%" align="center">
                                            
                                               <?php
                                                if($gastos > 0){
                                              ?>
                                            <input type="checkbox" onclick="gastos();" id="gasto" name="gasto" value="1" checked> Gastos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="gastos();" id="gasto" name="gasto" value="1"> Gastos
                                              <?php } ?>
                                          </td>
                                          <!--<th width="32%" align="center">
                                            
                                               <?php
                                                if($compras > 0){
                                              ?>
                                            <input type="checkbox" onclick="Compras();" id="compras" name="compras" value="1" checked> Compras
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="Compras();" id="compras" name="compras" value="1"> Compras
                                              <?php } ?>
                                          </td>-->
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                               <?php
                                                if($inscripcion > 0){
                                              ?>
                                            <input type="checkbox" id="inscripcion" name="inscripcion" value="1" checked> Inscripciones
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="inscripcion" name="inscripcion" value="1"> Inscripciones
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($gastos_adicionales > 0){
                                              ?>
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1" checked> Gastos Adicionales
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1" > Gastos Adicionales
                                              <?php } ?>
                                          </td>
                                         <!-- <td width="34%" align="left">
                                              <?php
                                                if($compras_mproveedores > 0){
                                              ?>
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1" checked> Proveedores
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1"> Proveedores
                                              <?php } ?>
                                          </td>-->
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              <?php
                                                if($pago > 0){
                                              ?>
                                            <input type="checkbox" id="pago" name="pago" value="1" checked> Pagos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="pago" name="pago" value="1"> Pagos
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($gastos_academia > 0){
                                              ?>
                                            <input type="checkbox" id="gacademia" name="gacademia" value="1" checked> Gastos de Academia
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="gacademia" name="gacademia" value="1"> Gastos de Academia
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            
                                             &nbsp; 
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              <?php
                                                if($tarea > 0){
                                              ?>
                                            <input type="checkbox" id="tarea" name="tarea" value="1" checked> Tareas
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="tarea" name="tarea" value="1"> Tareas
                                              <?php } ?>
                                          </td>
                                         <!-- <td width="33%" align="left" >
                                            
                                              <?php
                                                if($ventas_pedido > 0){
                                              ?>
                                            <input type="checkbox" id="pedidos" name="pedidos" value="1" checked> Pedidos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="pedidos" name="pedidos" value="1"> Pedidos
                                              <?php } ?>
                                          </td>-->
                                          <td width="34%" align="left">
                                            &nbsp; 
											  
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              <?php
                                                if($lista_alum > 0){
                                              ?>
                                            <input type="checkbox" id="lista_alumnos" name="lista_alumnos" value="1" checked> Lista de Alumnos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="lista_alumnos" name="lista_alumnos" value="1"> Lista de Alumnos
                                              <?php } ?>
                                          </td>
                                          <!--<td width="33%" align="left" >
                                            
                                              <?php
                                                if($ventas_pedidofinal > 0){
                                              ?>
                                            <input type="checkbox" id="pfinales" name="pfinales" value="1" checked> Pedidos finales
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="pfinales" name="pfinales" value="1"> Pedidos finales
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>-->
                                      </tr>
                                      <!--<tr>
                                          <td width="33%" align="left">
                                            
                                               <?php
                                                if($facturacion > 0){
                                              ?>
                                            <input type="checkbox" id="factu" name="factu" value="1" checked> Facturación
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="factu" name="factu" value="1"> Facturación
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                               <?php
                                                if($ventas_reportes > 0){
                                              ?>
                                            <input type="checkbox" id="reportev" name="reportev" value="1" checked> Reportes
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="reportev" name="reportev" value="1"> Reportes
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                               <?php
                                                if($gadicionales > 0){
                                              ?>
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1" checked> Gastos adicionales
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1"> Gastos adicionales
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
                                                if($conta_reportes > 0){
                                              ?>
                                            <input type="checkbox" id="reportef" name="reportef" value="1" checked> Reportes
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="reportef" name="reportef" value="1"> Reportes
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
                                                if($conta_reportes_comi > 0){
                                              ?>
                                            <input type="checkbox" id="reportec" name="reportec" value="1" checked> Reportes de comisión
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="reportec" name="reportec" value="1"> Reportes de comisión
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            &nbsp;
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>-->
                            
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
                                          </td>
                                           &nbsp;
                                          <th width="33%">
                                            
                                          </td>
                                          <th width="34%">
                                           &nbsp;
                                          </td>
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
                                      <tr>
                                          <td width="33%" align="left">
                                          
                                               <?php
                                              if($bancos > 0){
                                              ?>
                                            <input type="checkbox" id="bancos" name="bancos" value="1" checked> Bancos
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="bancos" name="bancos" value="1"> Bancos
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
                                              if($admin_reportes > 0){
                                              ?>
                                            <input type="checkbox" id="admin_r" name="admin_r" value="1" checked> Reportes
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="admin_r" name="admin_r" value="1"> Reportes
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
