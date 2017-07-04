<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    //error_reporting(0);
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
	
		
		
<link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
<style type="text/css">
    a.fancybox img {
        border: none;
        box-shadow: 0 1px 7px rgba(0,0,0,0.6);
        -o-transform: scale(1,1); -ms-transform: scale(1,1); -moz-transform: scale(1,1); -webkit-transform: scale(1,1); transform: scale(1,1); -o-transition: all 0.2s ease-in-out; -ms-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out;
    } 
    a.fancybox:hover img {
        position: relative; z-index: 999; -o-transform: scale(1.03,1.03); -ms-transform: scale(1.03,1.03); -moz-transform: scale(1.03,1.03); -webkit-transform: scale(1.03,1.03); transform: scale(1.03,1.03);
    }
</style>		
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
                    <a href="lista_alumno.php">Lista de Alumnos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Vista de Pagos a Alumnos</a>
                    
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                     
                    $id_control   =   $_POST['control'];
                    
                                //array de archivos disponibles
                                $archivos_disp_ar = array('jpg', 'jpeg', 'gif', 'png');
                                //carpteta donde vamos a guardar la imagen
                                $carpeta = 'recibos/';
                                //recibimos el campo de imagen
                                $imagen = $_FILES['archivo']['tmp_name'];
                                //guardamos el nombre original de la imagen en una variable
                                $nombrebre_orig = $_FILES['archivo']['name'];
                                //el proximo codigo es para ver que extension es la imagen
                                $array_nombre = explode('.',$nombrebre_orig);
                                $cuenta_arr_nombre = count($array_nombre);
                                $extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
                                //creamos nuevo nombre para que tenga nombre unico
                                $nombre_nuevo = time().'_'.rand(0,100).'.'.$extension;
                                //nombre nuevo con la carpeta
                                $nombre_nuevo_con_carpeta = $carpeta.$nombre_nuevo;
                   
                    
                   
                        $query2 =   mysql_query("UPDATE `pagos_abonos` SET `archivo` = '$nombre_nuevo' WHERE CONCAT(`pagos_abonos`.`id`) = '$id_control'");
                    $resultado = mysql_fetch_array($$query2);
                    $mover_archivos = move_uploaded_file($imagen , $nombre_nuevo_con_carpeta);
                    
                     $flag1 = "guardar";
                }
                
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
         
                
                //INICIA INGRESO DE DATOS DE CUENTAS POR PAGAR--------------------
                ?>
                <h1>Vista de abonos a proveedores</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                                $id         =    $_POST['cod'];
                                $query1     =    mysql_query("SELECT `id_alumno`,`ciclo`,`nombres`,`apellidos`,`total`,`saldo` FROM alumno WHERE id_alumno = '$id'");
                                $r1         =    mysql_fetch_array($query1);
                                
                                $codigo_a   =    $r1['id_alumno']. " / " .$r1['ciclo'];
                                $total_a    =    $r1['total'];
                                $saldo      =    $r1['saldo'];
                                $nombres    =    $r1['nombres']. " " .$r1['apellidos'];
                               
                                
                                
                        ?>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
                             
                            <div class="control-group">
                             <label class=" control-label" for="no_documento">NO. DE ALUMNOS: </label>
                                  <div class="controls">      
								<input type="text" class="input-medium typeahead" id="no_documento" name="no_documento" value="<?php echo $codigo_a; ?>" >
							  </div>   
                            <label class=" control-label" for="pro">ALUMNO: </label>
                            <div class="controls">      
				                <input type="text" class="input-xlarge typeahead" id="pro" name="pro" value="<?php echo $nombres; ?>" >
				            </div>   
                                <label class=" control-label" for="tot_factura">TOTAL AÑO: </label>
                              <div class="controls">
								<input type="text" class="input-small typeahead" id="tot_factura" name="tot_factura" value="<?php echo $total_a; ?>">
							  </div> 
                                <label class=" control-label" for="saldo">SALDO: </label>
                                  <div class="controls">
								<input type="text" class="input-small typeahead" id="saldo" name="saldo" value="<?php echo $saldo; ?>">
							  </div> 
                                
                            <br>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                        <th>FECHA</th>
                                        <th>CANTIDAD DE PAGO</th>
                                        <th>FORMA DE PAGO</th>
                                        <th>NO. DE DOCUMENTO DE PAGO</th>
                                        <th>DESCRIPCION</th>
                                        <th>RECIBO</th>
                                      </tr>
                                  </thead>
                                  <?php
                                    $query7 =   mysql_query("SELECT `id`, `control`, `cantidad`, `fecha`, `no_doc`, `archivo`, `forma_pago`, `descrip` FROM `pagos_abonos` WHERE control = '$id'");
                                    while($r7=mysql_fetch_array($query7)){
                                        $cantidad   =   $r7['cantidad'];
                                        $fecha      =   $r7['fecha'];
                                        $no_doc     =   $r7['no_doc'];
                                        $fpago      =   $r7['forma_pago'];
                                        $descrip    =   $r7['descrip'];
                                        $recibo     =   $r7['archivo'];
                                        $idcxc_a    =   $r7['id'];
                                        $total      =   $total + $cantidad;
                                        
                                   
                                  ?>
                                  <tr>
                                      <td>
                                        <?php echo "$fecha";?>
                                      </td>
                                      <td>
                                        <?php echo "$cantidad";?>
                                      </td>
                                      <td>
                                        <?php echo "$fpago";?>
                                      </td>
                                      <td>
                                        <?php echo "$no_doc";?>
                                      </td>
                                      <td>
                                        <?php echo "$descrip";?>
                                      </td>
                                      <td class="center"> 
                                          <?php
                                        
                                        if($recibo=="")
                                        {
                                            ?>
                                          <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <label class=" control-label" for="archivo">RECIBO DE BANCO: </label>
                              <div class="controls">
                              <input type="file" accept="image/*" name="archivo" id="archivo" size="25" />
                              </div><br>
                                              
                            <div class="form-actions">
                          
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag1" name="flag1" value="guardar">
                                <input type="hidden" id="control" name="control" value="<?php echo $idcxc_a; ?>">
                                
							</div>
                                              </form>
                                          <?php
                                            }else{
                                        echo'<img class="recibo" onclick=”zoomToggle(’50px’,’50px’,’50px’,’50px’,this);” width=”50″ height=”50″ src="recibos/'.$recibo.'" alt="recibo"/>';
                                                  }                            
                                        
                                        ?>
                                      </td>
                                  </tr>
                                    <?php } ?>
                                     <tr>
                                      <td>
                                        <b>TOTAL</b>
                                      </td>
                                      <td>
                                        <?php 
                                            $total = number_format("$total",2);
                                            echo "<b>$total</b>";
                                        ?>
                                      </td>
                                  </tr>
                              </table>
							</div>
						      
							<!--<div class="form-actions">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <input type="hidden" id="flag1" name="flag1" value="guardar">
                                <input type="hidden" id="control" name="control" value="<?php echo $id; ?>">
							</div>-->
						  </fieldset>
						</form>   
               
                    
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>comision pagada con exito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
    </div>
    <?php }else{ ?>
    Usuario no registrado!
    <?php } ?>
		
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
	
	<?php require 'footer.php';?>
	
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
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
<script type="text/javascript">
    $(function($){
        var addToAll = true;
        var gallery = false;
        var titlePosition = 'inside';
        $(addToAll ? 'img' : 'img.fancybox').each(function(){
            var $this = $(this);
            var title = $this.attr('title');
            var src = $this.attr('data-big') || $this.attr('src');
            var a = $('<a href="#" class="fancybox"></a>').attr('href', src).attr('title', title);
            $this.wrap(a);
        });
        if (gallery)
            $('a.fancybox').attr('rel', 'fancyboxgallery');
        $('a.fancybox').fancybox({
            titlePosition: titlePosition
        });
    });
    $.noConflict();
</script>
	<!-- end: JavaScript-->
	
</body>
</html>