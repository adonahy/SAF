<?php
    require 'ini.php';
    //require 'connection.php';
    require 'core.php';
?>

<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>ST System</title>
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
	
			<style type="text/css">
			body { background: url(img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<!--<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>-->
					</div>
					<h2>Recupera tu contraseña</h2>
					<?php
                    
                    $pass = $_POST['password'];
                    $pass2 = $_POST['password2'];
                    $user = $_POST['username'];
                    
                    
                    $sql = mysql_query (" SELECT * FROM users WHERE user = '$user' ");
                    $r2 =  mysql_fetch_array($sql);
                    
                    $usuario = $r2['user'];
                    
                    if($user===$usuario){
                        if($pass===$pass2){
                            
                   $sql2= mysql_query ("UPDATE users SET pass = '$pass' WHERE user = '$user'");
                            echo "<h2>La Contraseña a sido cambiada con exito</h2 ><br>";
                            echo "<h2>Su nueva contraseña es:  $pass</h2>"
                        
                            ?>
                    
                    <form class="form-horizontal" id="frmRestablecer" action="index.php" method="post">
						
							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</div>
							<div class="clearfix"></div>
					</form>
                    <?php
                        }
                        else {
                            
                            echo "La contraseña no coincide";
                                
                                ?>
                    
                    <form class="form-horizontal" id="frmRestablecer" action="r_pass.html" method="post">
						
							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</div>
							<div class="clearfix"></div>
					</form>
                    <?php
                        }
                        
                        
                        
                    }
                    else
                    {
                        echo "<h2>No existe el usuario</h2>";
                        ?>
                    
                    <form class="form-horizontal" id="frmRestablecer" action="r_pass.html" method="post">
						
							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</div>
							<div class="clearfix"></div>
					</form>
                    <?php
                    }
                    ?>
					<hr>
					<!--<h3>Olvidaste tu contraseña?</h3>
					<p>
						No hay problema, <a href="#">haz click aca</a> para obtener una nueva contraseña.
					</p>-->	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
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