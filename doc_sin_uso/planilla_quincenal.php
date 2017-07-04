<?php
    session_start();
    require 'core.php';
    require 'connection.php';

$del            =   $_POST['date01'];
$al             =   $_POST['date02'];
$opt            =   $_POST['opt'];
$sa             =   0;
$val            =   "";
$totales        =   "";
$tot_credit     =   0;
$tot_debit      =   0;
$tot_debito     =   0;
$tot_tot        =   0;
$dell = strtotime($del);
$month  = date("m",$dell);
$year   = date("Y",$dell);
$al_quincena = "$month/15/$year";

$query  =   mysql_query("SELECT * FROM `planillas` ORDER BY `cargo` ASC");

$salario            =   0;
$bonificacion       =   0;
$boni_prod          =   0;
$extraordinario     =   0;
$total              =   0;
$tot_salario        =   0;
$tot_bonificacion   =   0;
$tot_boni_prod      =   0;
$tot_extra          =   0;
$tot_total          =   0;

$nombre             =   "";

while($r=mysql_fetch_array($query)){
    $codigo             =   $r['id'];
    $n1                 =   $r['nombre_1'];
    $n2                 =   $r['nombre_2'];
    $a1                 =   $r['ape_1'];
    $a2                 =   $r['ape_2'];
    $nombre             =   $n1 . " " . $n2 . " " . $a1 . " " . $a2;
    $area               =   $r['cargo'];
    $salario            =   $r['sueldo_base'];
    $bonificacion       =   $r['boni_decreto'];
    $horas              =   0;
    $extraordinario     =   0;
    
    $query_horas_quincena = mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$codigo' AND fecha >= '$del' AND fecha <= '$al_quincena'");
    $result_horas_quincena= mysql_fetch_array($query_horas_quincena);

    $prod_quincena      =   $result_horas_quincena['boni_prod'];
    $horas              =   $result_horas_quincena['horas_extra'];
    $vhoras             =   $result_horas_quincena['horas_extra'] * (1.5*(($salario/30)/8));
    $boni_empresa       =   $result_horas_quincena['boni_empresa'];
    
    $salario            =   $salario / 2;
    $extraordinario     =   $extraordinario + $vhoras + $boni_empresa;
    $total              =   $salario + $bonificacion + $prod_quincena + $extraordinario;
        
    $salario1           = "Q" . number_format("$salario",2);
    $bonificacion1      = "Q" . number_format("$bonificacion",2);
    $extraordinario1    = "Q" . number_format("$extraordinario",2);
    $total1             = "Q" . number_format("$total",2);
    
    $tot_salario        =   $tot_salario + $salario;
    $tot_bonificacion   =   $tot_bonificacion + $bonificacion;
    $tot_boni_prod      =   $tot_boni_prod + $prod_quincena;
    $tot_extra          =   $tot_extra + $extraordinario;
    $tot_total          =   $tot_total + $total;
    $boni_prod          =   "Q" . number_format("$prod_quincena",2);
    $vhoras             =   "Q" . number_format("$vhoras",2);
    
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\"> $codigo </td>
				        <td class=\"center\" style=\"font-size:11px\"> $nombre </td>
				        <td class=\"center\"> $area </td>
				        <td class=\"center\"> $salario1 </td>  
                        <td class=\"center\"> $bonificacion1 </td>
                        <td class=\"center\"> $boni_prod </td>
                        <td class=\"center\"> $horas </td>
                       
                        <td class=\"center\"> $extraordinario1 </td>
                        <td class=\"center\"> $total1 </td>
                    <tr>
                <tbody>
                ";
}


$tot_salario1       =   "Q" . number_format("$tot_salario",2);
$tot_bonificacion1  =   "Q" . number_format("$tot_bonificacion",2);
$tot_boni_prod1     =   "Q" . number_format("$tot_boni_prod",2);
$tot_extra1         =   "Q" . number_format("$tot_extra",2);
$tot_total1         =   "Q" . number_format("$tot_total",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">TOTALES</td>
									<td class=\"center\"></td>
									<td class=\"center\"></td>
									<td class=\"center\">$tot_salario1</td>   
                                    <td class=\"center\">$tot_bonificacion1</td>
                                    <td class=\"center\">$tot_boni_prod1</td>
                                    <td class=\"center\">&nbsp;</td>
                                    
                                    <td class=\"center\">$tot_extra1</td>
                                    <td class=\"center\">$tot_total1</td>
                                    
								</tr>                               
							  </tbody>
                ";

                                
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
                <h1>Planilla Quincenal</h1>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                            <div class="control-group">   
							  <label class="control-label" for="date01">Fecha:</label>
							  <div class="controls">
								del: &nbsp; <input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="' . $del . '"> &nbsp; al: &nbsp;
                                <input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="' . $al . '">
							  </div>
							</div> 
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>CODIGO</th>
									  <th>&nbsp;&nbsp;&nbsp;&nbsp;NOMBRE&nbsp;&nbsp;&nbsp;&nbsp;</th>
									  <th>AREA</th>
									  <th>SALARIO</th>
                                      <th>BONIFICACION</th>
                                      <th>BONO PRODUCTIVIDAD</th>
                                      <th>HORAS</th>
                                      <th style=\"font-size:11px\">EXTRAORDINARIO</th>
                                      <th>TOTAL</th>
								  </tr>
							  </thead>  
                              
                      '. $val .'
      
                              <tbody>
								<tr>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td> 
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
								</tr>                               
							  </tbody>
                         '. $totales .'
						 </table>     
					</div>
				</div><!--/span-->
			</div><!--/row-->
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

$mpdf=new mPDF('c', 'Letter-L');

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML(estado_de_cuenta_bancos.php);
$mpdf->Output('planilla_quincenal.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `estados_cuenta` ");
exit;

$u      =   "Usuario registrado";
$d      =   "Genero un reporte de planilla quincenal ";
$t      =   "Ninguna tabla fue afectada";
$test   =   "";
            
insert_logs($fecha, $u, $d, $t, $test);
?>