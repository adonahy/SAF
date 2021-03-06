<?php
    require 'ini.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ST System</title>
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
    function pdf() {

    document.getElementById("opt").value = "PDF";

    }
    
    function excel() {

    document.getElementById("opt").value = "EXCEL";

    }
    
    function search_cliente(cliente)
       {
           
           var xmlhttp_cliente;
           
           

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
           
            xmlhttp_cliente             =   new XMLHttpRequest();
             
          }
          else
          {// code for IE6, IE5
           
            xmlhttp_cliente             =   new ActiveXObject("Microsoft.XMLHTTP");
            
          }	
          
          xmlhttp_cliente.onreadystatechange = function() {
            if(xmlhttp_cliente.readyState == 4 && xmlhttp_cliente.status == 200)
            {
          
                document.getElementById("codigo_c").value = xmlhttp_cliente.responseText;
            }
          }
          
          
        
          xmlhttp_cliente.open("GET","search_cliente.php?cliente="+cliente, true);
          xmlhttp_cliente.send(); 
              
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
				<a class="brand" href="index.php"><span>ST System</span></a>
								
				<!-- start: Header Menu --> 
				<?php
                    require 'connection.php';
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
            
                $f=date("m/d/Y");
              ?>
			<!-- end: MAIN MENU ****************************************************** -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Advertencia!</h4>
					<p>Necesitas tener <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> habilitado en tu computadora!.</p>
				</div>
			</noscript>
			<?php

if(isset($_POST["cliente"]))

{

	echo "<p>Recibido ".$_POST["sDep"]."</p>";

}

?>
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>
                    <a href="#">Financiero S&T</a>
                    <i class="icon-angle-right"></i>
                    <a href="reporte_conta.php">Reportes</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Estado de cuenta por cliente</a>
                </li>
			</ul>
                <?php if($security == 'go'){ ?>
                <h1>Estado de cuenta por cliente </h1>
                <div class="box-content">
						<form class="form-horizontal" action="r_finales_cliente.php" method="post">
						  <fieldset>
                              <h2>Fecha</h2> <br>
                            <div class="control-group">   
							  <label class="control-label" for="date01">del:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $f;?>"> &nbsp; al: &nbsp;
                                <input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="<?php echo $f;?>">
							  </div>
							</div> 
							 <div class="control-group">
								<label class="control-label" for="cliente">Cliente: </label>
								<div class="controls">
								  <select id="cliente" name="cliente" data-rel="chosen"  onchange="search_cliente(this.value);">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `clientes`");
                                      
                                      while($result_bancos=mysql_fetch_array($query)){
                                        $r=$result_bancos['codigo'];
                                        $r2=$result_bancos['nombre_comercial'];  
                                    ?>
                                      <option value="<?php echo "$r";?>"><?php echo "$r2";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                              
                              <div class="control-group">   
							  <label class="control-label" for="codigo_cliente">Codigo cliente:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge typeahead" id="codigo_c" name="codigo_c" value="">
                                
							  </div>
							</div>
                              
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" onclick="pdf();">PDF</button>
                             <!-- <button type="submit" class="btn btn-primary" onclick="excel();">EXCEL</button>-->
							  <button type="reset" class="btn">Cancelar</button>
                                 <input type="hidden" name="opt" id="opt" value=""> 
							</div>
						  </fieldset>
						</form>  
                </div>
                <?php
                                           }else{
    echo "Usuario no autorizado!";
}
                ?>
					</div>
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
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 <a href="http://e-technologyca.com" alt="ILH">E-Technology C.A.</a></span>
			
		</p>

	</footer>
	
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
