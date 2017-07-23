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
    
    <?php
                
                if(empty($_POST)===false){
                    $fecha                 =    $_POST['date01'];
                    $codigo                =    $_POST['codigo'];
                    $proveedor             =    $_POST['provee'];
                    $producto              =    $_POST['produc'];
                    $precio_compra         =    $_POST['prec_compra'];
                    $precio_venta          =    $_POST['prec_venta'];
                    $existencia            =    $_POST['exis'];
                    $descrip               =    $_POST['descrip'];
                    
                    
                 
                    $query      =   mysql_query("INSERT INTO `inventario` (`id_producto`, `nombre_producto`, `proveedor`,`precio_compra`, `precio_venta`, `existencia`, `descrip`, `fecha_ingreso`) VALUES ('$codigo', '$producto','$proveedor', '$precio_compra', '$precio_venta', '$existencia', '$descrip', '$fecha')");
                    
                    
                    
                                        
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
				<a class="brand" href="one.php"><span>SAF</span></a>
								
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
                    
                    <a href="#">Productos</a>
                    <i class="icon-angle-right"></i>
                    <a href="inventario.php">Inventario</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de nuevo Producto</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                    if($monica=="yes"){
                        echo "<h3>Producto ingresado con exito!</h3>";
                ?>
                <form id="con_inscrip" method="post" action="inventario.php">
                <div class="form-actions">
                    
							  <button type="submit" class="btn btn-primary">ACEPTAR</button>
							  
                    </div>
                    </form>
                
                <?php
                        
                    }
                    else{
                ?>
                <h1>Ingreso de nuevo Producto</h1>
                					<div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							  <label class="control-label" for="date01">Fecha de ingreso:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$da";?>">
							  </div>
							     
                              <?php 
                                $querycod =   mysql_query("SELECT `id_producto` FROM `inventario` ORDER BY id_producto DESC");
                                $rcod     =   mysql_fetch_array($querycod);
                                $cod    =   $rcod['id_producto'] + 1;
                              ?>
                                   <label class="control-label" for="codigo">Código: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="codigo" name="codigo" value="<?php echo"$cod";?>">
							  </div>
                              
                              <label class="control-label" for="provee">proveedor: </label>
                                        <div class="controls">
								           
                                            <select id="provee" name="provee" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    
                                                    $query_provee = mysql_query("SELECT `id_proveedor`, `nombre_proveedor` FROM `proveedores`");
                                                                                                                                                
                                      
                                                    while($rprovee     = mysql_fetch_array($query_provee)){
                                                        $id_provee   =   $rprovee['id_proveedor'];
                                                        $nombre_provee   =   $rprovee['nombre_proveedor'];
                                                        
                                                ?>
                                                        <option value="<?php echo "$id_provee";?>"><?php echo "$nombre_provee";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
							            </div>
                              
                                 <label class="control-label" for="nombre">Producto: </label>
                                  <div class="controls">
								<input type="text" class="span6 typeahead" id="produc" name="produc">
							  </div>
                              <label class="control-label" for="apellido">Precio de Compra: </label>
                                  <div class="controls">
								<input type="number" class="input-small typeahead" id="prec_compra" name="prec_compra">
							  </div>
                              <label class="control-label" for="f_nac">Precio de venta:</label>
							  <div class="controls">
								<input type="number" class="input-small typeahead" id="prec_venta" name="prec_venta">
							  </div>
                              <label class="control-label" for="edad">Existencia: </label>
                                  <div class="controls">
								<input type="number" class="input-small typeahead" id="exis" name="exis">
							  </div>
                             <table>
                                  <tr>
                                      <td>
                               	<label class="control-label" for="descrip">Descripcion: </label>
								 <div class="controls">
								<input type="text" class="input-xlarge typeahead" id="descrip" name="direccion" >
							  </div>
                              
                              
            
                                 </td>
                                
                                     </tr><br>
                              
                              </table>
                              
                            <br>    
                             
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="submit" onclick = "this.form.action = 'inventario.php'"  class="btn">Cancelar</button>
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
	
	<script src="js/jquery-1.9.1.min.js"></script>
    
   
	
		

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
