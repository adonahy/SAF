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
                    <a href="#">Pago Mes</a>
                    
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                    
                   /* if($_FILES['archivo']['name']){
                            $new_file_name = basename($_FILES["archivo"]["name"]);
                            $target_dir = "recibos/";
                            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
                            //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file);
                        }*/
                   
                    $fpago     =    $_POST['f_pago'];
                    $docdepos  =    $_POST['no_doc_pago'];
                    $control   =    $_POST['control'];
                    $abono     =    $_POST['cantidad_abono'];
                    $bancotodo =    $_POST['banco'];
                    $documento =    $_POST['documento'];
                    $descrip   =    $_POST['descripcion'];
                    $proveedor =    $_POST['proveedor'];
                    $bancotodo_length  = strlen($bancotodo);
                    $esta              = strpos("$bancotodo", "-");

                    $banco          = substr($bancotodo,0,$esta);
                    $pos            = $esta + 1;
                    $cuenta         = substr($bancotodo,$pos,$bancotodo_length);
                    
                   
                    
                    $inscrip    =   $_POST['inscrip'];
                    $manten     =   $_POST['manten'];
                    $papeleria  =   $_POST['papeleria'];
                    $enero      =   $_POST['enero'];
                    $febrero    =   $_POST['febrero'];
                    $marzo      =   $_POST['marzo'];
                    $abril      =   $_POST['abril'];
                    $mayo       =   $_POST['mayo'];
                    $junio      =   $_POST['junio'];
                    $julio      =   $_POST['julio'];
                    $agosto     =   $_POST['agosto'];
                    $sept       =   $_POST['sept'];
                    $octu       =   $_POST['octu'];
                    $nov        =   $_POST['nov'];
                    
                    
                     $new_file_name = basename($_FILES["archivo"]["name"]);
                    
                    if($new_file_name==""){
                        
                        
                        
                        $query3 =   mysql_query("INSERT INTO `pagos_abonos`(`id`, `control`, `cantidad`, `banco`, `cuenta`, `no_doc`, `archivo`, `forma_pago`, `descrip`, `fecha`) VALUES (NULL,'$control','$abono','$banco','$cuenta','$docdepos','','$fpago','$descrip','$da')");
                        
                        
                    }else{
                        
                        
                    
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
                        
                        $query3 =   mysql_query("INSERT INTO `pagos_abonos`(`id`, `control`, `cantidad`, `banco`, `cuenta`, `no_doc`, `archivo`, `forma_pago`, `descrip`, `fecha`) VALUES (NULL,'$control','$abono','$banco','$cuenta','$docdepos','$nombre_nuevo','$fpago','$descrip','$da')");
                    $resultado = mysql_fetch_array($$query3);
                    $mover_archivos = move_uploaded_file($imagen , $nombre_nuevo_con_carpeta);
                    }
                    
                    
                    
                    
                    $query4 =   mysql_query("UPDATE `pagos` SET `inscripcion` = '$inscrip', `enero` = '$enero', `febrero` = '$febrero', `marzo` = '$marzo', `abril` = '$abril', `mayo` = '$mayo', `junio` = '$junio', `julio` = '$julio', `agosto` = '$agosto', `sept` = '$sept',`oct` = '$octu', `nov` = '$nov', `mant` = '$manten', `papeleria` = '$papeleria'  WHERE CONCAT(`pagos`.`id_user`) = '$control'");
                    
                    $query8 =   mysql_query("SELECT `id`,`saldo`,`banco`,`cuenta` FROM `estados_cuenta` WHERE banco = '$banco' AND cuenta = '$cuenta' ORDER BY id DESC LIMIT 1");
                    $r8     =   mysql_fetch_array($query8);
                    $saldo_banco=   $r8['saldo'] + $abono;
                    
                    $query6 =   mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES ('NULL', '$da', '$docdepos', 'pago de alumno: $control', '$abono', '0', '$saldo_banco', '$banco', '$cuenta')");
                    
                    $saldo_t    =   $_POST['saldo'];
                    $pendiente  =  $saldo_t - $abono;
                                      
                                        
                    $query_ab   =   mysql_query("UPDATE `alumno` SET `saldo` = '$pendiente' WHERE id_alumno = '$control'");
                    
                    if($saldo <= 0){
                        $query2 =   mysql_query("UPDATE `cxp` SET `estatus` = '1' WHERE CONCAT(`cxp`.`id_control`) = '$control'");
                    }
                     $flag1 = "guardar";
                }
                
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
         
                
                //INICIA INGRESO DE DATOS DE CUENTAS POR PAGAR--------------------
                ?>
                <h1>Pago de alumnos</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                                $id =       $_POST['cod'];
                                $query1=    mysql_query("SELECT `id_alumno`,`ciclo`,`nombres`,`apellidos`,`horario`,`edad`,`fecha_nac`,`direccion`,`nombre_encargado`,`telefono`,`nivel`,`id_horario`,`id_jornada`,`total`,`saldo`,`fecha_creacion` FROM `alumno` WHERE id_alumno = '$id'");
                                $r1 =       mysql_fetch_array($query1);
                                $id_alumno   = $r1['id_alumno'];
                                $ciclo       = $r1['ciclo'];
                                $nombres     = $r1['nombres'];
                                $apellidos   = $r1['apellidos'];
                                $horarios    = $r1['horario'];
                                $edad        = $r1['edad'];
                                $fnac        = $r1['fecha_nac'];
                                $direccion   = $r1['direccion'];
                                $nencargado  = $r1['nombre_encargado'];
                                $tel         = $r1['telefono'];
                                $nivel       = $r1['nivel'];
                                $id_horario  = $r1['id_horario'];
                                $id_jornada  = $r1['id_jornada'];
                                $f_creacion  = $r1['fecha_creacion'];
                                $saldo       = $r1['saldo'];
                                $total       = $r1['total'];
                                
                                $query7 =   mysql_query("SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedores` WHERE id_proveedor = '$proveedor'");
                                $r7     =   mysql_fetch_array($query7);
                                $proveedor= $r7['nombre_proveedor'];
                                
                                
                          
                                $query2  =   mysql_query("SELECT * FROM `pagos` WHERE id_user = '$id'");
                                $r2      =   mysql_fetch_array($query2);
                                
                                                
                                $inscrip      =   $r2['inscripcion'];
                                $enero        =   $r2['enero'];
                                $febrero      =   $r2['febrero'];
                                $marzo        =   $r2['marzo'];
								$abril        =   $r2['abril'];
                                $mayo         =   $r2['mayo'];
                                $junio        =   $r2['junio'];
                                $julio        =   $r2['julio'];
                                $agosto       =   $r2['agosto'];
                                $sept         =   $r2['sept'];
                                $octu         =   $r2['oct'];
                                $nov          =   $r2['nov'];
                              
                                $mantenimiento =   $r2['mant'];
                                $papeleria    =   $r2['papeleria'];
                               
                                
                                
                        ?>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
                            <div class="control-group">
                                
								<label class="control-label" for="banco">BANCO Y CUENTA: </label>
								<div class="controls">
								  <select id="banco" name="banco" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `bancos`");
                                      
                                      while($result_bancos=mysql_fetch_array($query)){
                                        $r=$result_bancos['nombre'];
                                        $r2=$result_bancos['cuenta'];  
                                    ?>
                                      <option value="<?php echo "$r";?>-<?php echo "$r2";?>"><?php echo "$r";?> - <?php echo "$r2";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  <br>
                             <label class=" control-label" for="no_documento">CODIGO ALUMNO: </label>
                                  <div class="controls">      
								<input type="text" class="input-medium typeahead" id="no_documento" name="no_documento" value="<?php echo $id_alumno. " / " . $ciclo; ?>" disabled>
							  </div>   
                                <label class=" control-label" for="tot_factura">TOTAL AÑO: </label>
                              <div class="controls">
								<input type="text" class="input-small typeahead" id="tot_factura" name="tot_factura" value="<?php echo $total; ?>" disabled>
							  </div> 
                                <label class=" control-label" for="saldo1">SALDO: </label>
                                  <div class="controls">
								<input type="text" class="input-small typeahead" id="saldo1" name="saldo1" value="<?php echo $saldo; ?>" disabled>
							  </div> 
                            <label class=" control-label" for="cantidad_abono">CANTIDAD DE A ABONAR: </label>
                              <div class="controls">
								<input type="text" class="input-small typeahead" id="cantidad_abono" name="cantidad_abono" value="">
							  </div> <br>
                                 <label class=" control-label" for="cantidad_abono">NO. DE DOCUMENTO DE PAGO: </label>
                              <div class="controls">
								<input type="text" class="input-small typeahead" id="no_doc_pago" name="no_doc_pago" value="">
							  </div> <br>
                                <label class=" control-label" for="f_pago">FORMA DE PAGO: </label>
                              <div class="controls">
								<select id="f_pago" name="f_pago" data-rel="chosen">
                                    <option value=""></option>
                                    <option value="Deposito">Deposito</option>
                                    <option value="Transacción">Transacción</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Efectivo">Efectivo</option>
                                  </select>
							  </div>
                                <label class=" control-label" for="archivo">RECIBO DE BANCO: </label>
                              <div class="controls">
                              <input type="file" accept="image/*" name="archivo" id="archivo" size="25" />
                              </div><br>
                                
                                 <label class=" control-label" for="descripcion">DESCRIPCION: </label>
                                  <div class="controls">
                                      
								<input type="text" class="input-xlarge typeahead" id="descripcion" name="descripcion" >
							  </div>
                                <BR><BR><BR>
                                <table class="controls" width="60%" border="0"><!-- inicia tabla de ordenamiento para los permisos -->
                                      <tr>
                                          <!--<td width="13%">$codigo</td>
                                          <td height="5" style="font-size:6px">&nbsp;</td>-->
                                          <th width="32%" align="center">
                                              <?php
                                                if($inscrip > 0){
                                              ?>
                                            <input type="checkbox" onclick="alumnos();" id="inscrip1" name="inscrip1" value="1" checked disabled>
                                              <input type="hidden"  id="inscrip" name="inscrip" value="1">
                                              Inscripción
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="alumnos();" id="inscrip" name="inscrip" value="1"> Inscripción
                                              <?php } ?>
                                          </td>
                                          <th width="36%" align="center">
                                            
                                               <?php
                                                if($gastos > 0){
                                              ?>
                                            <input type="checkbox" onclick="gastos();" id="gasto" name="gasto" value="1" checked> Pagos Extras
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" onclick="gastos();" id="gasto" name="gasto" value="1"> Pagos Extras
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
                                                if($enero > 0){
                                              ?>
                                            <input type="checkbox" id="enero1" name="enero1" value="1" checked disabled>
                                              <input type="hidden"  id="enero" name="enero" value="1">Enero
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="enero" name="enero" value="1"> Enero
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($mantenimiento > 0){
                                              ?>
                                            <input type="checkbox" id="manten1" name="manten1" value="1" checked disabled>
                                              <input type="hidden"  id="manten" name="manten" value="1">Mantenimiento
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="manten" name="manten" value="1" > Mantenimiento
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
                                                if($febrero > 0){
                                              ?>
                                            <input type="checkbox" id="febrero1" name="febrero1" value="1" checked disabled>
                                              <input type="hidden"  id="febrero" name="febrero" value="1">Febrero
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="febrero" name="febrero" value="1"> Febrero
                                              <?php } ?>
                                          </td>
                                          <td width="33%" align="left" >
                                            
                                              <?php
                                                if($papeleria > 0){
                                              ?>
                                            <input type="checkbox" id="papeleria1" name="papeleria1" value="1" checked disabled>
                                              <input type="hidden"  id="papeleria" name="papeleria" value="1">Papeleria
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="papeleria" name="papeleria" value="1"> Papeleria
                                              <?php } ?>
                                          </td>
                                          <td width="34%" align="left">
                                            
                                             &nbsp; 
                                          </td>
                                      </tr>
                                      <tr>
                                          <td width="33%" align="left">
                                            
                                              <?php
                                                if($marzo > 0){
                                              ?>
                                            <input type="checkbox" id="marzo1" name="marzo1" value="1" checked disabled>
                                              <input type="hidden"  id="marzo" name="marzo" value="1">Marzo
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="marzo" name="marzo" value="1"> Marzo
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
                                                if($abril > 0){
                                              ?>
                                            <input type="checkbox" id="abril1" name="abril1" value="1" checked disabled>
                                              <input type="hidden"  id="abril" name="abril" value="1">Abril
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="abril" name="abril" value="1"> Abril
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
                                            
                                              <?php
                                                if($mayo > 0){
                                              ?>
                                            <input type="checkbox" id="mayo1" name="mayo1" value="1" checked disabled>
                                              <input type="hidden"  id="mayo" name="mayo" value="1">Mayo
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="mayo" name="mayo" value="1"> Mayo
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
                                                if($junio > 0){
                                              ?>
                                            <input type="checkbox" id="junio1" name="junio1" value="1" checked disabled>
                                              <input type="hidden"  id="junio" name="junio" value="1">Junio
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="junio" name="junio" value="1"> Junio
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
                                                if($julio > 0){
                                              ?>
                                            <input type="checkbox" id="julio1" name="julio1" value="1" checked disabled>
                                              <input type="hidden"  id="julio" name="julio" value="1">Julio
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="julio" name="julio" value="1"> Julio
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
                                                if($agosto > 0){
                                              ?>
                                            <input type="checkbox" id="agosto1" name="agosto1" value="1" checked disabled>
                                              <input type="hidden"  id="agosto" name="agosto" value="1">Agosto
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="agosto" name="agosto" value="1"> Agosto
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
                                                if($sept > 0){
                                              ?>
                                            <input type="checkbox" id="sept1" name="sept1" value="1" checked disabled>
                                              <input type="hidden"  id="sept" name="sept" value="1">Septiembre
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="sept" name="sept" value="1"> Septiembre
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
                                                if($octu > 0){
                                              ?>
                                            <input type="checkbox" id="octu1" name="octu1" value="1" checked disabled>
                                              <input type="hidden"  id="octu" name="octu" value="1">Octubre
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="octu" name="octu" value="1"> Octubre
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
                                                if($nov > 0){
                                              ?>
                                            <input type="checkbox" id="nov1" name="nov1" value="1" checked disabled>
                                              <input type="hidden"  id="nov" name="nov" value="1">Noviembre
                                                <?php
                                                }else{
                                                ?>
                                            <input type="checkbox" id="nov" name="nov" value="1"> Noviembre
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
                                            &nbsp;
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
                                <input type="hidden" id="flag1" name="flag1" value="guardar">
                                <input type="hidden" id="control" name="control" value="<?php echo $id; ?>">
                                <input type="hidden" id="proveedor" name="proveedor" value="<?php echo $proveedor; ?>">
                                <input type="hidden" id="documento" name="documento" value="<?php echo $nombres; ?>">
                                <input type="hidden" id="saldo" name="saldo" value="<?php echo $saldo; ?>">
							</div>
						  </fieldset>
						</form>   
               
                    
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Abono ingresado con éxito!</h3>";
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
	<!-- end: JavaScript-->
	
</body>
</html>
