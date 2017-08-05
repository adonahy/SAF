<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>SAF</title>
	<meta name="description" content="SAF">
	<meta name="author" content="Mariles">
	
	<!-- end: Meta -->
	
	
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
                    <a href="#">Ventas</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_facturas.php">Pre-orden de Compras</a>
                   
                </li>
			</ul>
                <?php
                if($security == 'go'){
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="next"){
                        $factura    =   $_POST['factura'];
                        $serie      =   $_POST['serie'];
                        $tipo_fac   =   $_POST['tipo_factura'];
                        $fecha      =   $_POST['date01'];
                        $id_cliente =   $_POST['codigo'];
                        $pedido     =   $_POST['pedido'];
                        $total      =   0;
                        $estatus    =   0;
                    
                        
                        
                        $query2     =   mysql_query("INSERT INTO `factu_principal` (`no_factura`, `serie`, `tipo_factura`, `fecha`, `id_cliente`, `pedido`, `total`, `estatus`) VALUES (NULL, '$serie', '$tipo_fac', '$fecha', '$id_cliente', '$pedido', '$total', '$estatus')");
                        
                        insert_logs($da, $u, $d, $t, $factura);
                        //echo "<h3>Orden de compra ingresada con éxito!</h3>";
                        $flag1  =   "next";
                }
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
                //INICIA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                        $conta        =   $_POST['contador'];
                        $factu        =   $_POST['factu'];
                        $serie        =   $_POST['serie'];
                        
                        $count = 0;
                        $total_f = 0;
                        while($count < $conta){ 
                            $count      =   $count + 1;
                            $name_sel   =   "sel" . $count;
                            $sel        =   $_POST["$name_sel"];
                            
                            $query3     =   mysql_query("SELECT `id_control`,`id_pedido`,`codigo`,`cantidad`,`producto`,`precio_u`,`total` FROM pedidos_secundaria WHERE id_control = '$sel'");
                            $r3         =   mysql_fetch_array($query3);
                            $codigo     =   $r3['codigo'];
                            $cantidad   =   $r3['cantidad'];
                            $des        =   $r3['producto'];
                            $pu         =   $r3['precio_u'];
                            $total      =   $r3['total'];
                            $pedido     =   $r3['id_pedido'];
                            $total_f    =   $total_f + $total;
                        
                        if($codigo!=""){
                        $query2     =   mysql_query("INSERT INTO `factu_secundaria` (`control`, `no_factura`, `serie`, `codigo`, `cantidad`, `descripcion`, `p_unitario`, `total`) VALUES (NULL, '$factu', '$serie', '$codigo', '$cantidad', '$des', '$pu', '$total')");
                        //INICIA QUERY PARA LA DESCARGA DEL INVENTARIO Y KARDEX-----------------------
                        $query4 =   mysql_query("SELECT `codigo`,`cantidad` FROM inventario_central WHERE codigo = '$codigo'");
                        $r4     =   mysql_fetch_array($query4);
                        $cantidad_inventario = $r4['cantidad'];
                        $cantidad_inventario = $cantidad_inventario - $cantidad;
                        
                        $query5 =   mysql_query("UPDATE `inventario_central` SET `cantidad` = '$cantidad_inventario' WHERE CONCAT(`inventario_central`.`codigo`) = '$codigo'");
                        
                        $query6 =   mysql_query("UPDATE `factu_principal` SET `total` = '$total_f' WHERE CONCAT(`factu_principal`.`no_factura`) = '$factu' AND `serie` = '$serie'");
                        
                        $query7 =   mysql_query("INSERT INTO `kardex_pt` (`id_kardex`, `fecha`, `codigo`, `observaciones`, `debe`, `haber`, `saldo`) VALUES (NULL, '$da', '$codigo', 'Facturación del producto', '$cantidad', '0', '$cantidad_inventario')");
                            
                        $query8 =   mysql_query("UPDATE `pedidos_cabecera` SET `estatus_factu` = '1' WHERE CONCAT(`pedidos_cabecera`.`id_pedido`) = '$pedido'");
                        //TERMINA QUERY PARA LA DESCARGA DEL INVENTARIO Y KARDEX-----------------------
                        }
                           // echo "$cod, $des, $ref, $can, $cos, $tot <br>";
                        }
                    
                        $flag1  =   "guardar";
                }
                //FINALIZA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                
                //INICIA LA CABECERA DE EL PEDIDO--------------------
                ?>
                <h1>Ingreso Facturas</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
                             <label class=" control-label" for="factura">NO. FACTURA: </label>
                                  <div class="controls">
                                      <?php
                                        $query1     =   mysql_query("SELECT `no_factura` FROM `factu_principal` ORDER BY `no_factura` DESC LIMIT 1");
                                        $result1    =   mysql_fetch_array($query1);
                                        $codigo     =   $result1['no_factura'] + 1;
                                      ?>
								<input type="text" class="input-medium typeahead" id="factura" name="factura" value="<?php echo "$codigo";?>">
							  </div><br>    
							</div>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                
                                <tr>
                                    <td>
                                        <label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="nombre_cliente" name="nombre_cliente">
							            </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
							    <tr>
                                    <td>
                                        <label class="control-label" for="dir_fiscal">DIRECCION: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="dir_fiscal" name="dir_fiscal">
							            </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    
                                        <td>
                                        <label class="control-label" for="nit">NIT: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="nit" name="nit">
							            </div>
                                    
                                    </td>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <select id="vendedor" name="vendedor" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    $query2   =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM `vendedores` ORDER BY `id_vendedor` DESC");
                                      
                                                    while($result2=mysql_fetch_array($query2)){
                                                        $name       =   $result2['nombre_vendedor'];
                                                        $last_name  =   $result2['apellido_vendedor'];
                                                        $id         =   $result2['id_vendedor'];
                                                ?>
                                                        <option value="<?php echo "$id";?>"><?php echo "$name $last_name";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
								        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
							</div>
                        
							<div class="form-actions">
                            <?php
                                if($flag1=="no"){
                            ?>
							  <button type="submit" class="btn btn-primary">Buscar</button>
                              <input type="hidden" id="flag1" name="flag1" value="yes">
                            <?php
                                }else{
                            ?>
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
                                
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>   
                                <?php
                                //-----------FINALIZA LA CABECERA DE EL PEDIDO----------------
                                    }else if($flag1=="next"){
                                //-----------INICIA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                                        $f          =   $_POST['date01'];
                                        $factura    =   $_POST['factura'];
                                        $codigo     =   $_POST['codigo'];
                                        $tipo       =   $_POST['tipo_factura'];
                                        $nombre_c   =   $_POST['nombre_cliente'];
                                        $dir_fiscal =   $_POST['dir_fiscal'];
                                        $serie      =   $_POST['serie'];
                                        $plazo      =   $_POST['plazo'];
                                        $vendedor   =   $_POST['vendedor'];
                                        $nit        =   $_POST['nit'];
                                        $pedido     =   $_POST['pedido'];
                                
                                        $query2   =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM `vendedores` WHERE id_vendedor = '$vendedor'");
                                        $r2       =   mysql_fetch_array($query2);
                                        $vendedor =   $r2['nombre_vendedor'] . " " . $r2['apellido_vendedor'];
                                ?>
                        <form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $f; ?>">
							  </div>
                             <label class=" control-label" for="factura">NO. FACTURA: </label>
                                  <div class="controls">
								<input disabled type="text" class="input-medium typeahead" id="factura" name="factura" value="<?php echo "$factura";?>">
							  </div><br>    
							</div>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                
                                <tr>
                                    <td>
                                        <label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="nombre_cliente" name="nombre_cliente" value="<?php echo "$nombre_c";?>">
							            </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
							    <tr>
                                    <td>
                                        <label class="control-label" for="dir_fiscal">DIRECCION FISCAL: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="dir_fiscal" name="dir_fiscal" value="<?php echo "$dir_fiscal";?>">
							            </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="nit">NIT: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="nit" name="nit" value="<?php echo "$nit";?>">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <select disabled id="vendedor" name="vendedor" data-rel="chosen">
									           <option value="<?php echo "$vendedor";?>"><?php echo "$vendedor";?></option>
								            </select>
								        </div>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                
                            </table>
							</div>
                    
                     <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								                                    
                                  <th>SELECCION</th>
                                  <th>CODIGO</th>
                                  <th>CANTIDAD</th>
								  <th>PRODUCTO</th>
                                  <th>PRECIO UNITARIO</th>
                                  <th>TOTAL</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            
                              $query_todo   =   mysql_query("SELECT `id_control`,`id_pedido`,`codigo`,`cantidad`,`producto`,`precio_u`,`total` FROM pedidos_secundaria WHERE id_pedido = '$pedido'");
                              $count=0;
                            // comienza loop para la creacion de la tabla de ingreso de los distintos productos a solicitar en el pedido!
                              while($search=mysql_fetch_array($query_todo)){ 
                                 
                                  $count        =   $count + 1;
                                  
                                  $name_cod     =   "cod" . $count;
                                  $name_cod_v   =   $search['codigo'];
                                  $name_cantidad=   "can" . $count;
                                  $name_cantidad_v=   $search['cantidad'];
                                 
                                  $name_des     =   "des" . $count;
                                  $name_des_v   =   $search['producto'];
                                  $name_pu      =   "pu" . $count;
                                  $name_pu_v    =   $search['precio_u'];
                                  $name_total   =   "tot" . $count;
                                  $name_total_v =   $search['total'];
                                  $name_sel     =   "sel" . $count;
                                  $id_selec     =   $search['id_control'];
                                 
                          ?>
							<tr>
                                <td>
                                    <input type="checkbox" name="<?php echo "$name_sel";?>" id="<?php echo "$name_sel";?>" value="<?php echo "$id_selec";?>">
                                </td>
								<td class="center">
                                    <span id="<?php echo "$name_cod";?>" name="<?php echo "$name_cod";?>"><?php echo "$name_cod_v";?></span>
                                </td>
								<td class="center">
                                    <span id="<?php echo "$name_cantidad";?>" name="<?php echo "$name_cantidad";?>"><?php echo "$name_cantidad_v";?></span>
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>"><?php echo "$name_des_v";?></span>
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_pu";?>" name="<?php echo "$name_pu";?>"><?php echo "$name_pu_v";?></span>
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_total";?>" name="<?php echo "$name_total";?>"><?php echo "$name_total_v";?></span>
							</tr>
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
							<div class="form-actions">
                            <?php
                                if($flag1=="next"){
                            ?>
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag1" name="flag1" value="guardar">
                              <input type="hidden" id="contador" name="contador" value="<?php echo"$count";?>">
                              <input type="hidden" id="factu" name="factu" value="<?php echo"$factura";?>">
                              <input type="hidden" id="serie" name="serie" value="<?php echo"$serie";?>">
                            <?php
                                }else{
                            ?>
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>  
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Factura ingresado con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php }else{echo "Usuario no autoriado!";} ?>
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
