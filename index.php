<?php
    session_start();
    session_unset();
    $_SESSION = array();
    session_destroy();
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

	<!-- end: CSS -->



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

					</div>
					<h2>Ingresa a tu cuenta</h2>
					<form class="form-horizontal" action="one.php" method="post">
						<fieldset>

							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="Ingresa tu usuario"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="Ingresa tu contraseña"/>
							</div>
							<div class="clearfix"></div>

							<!--<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>-->

							<div class="button-login">
								<button type="submit" class="btn btn-primary">Ingresar</button>
							</div>
							<div class="clearfix"></div>
					</form>
					<hr>
					<h3>Olvidaste tu contraseña?</h3>
					<p>
						No hay problema, <a href="r_pass.html">haz click aca</a> para obtener una nueva contraseña.
					</p>
				</div><!--/span-->
			</div><!--/row-->


	</div><!--/.fluid-container-->

		</div><!--/fluid-row-->

	<!-- start: JavaScript-->

		
	<!-- end: JavaScript-->

</body>
</html>
