<?php
require 'connection.php';

$del            =   $_POST['date01'];
$al             =   $_POST['date02'];
$empleado       =   $_POST['empleado'];


$query  =   mysql_query("SELECT * FROM `planillas` WHERE `id` = '$empleado' ORDER BY `cargo` ASC");
$result =   mysql_fetch_array($query);

$query2 =   mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$empleado' AND fecha >= '$del' AND fecha <= '$al'");
$result2=   mysql_fetch_array($query2);

$dell = strtotime($del);
$month  = date("m",$dell);
$year   = date("Y",$dell);
$al_quincena = "$month/15/$year";
$del_mensual = "$month/16/$year";

$query_horas_quincena = mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$empleado' AND fecha >= '$del' AND fecha <= '$al_quincena'");
$result_horas_quincena = mysql_fetch_array($query_horas_quincena);

$query_horas_mensual = mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$empleado' AND fecha >= '$del_mensual' AND fecha <= '$al'");
$result_horas_mensual = mysql_fetch_array($query_horas_mensual);

$query_egresos_quincena = mysql_query("SELECT `inicio`,`fin`,`empleado`,`monto`,`razon` FROM `egreso_planilla` WHERE empleado = '$empleado' AND inicio >= '$del' AND fin <= '$al_quincena'");

$query_egresos_mensual = mysql_query("SELECT `inicio`,`fin`,`empleado`,`monto`,`razon` FROM `egreso_planilla` WHERE empleado = '$empleado' AND inicio >= '$del_mensual' AND fin <= '$al'");

$name   =   $result['nombre_1'] . " " . $result['nombre_2'] . " " . $result['ape_1'] . " " . $result['ape_2']; 
$area   =   $result['cargo'];
$base   =   $result['sueldo_base'];
$h_extra_quincena = $result_horas_quincena['horas_extra'] * (1.5*(($base/30)/8));
$h_extra_mensual  = $result_horas_mensual['horas_extra'] * (1.5*(($base/30)/8));
$quincena=  $base/2;
$mes    =   $base/2;
$comi   =   0;
$decreto=   $result['boni_decreto'];
$decreto_boni= $decreto/2;
$h_extra=   $result_horas_quincena['horas_extra']+$result_horas_mensual['horas_extra'];
$comisiones_quincena = 0;
$comisiones_mensual = 0;
$prod_quincena = $result_horas_quincena['boni_prod'];
$prod_mensual = $result_horas_mensual['boni_prod'];
$prod   =   $prod_quincena + $prod_mensual;
$otros_quincena = $result_horas_quincena['boni_empresa'];
$otros_mensual = $result_horas_mensual['boni_empresa'];
$otros  =   $otros_quincena + $otros_mensual;
$igss_quincena = 0;
$igss_mensual = 0;
$banco_quincena = 0;
$banco_mensual = 0;
$compras_quincena = 0;
$compras_mensual = 0;
$inas_quincena = 0;
$inas_mensual = 0;

while($result_egresos_quincena = mysql_fetch_array($query_egresos_quincena)){
    if($result_egresos_quincena['razon']=="IRTRA e IGSS"){
        $igss_quincena = $result_egresos_quincena['monto'] + $igss_quincena;
    }
    if($result_egresos_quincena['razon']=="Prestamos Externos"){
        $banco_quincena = $result_egresos_quincena['monto'] + $banco_quincena;
    }
    if($result_egresos_quincena['razon']=="Compras"){
        $compras_quincena = $result_egresos_quincena['monto'] + $compras_quincena;
    }
    if($result_egresos_quincena['razon']=="Inasistencia"){
        $inas_quincena = $result_egresos_quincena['monto'] + $inas_quincena;
    }
}

while($result_egresos_mensual = mysql_fetch_array($query_egresos_mensual)){
    if($result_egresos_mensual['razon']=="IRTRA e IGSS"){
        $igss_mensual = $result_egresos_mensual['monto'] + $igss_mensual;
    }
    if($result_egresos_mensual['razon']=="Prestamos Externos"){
        $banco_mensual = $result_egresos_mensual['monto'] + $banco_mensual;
    }
    if($result_egresos_mensual['razon']=="Compras"){
        $compras_mensual = $result_egresos_mensual['monto'] + $compras_mensual;
    }
    if($result_egresos_mensual['razon']=="Inasistencia"){
        $inas_mensual = $result_egresos_mensual['monto'] + $inas_mensual;
    }
}

$total_quincena = $quincena + $decreto_boni + $h_extra_quincena + $comisiones_quincena + $prod_quincena + $otros_quincena - $igss_quincena - $banco_quincena - $compras_quincena - $inas_quincena;
$total_mensual = $mes + $decreto_boni + $h_extra_mensual + $comisiones_mensual + $prod_mensual + $otros_mensual - $igss_mensual - $banco_mensual - $comisiones_mensual - $inas_mensual;

$quincena=  "Q" . number_format("$quincena",2);
$mes    =   "Q" . number_format("$mes",2);
$base   =   "Q" . number_format("$base",2);
$decreto_boni= "Q" . number_format("$decreto_boni",2);
$decreto=   "Q" . number_format("$decreto",2);
$h_extra_quincena= "Q" . number_format("$h_extra_quincena",2);
$h_extra_mensual= "Q" . number_format("$h_extra_mensual",2);
$comisiones_quincena= "Q" . number_format("$comisiones_quincena",2);
$comisiones_mensual= "Q" . number_format("$comisiones_mensual",2);
$prod_quincena= "Q" . number_format("$prod_quincena",2);
$prod_mensual= "Q" . number_format("$prod_mensual",2);
$otros_quincena= "Q" . number_format("$otros_quincena",2);
$otros_mensual= "Q" . number_format("$otros_mensual",2);
$igss_quincena= "Q" . number_format("$igss_quincena",2);
$igss_mensual= "Q" . number_format("$igss_mensual",2);
$banco_quincena= "Q" . number_format("$banco_quincena",2);
$banco_mensual= "Q" . number_format("$banco_mensual",2);
$compras_quincena= "Q" . number_format("$compras_quincena",2);
$compras_mensual= "Q" . number_format("$compras_mensual",2);
$inas_quincena= "Q" . number_format("$inas_quincena",2);
$inas_mensual= "Q" . number_format("$inas_mensual",2);
$total_quincena= "Q" . number_format("$total_quincena",2);
$total_mensual= "Q" . number_format("$total_mensual",2);
$prod="Q" . number_format("$prod",2);

$html   =   '
<!DOCTYPE html>
<html lang="en">
<head>
<?php
require \'connection\';
?>
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
	<link href=\'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext\' rel=\'stylesheet\' type=\'text/css\'>
	<!-- end: CSS -->
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
				<a class="brand" href="index.html"><span>ILH System</span></a>			
				<!-- start: Header Menu --> 
				<!-- end: Header Menu -->
			</div>
		</div>
	</div>
	<!-- start: Header -->
		<div class="container-fluid-full">
		<div class="row-fluid">
			<!-- start: MAIN MENU **************************************************** -->
			<!-- end: MAIN MENU ****************************************************** -->
			<noscript>
			</noscript>
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
                <h2>Industrias LH S.A.</h2>
                <h2>35 av 0-25 zona 11</h2>
               
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                            <div class="control-group">  
                                 <label class="control-label" for="name">Nombre: '. $name .' </label><br>
                                 <label class="control-label" for="area">Area: '. $area .'</label><br>
							     <label class="control-label" for="date01">Periodo: '. $del .' al '. $al .'</label><br>
							</div> 
                            <hr>
                            <table border="0" style="width:100%"> 
                              <tbody>
								<tr>
									<td class="center"><label class="control-label" for="name">Sueldo Base: '. $base .' </label></td>
									<td class="center"><label class="control-label" for="name">Comisiones: '. $comi .' </label></td>
								</tr> 
                                <tr>
									<td class="center"><label class="control-label" for="name">Bonificación: '. $decreto .' </label></td>
									<td class="center"><label class="control-label" for="name">Bonificación Productividad: '. $prod .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Horas Extra: '. $h_extra .' </label></td>
									<td class="center"><label class="control-label" for="name">Otros: '. $otros .' </label></td>
								</tr>
							  </tbody>
						   </table> 
                            <hr>
                            <table border="0" style="width:100%"> 
                              <tbody>
								<tr>
									<td class="center"><label class="control-label" for="name"><u>Quincena</u> </label></td>
									<td class="center"><label class="control-label" for="name"><u>Fin de mes</u> </label></td>
								</tr> 
                                <tr>
									<td class="center"><label class="control-label" for="name">Sueldo Base: '. $quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $mes .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Bonificación: '. $decreto_boni .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $decreto_boni .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Horas extra: '. $h_extra_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $h_extra_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Comisiones: '. $comisiones_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $comisiones_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Bonificación productividad: '. $prod_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $prod_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Otros: '. $otros_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $otros_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">&nbsp;</label></td>
									<td class="center"><label class="control-label" for="name">&nbsp;</label></td>
								</tr> 
                                <tr>
									<td class="center"><label class="control-label" for="name"><u>Descuentos quincena</u> </label></td>
									<td class="center"><label class="control-label" for="name"><u>Descuentos fin de mes</u> </label></td>
								</tr> 
                                <tr>
									<td class="center"><label class="control-label" for="name">IGSS: '. $igss_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $igss_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Banco: '. $banco_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $banco_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Compras: '. $compras_quincena .' </label></td>
									<td class="center"><label class="control-label" for="name"> '. $compras_mensual .' </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">Inasistencias:<u> '. $inas_quincena . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". '</u> </label></td>
									<td class="center"><label class="control-label" for="name"> <u>'. $inas_mensual . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". '</u> </label></td>
								</tr>
                                <tr>
									<td class="center"><label class="control-label" for="name">TOTAL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u> '. $total_quincena . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". '</u> </label></td>
									<td class="center"><label class="control-label" for="name"> <u>'. $total_mensual . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". '</u> </label></td>
								</tr>
							  </tbody>
						   </table> 
                          <br><br> <label class="control-label" for="name">Recibí a mi entera sarisfacción los ingresos que en está se detallan.</label><br><br>
                           <label class="control-label" for="name">Firma &nbsp; <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
						  </fieldset>
						</form>  
                </div>
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
	
		<script src=\'js/fullcalendar.min.js\'></script>
	
		<script src=\'js/jquery.dataTables.min.js\'></script>

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
';

include("mpdf/mpdf.php");

$mpdf=new mPDF('c', 'Letter');

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML(estado_de_cuenta_bancos.php);
$mpdf->Output('boleta_de_pago.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `estados_cuenta` ");
exit;
?>

