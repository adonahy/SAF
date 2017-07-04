<?php
require 'connection.php';
require 'core.php';

$alumno =   $_POST['no_alumno'];
$opt    =   "PDF";
$year   = date(Y);

$query  = mysql_query("SELECT `id_alumno`,`ciclo`,`nombres`,`apellidos`,`horario`,`edad`,`fecha_nac`,`direccion`,`nombre_encargado`,`telefono`,`nivel`,`id_horario`,`id_jornada`,`fecha_creacion` FROM `alumno` WHERE id_alumno = '$alumno'");
$r      = mysql_fetch_array($query);

$id_alumno   = $r['id_alumno'];
$ciclo       = $r['ciclo'];
$nombres     = $r['nombres'];
$apellidos   = $r['apellidos'];
$horarios    = $r['horario'];
$edad        = $r['edad'];
$fnac        = $r['fecha_nac'];
$direccion   = $r['direccion'];
$nencargado  = $r['nombre_encargado'];
$tel         = $r['telefono'];
$nivel       = $r['nivel'];
$id_horario  = $r['id_horario'];
$id_jornada  = $r['id_jornada'];
$f_creacion  = $r['fecha_creacion'];


$query1 = mysql_query("SELECT `id_horarios`,`hora`,`plan` FROM `horarios` WHERE id_horarios = '$horarios'");
$r1     = mysql_fetch_array($query1);

$horarios = $r1['hora'];


$query2 = mysql_query("SELECT `id_curso`,`nombre_curso`, `precio`,`inscripcion` FROM `cursos` WHERE id_curso = '$nivel'");
$r2     = mysql_fetch_array($query2);

$curso      = $r2['nombre_curso'];
$mes        = $r2['precio'];
$inscrip    = $r2['inscripcion'];

$query3 = mysql_query("SELECT `id_jornada`,`jornada` FROM `jornada` WHERE id_jornada = '$id_jornada'");
$r3     = mysql_fetch_array($query3);

$jornada      = $r3['jornada'];

    
/*$query3 = mysql_query("SELECT `id_pedido`,`cantidad`,`producto`,`sub_total` FROM `pedidos_secundaria` WHERE id_pedido = '$pedido'");

while($r3=mysql_fetch_array($query3)){
    //cantidad - descripcion - precio total
    $cantidad   = $r3['cantidad'];
    $des        = $r3['producto'];
    $total      = $r3['sub_total'];
    $tot        = $tot + $total;
    $total      = "Q" . number_format("$total",2);
    $cantidad   = number_format("$cantidad",0);
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\">  </td>
				        <td class=\"center\">  </td>
				        <td class=\"center\">  </td> 
                    <tr>
                <tbody>
                ";
    
}
$tot_iva    = $tot + $iva;
$tot_tot    = "Q" . number_format("$tot",2);
$tot_iva    = "Q" . number_format("$tot_iva",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">TOTALES</td>
									<td class=\"center\"></td>
                                    <td class=\"center\"></td>
								</tr>
                                <tr>
									<td class=\"center\">CON IVA</td>
									<td class=\"center\"></td>
                                    <td class=\"center\"></td>
								</tr>
							  </tbody>
                ";
*/
                                
if($opt == "PDF"){
$html   =   '
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>'. $nombre_p .'</title>
	<meta name="description" content="'. $nombre_p .'">
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
	<!--<link href=\'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext\' rel=\'stylesheet\' type=\'text/css\'>
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
				<a class="brand" href="index.php"><span>'. $nombre_p .'</span></a>			
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
                
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                              <h2 align="center">'.$nombre_p .'</h2>
                              <h2 align="center">DIRECCION: 1ra. Avenida 1-37 Segundo Nivel Zona 4</h2>
                              <h2 align="center">TELEFONO: 7838-8103</h2>
                              <h2 align="center">CORREO: academia.sanjose1995@gmail.com</h2>
                              <h2 align="center">WEB: www.academiasanjose.com</h2>
                              <h2 align="center">Codigo de Alumno:'.$id_alumno.'/'.$ciclo.'</h2><br><br>
                              
							  <table>
                              
                              <tr>
                              <td>
							  <label class="control-label" for="typeahead"><b>Alumno:</b> </label>'.$nombres.' '. $apellidos.'<br>
                              <label class="control-label" for="typeahead"><b>Teléfono:</b> </label>'.$tel.'<br>
                              <label class="control-label" for="typeahead"><b>Direccion:</b> </label>'.$direccion.'<br>
                              <label class="control-label" for="typeahead"><b>Encargado:</b>&nbsp;</label>'.$nencargado.'<br>
                              </td>
                              <td><label class="control-label" for="typeahead"><b></b>&nbsp;</label><br>
                              <label class="control-label" for="typeahead"><b></b>&nbsp;</label><br>
                              <label class="control-label" for="typeahead"><b></b>&nbsp;</label><br></td>
                              <td></td>
                              <td>
                              <label class="control-label" for="typeahead"><b>Horario:</b>&nbsp;</label>'.$horarios.'<br>
                              <label class="control-label" for="typeahead"><b>Jornada:</b>&nbsp;</label>'.$jornada.'<br>
                              <label class="control-label" for="typeahead"><b>Curso:</b>&nbsp;</label>'.$curso.'<br>
                              <label class="control-label" for="typeahead"><b></b>&nbsp;</label><br>
                              
                              </td>
                              </tr>
                              </table>
                              
                              <br><br><br>
							  
            <div class="row-fluid sortable">	
				<!--<div class="box span12">-->
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  
                            <tbody>
								<tr>
									<td class="center">Inscripcion<br><img src="img/cuadro.png"></td>
									<td class="center">Enero<br><img src="img/cuadro.png"></td>
									<td class="center">Febrero<br><img src="img/cuadro.png"></td>
                                    <td class="center">Marzo<br><img src="img/cuadro.png"></td>
                                    <td class="center">Abril<br><img src="img/cuadro.png"></td>
                                    <td class="center">Mayo<br><img src="img/cuadro.png"></td>
                                    
								</tr> 
                                <tr>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
								</tr>  
                                <tr>
									<td class="center">Mayo<br><img src="img/cuadro.png"></td>
									<td class="center">Junio<br><img src="img/cuadro.png"></td>
									<td class="center">Julio<br><img src="img/cuadro.png"></td>
                                    <td class="center">Agosto<br><img src="img/cuadro.png"></td>
                                    <td class="center">Septiembre<br><img src="img/cuadro.png"></td>
                                    <td class="center">Octubre<br><img src="img/cuadro.png"></td>
                                    
								</tr>  
                                <tr>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
									<td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
                                    <td class="center">&nbsp;</td>
								</tr>  
                                <tr>
									<td class="center">Noviembre<br><img src="img/cuadro.png"></td>
									<td class="center">Papeleria<br><img src="img/cuadro.png"></td>
                                    <td class="center">Mantenimiento<br><img src="img/cuadro.png"></td>
									
                                    
								</tr>  
							  </tbody>
                       
						 </table><br><br><br><br><br>
                           
					</div>
                    
				<!--</div><!--/span-->
                <table class="center" border="0" style="width:100%">
                <tr>
                    <td>
                        <label class="control-label" for="name"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
                    </td>
                    <td>
                        <label class="control-label" for="name"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr class="center">
                    <td class="center">
                        Firma Encargado
                    </td>
                    <td class="center">
                        Firma Director o Secretario
                    </td>
                    <td class="center">
                        SELLO
                    </td>
                    <td class="center">
                        &nbsp;
                    </td>
                </tr>
            </table>
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
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://e-technologyca.com" alt="Academia_San_Jose">Selvin Benito</a></span>
			
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

$mpdf=new mPDF('c');

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML(estado_de_cuenta_bancos.php);
$mpdf->Output('Constancia_inscripcion.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}
?>