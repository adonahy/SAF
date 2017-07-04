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
               // require 'core.php';
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
                    <a href="#">Creación de Usuarios</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                    if(empty($_POST)===false){
                        $require_fields = array('usuario','pass','pass2');
                        foreach($_POST as $key=>$value){
                            if(empty($value) && in_array($key, $require_fields) === true ){
                                $errors[] = 'Los campos con asterisco son requeridos!';
                                break 1;
                            }
                        }
                        
                        if(empty($errors)===true){
                            if(user_exists($_POST['usuario'])){
                                $errors[] = 'El usuario \'' . $_POST['usuario'] . '\' ya es parte de el sistema!';
                            }
                        }
                        
                        if($_POST['pass'] !== $_POST['pass2']){
                            $errors[] = 'Tus contraseñas no concuerdan.';
                        }
                    }
                ?>
                <h1>Creación de Usuarios</h1>
                    <div class="box-content">
                        <?php
                            if(empty($_POST) === false && empty($errors) === true ){
                                $us=$u;
                                $u=$_POST['usuario'];
                                $p=$_POST['pass'];
                                $d=$_POST['date_01'];
                                $t="users";
                                
                                $de="Creo un nuevo usuario";
                                //echo "$u, $p, $d";
                                register_user($u, $p, $d);
                                insert_logs($d, $us, $de, $t, $u);
                                echo "<h3>Usuario registrado con exito!</h3>";
                            } else {
                                echo "<h3>" . output_errors($errors) . "</h3>";
                            }
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                              <?php
                                $d = date("m/d/Y");
                              ?>
                              <label class="control-label" for="date_01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date_01" name="date_01" value="<?php echo $d; ?>">
							  </div><br>     
                              <label class="control-label" for="typeahead">Usuario*: </label>
                              <div class="controls">
								<input type="text" class="span6 typeahead" id="usuario" name="usuario" placeholder="Ingresa el correo electronico..." >
							  </div><br>
                              <label class="control-label" for="typeahead">Contraseña*: </label>
                              <div class="controls">
								<input type="password" class="span6 typeahead" id="pass" name="pass" placeholder="Ingresa el contraseña del usuario..." >
							  </div><br>
                              <label class="control-label" for="typeahead">Comprobar Contraseña*: </label>
                              <div class="controls">
								<input type="password" class="span6 typeahead" id="pass2" name="pass2" placeholder="Confirmar la contraseña del usuario..." >
							  </div><br>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
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
