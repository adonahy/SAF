<?php
    require 'ini.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ILH System</title>
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
	<link rel="shortcut icon" href="img/fa-icon-tasks.ico">
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
				<a class="brand" href="index.php"><span>ILH System</span></a>
								
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
                    <a href="#">Contabilidad</a>
                    <i class="icon-angle-right"></i>
                    <a href="bancos.php">Bancos</a>
                    <i class="icon-angle-right"></i>
                    <a href="m_egresos.php">Egresos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Cheques</a>
                </li>
			</ul>
                <?php if($security == 'go'){  ?>
                <h1>Cheques</h1>
                    <div class="box-content">
                        <form class="form-horizontal">
                            <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="banco">Buscar: </label>
                                <div class="controls">
				                    <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="Ingresar número de cheque..." >
                                    
							  <button type="submit" class="btn btn-primary">Buscar</button>
							
							     </div>
							</div>
                            </fieldset>
                        </form>
                        
						<form class="form-horizontal">
						  <fieldset>
                              
                            <div class="control-group">
                                <label class="control-label" for="banco">Nombre del banco: </label>
							  <div class="controls">
								  <select id="banco" data-rel="chosen">
									<!--<option>$ Dolares</option>
									<option>Q Quetzales</option>-->
								  </select>
                                     &nbsp; &nbsp; No. Cheque:
                                  <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="No ingresar moneda, solo el monto..." >
							  </div>
							</div>
                              
                           <div class="control-group">
                            <label class="control-label" for="cuenta">No. Cuenta: </label>
							  <div class="controls">
								  <select id="cuenta" data-rel="chosen">
									<!--<option>$ Dolares</option>
									<option>Q Quetzales</option>-->
								  </select>
                                     &nbsp; &nbsp; Fecha:
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="11/16/15">
							  </div>
							</div>
                              
                            <div class="control-group">
                                <label class="control-label" for="banco">Pagar a: </label>
							     <div class="controls">
                                     <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="Nombre del cheque..." >
                                     &nbsp; &nbsp; Monto:
                                    <input type="text" class="span46 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="No ingresar moneda, solo el monto..." >
							     </div>
							</div>
                              
                            <div class="control-group">
                                <label class="control-label" for="banco">Cantidad: </label>
							     <div class="controls">
                                     <input type="text" class="span6 typeahead" id="monto" name="monto" data-provide="typeahead" placeholder="Monto en letras..." >
							     </div>
							</div>
                              
				            <div class="control-group">
								<label class="control-label">Proveedor1</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> Factura 1
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox2" value="option2"> Factura 2
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox3" value="option3"> Factura 3
								  </label>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label">Proveedor2</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> Factura 1
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox2" value="option2"> Factura 2
								  </label>
								</div>
							  </div>
                                <div class="control-group">
								<label class="control-label">Proveedor3</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="p3_1" value="option1"> Factura 1
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="p3_2" value="option2"> Factura 2
								  </label>
								  <label class="checkbox inline">
									<input type="checkbox" id="p3_3" value="option3"> Factura 3
								  </label>
                                    <label class="checkbox inline">
									<input type="checkbox" id="p3_4" value="option4"> Factura 4
								  </label>
								</div>
							  </div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <button type="submit" class="btn btn-primary">Imprimir</button>
                              <button type="submit" class="btn btn-primary">Modificar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   
					</div>

<?php 
    }else{
        echo "Usuario no autorizado!";
}
?>
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
