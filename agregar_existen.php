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
    $fla    =   $_POST['fla'];
    $monica =   "no";
                if($fla=="yes"){
                if(empty($_POST)===false){
                   
                    $codigo                =    $_POST['codigo2'];
                    $proveedor             =    $_POST['provee'];
                    $existencia            =    $_POST['exis2'];
                    $agrega                =    $_POST['agrega'];
                    $new_exis              =    $existencia + $agrega;
                    $descrip               =    $_POST['descrip'];
                    
                    
                 
                    $query      =   mysql_query("UPDATE `inventario` SET `proveedor`='$proveedor', `existencia`='$new_exis', `descrip`='$descrip' WHERE `id_producto`='$codigo'");
                    
                    
                    
                                        
                    $monica =   "yes";
                }
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
                        echo "<h3>Producto Actualizado con exito!</h3>";
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
                
                <?php 
                    $id_ex =$_POST['id'];
                        
                        $query_prod =   mysql_query("SELECT * FROM `inventario` WHERE id_producto = '$id_ex'");
                        $rprod      =   mysql_fetch_array($query_prod);
                        
                        $id      =   $rprod['id_producto'];
                        $prod    =   $rprod['nombre_producto'];
                        $provee  =   $rprod['proveedor'];
                        $precio_c=   $rprod['precio_compra'];
                        $precio_v=   $rprod['precio_venta'];
                        $existen =   $rprod['existencia'];
                        $descrip =   $rprod['descrip'];
                        $f_ingre =   $rprod['fecha_ingreso'];
                
                
                ?>
                					<div class="box-content">
						<form class="form-horizontal" method="post">
						  <fieldset>
							  <label class="control-label" for="date01">Fecha de ingreso:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo "$f_ingre";?>" disabled>
							  </div>
							     
                              
                                   <label class="control-label" for="codigo">Código: </label>
                                  <div class="controls">
								<input type="text" class="input-small typeahead" id="codigo" name="codigo" value="<?php echo"$id";?>" disabled>
                                <input type="hidden" class="input-small typeahead" id="codigo2" name="codigo2" value="<?php echo"$id";?>" >
							  </div>
                              
                              <label class="control-label" for="provee">proveedor: </label>
                                        <div class="controls">
                                            <?php 
                                            $query_prov = mysql_query("SELECT `id_proveedor`, `nombre_proveedor` FROM `proveedores` WHERE id_proveedor='$provee'");
                        
                                            $qprov  = mysql_fetch_array($query_prov);
                                            
                                            $id_prov  =   $qprov['id_proveedor'];
                                            $proveed  =   $qprov['nombre_proveedor'];
                                            
                                            ?>
								           
                                            <select id="provee" name="provee" data-rel="chosen">
									           <option value="<?php echo "$id_prov";?>"><?php echo "$proveed";?></option>
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
								<input type="text" class="span6 typeahead" id="produc" name="produc" value="<?php echo "$prod";?>" disabled>
							  </div>
                              <label class="control-label" for="apellido">Precio de Compra: </label>
                                  <div class="controls">
								<input type="text" class="input-small typeahead" id="prec_compra" name="prec_compra" value="<?php echo "Q."."$precio_c";?>" disabled>
							  </div>
                              <label class="control-label" for="f_nac">Precio de venta:</label>
							  <div class="controls">
								<input type="text" class="input-small typeahead" id="prec_venta" name="prec_venta" value="<?php echo "Q."."$precio_v";?>" disabled>
							  </div>
                              <label class="control-label" for="edad">Existencia: </label>
                                  <div class="controls">
								<input type="number" class="input-small typeahead" id="exis" name="exis" value="<?php echo "$existen";?>" disabled>
                                <input type="hidden" class="input-small typeahead" id="exis2" name="exis2" value="<?php echo "$existen";?>">
							  </div>
                              <label class="control-label" for="agregar">Agregar Producto: </label>
                                  <div class="controls">
								<input type="number" class="input-small typeahead" id="agrega" name="agrega" >
							  </div>
                             <table>
                                  <tr>
                                      <td>
                               	<label class="control-label" for="descrip">Descripcion: </label>
								 <div class="controls">
								<input type="text" class="input-xlarge typeahead" id="descrip" name="descrip" value="<?php echo "$descrip";?>">
							  </div>
                              
                              
            
                                 </td>
                                
                                     </tr><br>
                              
                              </table>
                              
                            <br>    
                             
							<div class="form-actions">
                              <input type="hidden" id="fla" name="fla" value="yes">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="submit" onclick = "this.form.action = 'inventario.php'" class="btn">Cancelar</button>
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
