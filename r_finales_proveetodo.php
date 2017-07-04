<?php
require 'connection.php';
require 'core.php';

//$del    =   $_POST['date01'];
//$al     =   $_POST['date02'];
$idcurso =  $_POST['curso'];
$opt    =   "PDF";
/*
<th>FECHA</th>
									  <th>NO.PEDIDO</th>
                                      <th>CLIENTE</th>
                                      <th>VENDEDOR</th>
                                      <th>FECHA VIAJE</th>
									  <th>COSTO TOTAL</th>
                                      <th>PRECIO TOTAL</th>
                                      <th>UTILIDAD</th>
*/


                                 
if($idcurso=="0"){

$query  = mysql_query("SELECT * FROM `alumno` ORDER BY id_alumno ASC ");}
else{
$query  = mysql_query("SELECT * FROM `alumno` WHERE nivel = '$idcurso' ");
}
while($r      = mysql_fetch_array($query)){

$id             =   $r['id_alumno'] . "/ 2017";
$fecha          =   $r['fecha_creacion'];
$nombres        =   $r['nombres'];
$apellidos      =   $r['apellidos'];
$nombre_completo=   $apellidos . ", " . $nombres;
$curso          =   $r['nivel'];
$plan           =   $r['id_jornada'];
$horario        =   $r['id_horario'];
$encargado      =   $r['nombre_encargado'];
$tel            =   $r['telefono'];
    
$query4   =   mysql_query("SELECT `id_curso`,`nombre_curso` FROM `cursos` WHERE id_curso = '$curso'");
$r4       =   mysql_fetch_array($query4);
$curso  =   $r4['nombre_curso'];
    if($idcurso=="0"){
        $curso2 ="todos los cursos";
    }
    else{
        $curso2 = $r4['nombre_curso'];
    }

                                  
$query5   =   mysql_query("SELECT `id_jornada`,`jornada` FROM `jornada` WHERE id_jornada = '$plan'");
$r5       =   mysql_fetch_array($query5);
$plan  =   $r5['jornada'];
                                  
$query6   =   mysql_query("SELECT `id_horarios`,`hora` FROM `horarios` WHERE id_horarios = '$horario'");
$r6       =   mysql_fetch_array($query6);
$horario  =   $r6['hora'];



     $val=$val . "
                <tbody>
                    <tr>
                        <td class=\"center\"> $fecha </td>
				        <td class=\"center\"> $id </td>
                        <td class=\"center\"> $nombre_completo </td>
				        <td class=\"center\"> $curso </td>
                        <td class=\"center\"> $plan </td>
                        <td class=\"center\"> $horario </td>
                        <td class=\"center\"> $encargado </td>
                        <td class=\"center\"> $tel </td>
                        
                       
                    <tr>
                <tbody>
                ";
    $tot_cos = 0;
    
}

                                
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
                           <h1>Lista de alumnos <br> '. $curso2 . '</h1>   
            <div class="row-fluid sortable">	
				<!--<div class="box span12">-->
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>FECHA</th>
									  <th>CODIGO ALUMNO</th>
                                      <th>ALUMNO</th>
                                      <th>CURSO</th>
                                      <th>PLAN</th>
                                      <th>HORARIO</th>
                                      <th>ENCARGADO</th>
                                      <th>TELEFONO</th>
                                      									  
                                  </tr>
							  </thead>  
                              
                      '. $val .'
      
                              
						 </table><br><br><br><br><br>
                           
					</div>
                    
				<!--</div><!--/span-->
                
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
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://e-technologyca.com" alt="ST">E-Technology C.A.</a></span>
			
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
$mpdf->Output('listado.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}
?>