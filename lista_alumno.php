<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    //$security = "go"; // Mientras la seguridad no se aplica!
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
	
	<!-- end: CSS -->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<?php
    if(empty($_POST)===false && $_POST['id_old']!=""){
        $id     =   $_POST['id_old'];
        $opt    =   $_POST['fla'];
        
        if($opt != 'trash'){
       
        
        
        }else{
            $query7 = mysql_query("DELETE FROM `alumno` WHERE CONCAT(`alumno`.`id_alumno`) = '$id'");
            $query8 = mysql_query("DELETE FROM `pagos` WHERE CONCAT(`pagos`.`id_user`) = '$id'");
            
            
            $d          =   "Elimino alumno: ";
            $t          =   "alumno";
        
         insert_logs($da, $u, $d, $t, $id);
        }
        //************* FINISH: QUERY PARA CREACION DE CUENTAS POR PAGAR***************
       
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
				<a class="brand" href="index.php"><span><?php echo "$nombre_p "; ?></span></a>
								
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
                    <a href="#"> Alumnos </a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Listado de Alumnos</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <!--INICIA TABLA DE MANTENIMIENTO------------------------------------->
                <h1>Listado de Alumnos</h1>
            <div class="box-content">
                <table>
                    <tr>
                        <td>
                            <form name="this2" method="post" action="inscrip.php">
                    <button type="submit" class="btn btn-info"><i class="glyphicons-icon white circle_plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALUMNO</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </form>
                        </td>
                    </tr>
                </table>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>FECHA</th>
                                  <th>NOMBRE DE ALUMNO</th>
                                  <th>CURSO</th>
                                  <th>PLAN</th>
                                  <th>HORARIO</th>
                                  <th>ENCARGADO</th>
                                  <th>TELEFONO</th>
                                  <th>ACCION</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            //$u  =   $_SESSION['u'];
                            //$u = "admin";
                          //  if($u != "admin"){
                        //    $query3 =   mysql_query("SELECT `id_vendedor`,`id_user` FROM `vendedores` WHERE id_user = '$u'");
                          //  $r3     =   mysql_fetch_array($query3);
                        //    $id_busqueda  =   $r3['id_vendedor'];
                          //  $query_todo   =   mysql_query("SELECT `id_pedido`,`fecha_pedido`,`fecha_despacho`,`id_cliente`,`id_vendedor`,`estatus_factu` FROM `pedidos_cabecera` WHERE id_vendedor = '$id_busqueda' AND estatus_factu = 0 ORDER BY id_pedido DESC");
                          //  }else{
                            //    $query_todo   =   mysql_query("SELECT `id_pedido`,`fecha_pedido`,`fecha_despacho`,`id_cliente`,`id_vendedor`,`estatus_factu`,`total` FROM `pedidos_cabecera` WHERE estatus_factu = 0 ORDER BY id_pedido DESC");
                        //    }
    
                             $query_todo    =   mysql_query("SELECT * FROM `alumno`  ORDER BY id_alumno ASC");
    
                              while($search=mysql_fetch_array($query_todo)){
                                 
                                  $id         =   $search['id_alumno'];
                                  $fecha       =   $search['fecha_creacion'];
                                  $nombres    =   $search['nombres'];
                                  $apellidos   =   $search['apellidos'];
                                  $nombre_completo = $apellidos . ", " . $nombres;
                                  $curso       =   $search['nivel'];
                                  $plan       =   $search['id_jornada'];
                                  $horario       =   $search['id_horario'];
                                  $encargado       =   $search['nombre_encargado'];
                                  $tel       =   $search['telefono'];
                                  
                                  
                                  
                                  $query4   =   mysql_query("SELECT `id_curso`,`nombre_curso` FROM `cursos` WHERE id_curso = '$curso'");
                                  $r4       =   mysql_fetch_array($query4);
                                  $curso  =   $r4['nombre_curso'];
                                  
                                  $query5   =   mysql_query("SELECT `id_jornada`,`jornada` FROM `jornada` WHERE id_jornada = '$plan'");
                                  $r5       =   mysql_fetch_array($query5);
                                  $plan  =   $r5['jornada'];
                                  
                                  $query6   =   mysql_query("SELECT `id_horarios`,`hora` FROM `horarios` WHERE id_horarios = '$horario'");
                                  $r6       =   mysql_fetch_array($query6);
                                  $horario  =   $r6['hora'];
                                 
                          ?>
							<tr>
								<td class="center"><?php echo "$fecha";?></td>
                                <td class="center"><?php echo "$nombre_completo";?></td>
                                <td class="center"><?php echo "$curso";?></td>
                                <td class="center"><?php echo "$plan";?></td>
                                <td class="center"><?php echo "$horario";?></td>
                                <td class="center"><?php echo "$encargado";?></td>
                                <td class="center"><?php echo "$tel";?></td>
                                <td class="center">
                                    <table border="0">
                                        <tr>
                                            <!--
                                            <td>
                                                <form name="this1" method="post" action="edit_clientes.php">
                                                    <button type="submit" class="btn btn-info"><i class="halflings-icon white print"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>"> 
                                                     
                                                </form>
                                            </td>
                                            -->
                                            <td>
                                                <form name="this" method="post" action="alum_edit.php">
                                                    <input type="hidden" id="alum" name="alum" value="<?php echo "$id";?>"> 

                                                    <button type="submit" class="btn btn-warning"><i class="halflings-icon white edit"></i></button>
                                                    
                                                </form>
                                            </td>
                                           
                                            <td>
                                                <form name="this1" method="post" >
                                                    <button type="submit" class="btn btn-danger" onclick="if(confirm('Desea eliminar este alumno ')){
                                                    this.form.submit();}
                                                    else{ return false;
                                                    }" ><i class="halflings-icon white trash"></i></button>
                                                    <input type="hidden" id="id_old" name="id_old" value="<?php echo "$id";?>"> 
                                                    <input type="hidden" id="fla" name="fla" value="trash">
                                                     
                                                </form>
                                            </td>
                                            <td>
                                                <form name="this1" method="post" action="pago_vista.php">
                                                    <button type="submit" class="btn btn-info"><i class="halflings-icon white search"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>"> 
                                                </form>
                                            </td>
                                            <td>
                                                <form name="this1" method="post" action="pagos_mes.php">
                                                    <button type="submit" class="btn btn-success"><i class="halflings-icon white folder-open"></i></button>
                                                    <input type="hidden" id="cod" name="cod" value="<?php echo "$id";?>"> 
                                                </form>
                                            </td>
                                            <td>
                                            <form id="con_inscrip" method="post" action="print_inscrip.php">
                                                <div class="form-actions">
                                                    <input type="hidden" id="no_alumno" name="no_alumno" value="<?php echo "$id";?>"> 
                                                    <button type="submit" class="btn btn-primary">Imprimir Constancia</button>

                                                </div>
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
	
	<?php require 'footer.php'; ?>
	
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
