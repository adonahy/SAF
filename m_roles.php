<?php
    require 'ini.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Academia San Jose</title>
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
				<a class="brand" href="index.php"><span>Academia San José</span></a>
								
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
                                
                                $query1 =   mysql_query("INSERT INTO `permissions` (`user`, `alumnos`, `inscripciones`, `pagos`, `tareas`, `lista_alumnos`, `gastos`, `gastos_adicionales`, `gastos_academia`, `administracion`, `admin_c_u`, `admin_e_u`, `admin_ar`, `admin_bancos`, `admin_reportes`) VALUES ('$us', '$alumno', '$inscripcion', '$pago', '$tarea', '$lista_alum', '$gastos', '$gastos_adicionales', '$gastos_academia', '$admin', '$admin_cu', '$admin_eu', '$admin_ar', '$bancos', '$admin_reportes')");
                                
                                $de="Se cambiaron los permisos del usuario: ";
                                $t="permissions";
                                //echo "$u, $p, $d";
                                //register_user($u, $p, $d);
                                insert_logs($da, $u, $de, $t, $us);
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
                                            <input type="checkbox" onclick="alumnos();" id="alumno" name="alumno" value="1"> Alumnos
                                
                                          </td>
                                          <th width="36%" align="center">
                                            <input type="checkbox" onclick="gastos();" id="gasto" name="gasto" value="1"> Gastos
                                          </td>
                                         <!-- <th width="32%" align="center">
                                            <input type="checkbox" onclick="Compras();" id="compras" name="compras" value="1"> Compras
                                          </td>-->
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="inscripcion" name="inscripcion" value="1"> Inscripciones
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1" > Gastos Adicionales
                                          </td>
                                          <!--<td width="34%" align="left">
                                            <input type="checkbox" id="proveedores" name="proveedores" value="1"> Mantenimiento Proveedores
                                          </td>-->
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="pago" name="pago" value="1"> Pagos
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="gacademia" name="gacademia" value="1"> Gastos de Academia
                                          </td>
                                          <td width="34%" align="left">
                                           &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="tarea" name="tarea" value="1"> Tareas
                                          </td>
                                         <!-- <td width="33%" align="left" >
                                            <input type="checkbox" id="pedidos" name="pedidos" value="1"> Pedidos
                                          </td>
                                          <td width="34%" align="left">-->
                                            &nbsp;
                                          </td>
                                      </tr>
                                     <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="lista_alumnos" name="lista_alumnos" value="1"> Lista de Alumnos
                                          </td>
                                          <!--<td width="33%" align="left" >
                                            <input type="checkbox" id="pfinales" name="pfinales" value="1"> Pedidos finales
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>-->
                                     <!-- <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="factu" name="factu" value="1"> Facturación
                                          </td>
                                          <td width="33%" align="left" >
                                            <input type="checkbox" id="reportev" name="reportev" value="1"> Reportes
                                          </td>
                                          <td width="34%" align="left">
                                            &nbsp;
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            <input type="checkbox" id="gadicionales" name="gadicionales" value="1"> Gastos adicionales
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
                                            <input type="checkbox" id="reportef" name="reportef" value="1"> Reportes
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
                                          </td>
                                          <th width="33%">
                                             &nbsp;
                                          </td>
                                          <th width="34%">
                                            &nbsp;
                                          </td>
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
                                      <tr>
                                          <td width="33%" align="left">
                                           <input type="checkbox" id="bancos" name="bancos" value="1"> Bancos
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
                                             <input type="checkbox" id="admin_r" name="admin_r" value="1"> Reportes
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
