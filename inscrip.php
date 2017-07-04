<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title><?php echo "$nombre_p "; ?></title>
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
                
                if(empty($_POST)===false){
                    $fecha                 =    $_POST['date01'];
                    $codigo                =    $_POST['codigo'];
                    $ciclo                 =    $_POST['ciclo'];
                    $nombres               =    $_POST['nombre'];
                    $apellidos             =    $_POST['apellido'];
                    $f_nac                 =    $_POST['f_nac'];
                    $edad                  =    $_POST['edad'];
                    $direccion             =    $_POST['direccion'];
                    $n_encargado           =    $_POST['n_encarga'];
                    $tel                   =    $_POST['tel'];
                    $curso                 =    $_POST['curso'];
                    $horario               =    $_POST['horario'];
                    $jornada               =    $_POST['jornada'];
                    
                    $query2 = mysql_query("SELECT `id_curso`,`nombre_curso`, `precio`,`inscripcion` FROM `cursos` WHERE id_curso = '$curso'");
                        $r2     = mysql_fetch_array($query2);

                        
                        $mes        = $r2['precio'];
                        $inscrip    = $r2['inscripcion'];
                        $Papeleria  = 100;
                        $mante      = 50;
                        $cicloa     = $mes * 11;
                        $ciclo_t    = $cicloa + $inscrip + $papeleria + $mante;
                    
                    
                   
            
                    $query      =   mysql_query("INSERT INTO `alumno` (`id_alumno`, `ciclo`,`nombres`, `apellidos`, `horario`, `edad`, `fecha_nac`, `direccion`, `nombre_encargado`, `telefono`, `nivel`, `id_horario`, `id_jornada`, `total`, `saldo`, `fecha_creacion`) VALUES ('$codigo', '$ciclo','$nombres', '$apellidos', '$horario', '$edad', '$f_nac', '$direccion','$n_encargado', '$tel', '$curso', '$horario','$jornada', '$ciclo_t','$ciclo_t', '$fecha')");
                    
                    $query_pago =   mysql_query("INSERT INTO `pagos` (`id_pago`, `id_user`) VALUES ('null', '$codigo')");
                    
                    $fecha  =   date("d/m/Y");
                    
                    //$u      =   "Usuario registrado";
                    $d      =   "Ingreso un nuevo alumno a la base de dato: ";
                    $t      =   "alumno";
            
                    insert_logs($fecha, $u, $d, $t, $nombre_fiscal);
                    
                    $monica =   "yes";
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
				<a class="brand" href="one.php"><span><?php echo "$nombre_p "; ?></span></a>
								
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
			
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>
                    
                    <a href="#">Alumnos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Inscripciones</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                    if($monica=="yes"){
                        echo "<h3>Alumno inscrito con exitosamente!</h3>";
                ?>
                <form id="con_inscrip" method="post" action="print_inscrip.php">
                <div class="form-actions">
                    <input type="hidden" id="no_alumno" name="no_alumno" value="<?php echo "$codigo";?>"> 
							  <button type="submit" class="btn btn-primary">Imprimir Constancia</button>
							  
                    </div>
                    </form>
                
                <?php
                        
                    }
                    else{
                ?>
                <h1>Ficha de Inscripcion</h1>
                					<div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$da";?>">
							  </div>
							     
                              <?php 
                                $querycod =   mysql_query("SELECT `id_alumno` FROM `alumno` ORDER BY id_alumno DESC");
                                $rcod     =   mysql_fetch_array($querycod);
                                $cod    =   $rcod['id_alumno'] + 1;
                              ?>
                                   <label class="control-label" for="codigo">Código: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="codigo" name="codigo" value="<?php echo"$cod";?>">
							  </div>
                              
                              <label class="control-label" for="ciclo">Ciclo: </label>
                                        <div class="controls">
								           
                                            <select id="ciclo" name="ciclo" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    
                                                    $query_ciclo = mysql_query("SELECT `ciclo` FROM `ciclo`");
                                                                                                                                                
                                      
                                                    while($rciclo     = mysql_fetch_array($query_ciclo)){
                                                        $ciclo   =   $rciclo['ciclo'];
                                                        
                                                ?>
                                                        <option value="<?php echo "$ciclo";?>"><?php echo "$ciclo";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div>
                              
                                 <label class="control-label" for="nombre">Nombres: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="nombre" name="nombre">
							  </div>
                              <label class="control-label" for="apellido">Apellidos: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="apellido" name="apellido">
							  </div>
                              <label class="control-label" for="f_nac">Fecha Nacimiento:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="f_nac" name="f_nac" value="<?php echo "$da";?>">
							  </div>
                              <label class="control-label" for="edad">Edad: </label>
                                  <div class="controls">
								<input type="text" class="input-small typeahead" id="edad" name="edad">
							  </div>
                             <table>
                                  <tr>
                                      <td>
                               	<label class="control-label" for="direccion">Direccion: </label>
								 <div class="controls">
								<input type="text" class="input-xlarge typeahead" id="direccion" name="direccion" >
							  </div>
                              <label class="control-label" for="n_encarga">Nombre de encargado: </label>
								 <div class="controls">
								<input type="text" class="input-xlarge typeahead" id="n_encarga" name="n_encarga" >
							  </div>
                              
                                   <label class="control-label" for="tel">Teléfono: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="tel" name="tel" >
							  </div>
                                 </td>
                                
                                     <td>
                              <label class="control-label" for="jornada">Jornada: </label>
                                        <div class="controls">
								           
                                            <select id="jornada" name="jornada" onchange="search_cliente(this.value);" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    
                                                    $query_plan = mysql_query("SELECT `id_jornada`,`jornada` FROM `jornada`");
                                                                                                                                                
                                      
                                                    while($rp     = mysql_fetch_array($query_plan)){
                                                        $id_jornada   =   $rp['id_jornada'];
                                                        $jornada      =   $rp['jornada'];
                                                ?>
                                                        <option value="<?php echo "$id_jornada";?>"><?php echo "$jornada";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div>
                              
                              <label class="control-label" for="curso">Curso: </label>
                                        <div class="controls">
								           
                                            <select id="curso" name="curso" onchange="search_cliente(this.value);" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    
                                                    $query_curso = mysql_query("SELECT `id_curso`,`nombre_curso` FROM `cursos` ");
                                                    
                                                  
                                                    while($rc   = mysql_fetch_array($query_curso)){
                                                        $id_curso   = $rc['id_curso'];
                                                        $curso      =   $rc['nombre_curso'];
                                                ?>
                                                        <option value="<?php echo "$id_curso";?>"><?php echo "$curso";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div>
                              
                              
                              <label class="control-label" for="horario">Horario: </label>
                                        <div class="controls">
								           
                                            <select id="horario" name="horario" onchange="search_cliente(this.value);" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    
                                                    $query_horario = mysql_query("SELECT `id_horarios`,`hora` FROM `horarios`");
                                                    
                                                  
                                                    while($rh     = mysql_fetch_array($query_horario)){
                                                        $id_horario   =   $rh['id_horarios'];
                                                        $hora         =   $rh['hora'];
                                                ?>
                                                        <option value="<?php echo "$id_horario";?>"><?php echo "$hora";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div></td></tr><br>
                              
                              </table>
                              
                            <br>    
                             
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
       <?php }}else{echo "Usuario no autoriado!";}?>
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
