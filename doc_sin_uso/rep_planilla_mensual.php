<?php
    session_start();
    require 'core.php';
    require 'connection.php';

$del            =   $_POST['date01'];
$al             =   $_POST['date02'];
$opt            =   $_POST['opt'];
$dell           =   strtotime($del);
$month          =   date("m",$dell);
$year           =   date("Y",$dell);
$al_quincena    =   "$month/15/$year";
$del_mensual    =   "$month/16/$year";
$val            =   "";
$totales        =   "";

$query  =   mysql_query("SELECT * FROM `planillas` WHERE estatus = '1' ORDER BY `cargo` ASC");

$codigo             =   0;
$nombre             =   "";
$area               =   "";
$salario            =   0;
$bonificacion       =   0;
$boni_prod          =   0;
$horas              =   0;
$horas_quincena     =   0;
$horas_mensual      =   0;
$extraordinario     =   0;  // valor de horas extra + bonificacion empresa
$comisiones         =   0;
$dias_inas          =   0;
$val_dias_inas      =   0;
$igss               =   0;
$bco                =   0;  // Prestamos externos
$otros              =   0;  // Prestamos internos + compras
$total              =   0;
$tot_salario        =   0;
$tot_bonificacion   =   0;
$tot_boni_prod      =   0;
$boni_empresa       =   0;
$tot_extra          =   0;
$tot_comisiones     =   0;
$tot_val_dias_inas  =   0;
$tot_igss           =   0;
$tot_bco            =   0;
$tot_otros          =   0;
$tot_total          =   0;

while($r=mysql_fetch_array($query)){
    
    $codigo             =   $r['id'];
    
    $query_horas_quincena = mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$codigo' AND fecha >= '$del' AND fecha <= '$al_quincena'");
    $result_horas_quincena = mysql_fetch_array($query_horas_quincena);

    $query_horas_mensual = mysql_query("SELECT `fecha`,`empleado`,`boni_empresa`,`horas_extra`,`boni_prod` FROM `ingresos_ext` WHERE empleado = '$codigo' AND fecha >= '$del_mensual' AND fecha <= '$al'");
    $result_horas_mensual = mysql_fetch_array($query_horas_mensual);

    $query_egresos_quincena = mysql_query("SELECT `inicio`,`fin`,`empleado`,`monto`,`razon` FROM `egreso_planilla` WHERE empleado = '$codigo' AND inicio >= '$del' AND fin <= '$al_quincena'");

    $query_egresos_mensual = mysql_query("SELECT `inicio`,`fin`,`empleado`,`monto`,`razon` FROM `egreso_planilla` WHERE empleado = '$codigo' AND inicio >= '$del_mensual' AND fin <= '$al'");
    
    $n1                 =   $r['nombre_1'];
    $n2                 =   $r['nombre_2'];
    $a1                 =   $r['ape_1'];
    $a2                 =   $r['ape_2'];
    $nombre             =   $n1 . " " . $n2 . " " . $a1 . " " . $a2;
    $area               =   $r['cargo'];
    $salario            =   $r['sueldo_base'];
    $bonificacion       =   $r['boni_decreto'];
    $horas_quincena     =   $result_horas_quincena['horas_extra'];
    $horas_mensual      =   $result_horas_mensual['horas_extra'];
    $horas              =   $horas_quincena + $horas_mensual;
    $h_extra_quincena   =   $result_horas_quincena['horas_extra'] * (1.5*(($salario/30)/8));
    $h_extra_mensual    =   $result_horas_mensual['horas_extra'] * (1.5*(($salario/30)/8));
    $boni_empresa       =   $result_horas_quincena['boni_empresa'] + $result_horas_mensual['boni_empresa'];
    $boni_prod          =   $result_horas_quincena['boni_prod'] + $result_horas_mensual['boni_prod'];
    $extraordinario     =   $h_extra_quincena + $h_extra_mensual + $boni_empresa;
    $comisiones         =   0; // Se generara de egresos de planilla
    
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
        if($result_egresos_mensual['razon']=="Prestamos Internos"){
            $interno_quincena = $result_egresos_quincena['monto'] + $interno_quincena;
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
        if($result_egresos_mensual['razon']=="Prestamos Internos"){
            $interno_mensual = $result_egresos_mensual['monto'] + $interno_mensual;
        }
    }
    
    $dias_inas      =   round(($inas_quincena + $inas_mensual)/(($bonificacion+$salario)/30));
    $val_dias_inas  =   $inas_quincena + $inas_mensual;
    $igss           =   $igss_quincena + $igss_mensual;
    $bco            =   $banco_quincena + $banco_mensual;
    $otros          =   $compras_quincena + $compras_mensual + $interno_quincena + $interno_mensual;
    $total          =   $salario + $bonificacion + $boni_prod + $extraordinario + $comisiones - $val_dias_inas - $igss - $bco - $otros;
    
    $tot_salario        =   $tot_salario + $salario;
    $tot_bonificacion   =   $tot_bonificacion + $bonificacion;
    $tot_boni_prod      =   $tot_boni_prod + $boni_prod;
    $tot_extra          =   $tot_extra + $extraordinario;
    $tot_comisiones     =   $tot_comisiones + $comisiones;
    $tot_val_dias_inas  =   $tot_val_dias_inas + $val_dias_inas;
    $tot_igss           =   $tot_igss + $igss;
    $tot_bco            =   $tot_bco + $bco;
    $tot_otros          =   $tot_otros + $otros;
    $tot_total          =   $tot_total + $total;
    
    $salario            =   "Q" . number_format("$salario",2);
    $bonificacion       =   "Q" . number_format("$bonificacion",2);
    $boni_prod          =   "Q" . number_format("$boni_prod",2);
    $extraordinario     =   "Q" . number_format("$extraordinario",2);
    $comisiones         =   "Q" . number_format("$comisiones",2);
    $val_dias_inas      =   "Q" . number_format("$val_dias_inas",2);
    $igss               =   "Q" . number_format("$igss",2);
    $bco                =   "Q" . number_format("$bco",2);
    $otros              =   "Q" . number_format("$otros",2);
    $total              =   "Q" . number_format("$total",2);
    
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\"> $codigo </td>
				        <td class=\"center\" style=\"font-size:11px\"> $nombre </td>
				        <td class=\"center\"> $area </td>
				        <td class=\"center\"> $salario </td>  
                        <td class=\"center\"> $bonificacion </td>
                        <td class=\"center\"> $boni_prod </td>
                        <td class=\"center\"> $horas </td>
                        <td class=\"center\"> $extraordinario </td>
                        <td class=\"center\"> $comisiones </td>
                        <td class=\"center\"> $dias_inas </td>
                        <td class=\"center\"> $val_dias_inas </td>
                        <td class=\"center\"> $igss </td>
                        <td class=\"center\"> $bco </td>
                        <td class=\"center\"> $otros </td>
                        <td class=\"center\"> $total </td>
                    <tr>
                <tbody>
                ";
}


$tot_salario        =   "Q" . number_format("$tot_salario",2);
$tot_bonificacion   =   "Q" . number_format("$tot_bonificacion",2);
$tot_boni_prod      =   "Q" . number_format("$tot_boni_prod",2);
$tot_extra          =   "Q" . number_format("$tot_extra",2);
$tot_comisiones     =   "Q" . number_format("$tot_comisiones",2);
$tot_val_dias_inas  =   "Q" . number_format("$tot_val_dias_inas",2);
$tot_igss           =   "Q" . number_format("$tot_igss",2);
$tot_bco            =   "Q" . number_format("$tot_bco",2);
$tot_otros          =   "Q" . number_format("$tot_otros",2);
$tot_total          =   "Q" . number_format("$tot_total",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">TOTALES</td>
									<td class=\"center\"></td>
									<td class=\"center\"></td>
									<td class=\"center\">$tot_salario</td>   
                                    <td class=\"center\">$tot_bonificacion</td>
                                    <td class=\"center\">$tot_boni_prod</td>
                                    <td class=\"center\">&nbsp;</td>
                                    <td class=\"center\">$tot_extra</td>
                                    <td class=\"center\">$tot_comisiones</td>
                                    <td class=\"center\">&nbsp;</td>
                                    <td class=\"center\">$tot_val_dias_inas</td>
                                    <td class=\"center\">$tot_igss</td>
                                    <td class=\"center\">$tot_bco</td>
                                    <td class=\"center\">$tot_otros</td>
                                    <td class=\"center\">$tot_total</td>
                                    
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
                <h1>Planilla Mensual</h1>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                            <div class="control-group">   
							  <label class="control-label" for="date01">Fecha:</label>
								del: &nbsp; <input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="' . $del . '"> &nbsp; al: &nbsp;
                                <input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="' . $al . '">
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
                                      <th>COMISIONES</th>
                                      <th>D.INASISTENCIA</th>
                                      <th>INASISTENCIA</th>
                                      <th>IGSS</th>
                                      <th>BCO</th>
                                      <th>OTROS</th>
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