<?php
require 'connection.php';
require 'core.php';

$del    =   $_POST['date01'];
$al     =   $_POST['date02'];
$vendedor =  $_POST['vendedor'];
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

$query  = mysql_query("SELECT `id_vendedor`,`id_control`,`total`, `fecha`,`no_docto`, `cliente` FROM `cxc` WHERE  fecha >= '$del' AND fecha <= '$al' AND id_vendedor = '$vendedor' ");
while($r      = mysql_fetch_array($query)){

    
//$idcxc      = $r['id_control'];
$fecha      = $r['fecha'];
$pedido     = $r['no_docto'];
$cliente    = $r['cliente'];
//$total      = $r['total'];
$vendedor   = $r['id_vendedor'];
     
    $query7    = mysql_query("SELECT * FROM `pedidos_cabecera` WHERE  id_pedido = '$pedido' ");
   $r7      = mysql_fetch_array($query7);
    
    $total  =   $r7['total_siniva'];


//$vabono     = ""    ;

    $query4 = mysql_query("SELECT `nombre_comercial`,`codigo` FROM `clientes` WHERE codigo = '$cliente' ");
$r4 = mysql_fetch_array($query4);

$cliente_nombre = $r4['nombre_comercial'];

$query3 =   mysql_query("SELECT * FROM `comision` WHERE vendedor LIKE '$vendedor' ");
while($r3 = mysql_fetch_array($query3)){
    
$por_comision   =  "0." . $r3['total_comision'];
$porcen         =  $r3 ['total_comision'];
    
    
    
    
     

    
$query5 = mysql_query("SELECT `id_pedido`,`cantidad`,`producto`,`total`,`precio`,`costo`,`impuesto` FROM `pedidos_secundaria` WHERE id_pedido = '$pedido'");
$r5     = mysql_fetch_array($query5);

$costo      =   $r5['costo'];
$cantidad   =   $r5['cantidad'];
$total_st   =   $costo * $cantidad;



$query6 = mysql_query("SELECT `id_vendedor`,`nombre_vendedor` FROM `vendedores` WHERE id_vendedor = $vendedor ");
$r6     = mysql_fetch_array($query6);
    
$n_vendedor =   $r6['nombre_vendedor'];
    
    
$utilidad   =   $total - $total_st;
$comision   =   $utilidad * $por_comision;
$utilidad_st=   $utilidad - $comision;


}

        
    //$tot_costo = $tot_costo + $tot_cos;
    $tot_tot        = $tot_tot + $comision;
    $tot_utili      = $tot_utili + $utilidad;
    $tot_utili_st   = $tot_utili_st + $utilidad_st;
    $tot_st         = $tot_st + $total_st;
    
   // $tot_saldo = $tot_saldo + $saldo;
    
    //$tot_uti   = $tot_uti + $utilidad;
  //  $abono  = "Q" . number_format("$abono",2);
    $utilidad  = "Q" . number_format("$utilidad",2);
    $utilidad_st  = "Q" . number_format("$utilidad_st",2);
    $total_st  = "Q" . number_format("$total_st",2);
    $comision  = "Q" . number_format("$comision",2);
    $total  = "Q" . number_format("$total",2);
    //$utilidad = "Q".number_format("$utilidad",2);
     $val=$val . "
                <tbody>
                    <tr>
                        <td class=\"center\"> $fecha </td>
				        <td class=\"center\"> $pedido </td>
                        <td class=\"center\"> $cliente_nombre </td>
                        <td class=\"center\"> $n_vendedor </td>
                        <td class=\"center\"> $total </td>
                        <td class=\"center\"> $total_st </td>
                        <td class=\"center\"> $utilidad </td>
				        <td class=\"center\"> $utilidad_st </td>
                        <td class=\"center\"> $comision </td>
                        
                        
                       
                    <tr>
                </tbody>
                ";
    $tot_cos = 0;
    
}
$tot_utili    = "Q" . number_format("$tot_utili",2);
$tot_utili_st  = "Q" . number_format("$tot_utili_st",2);
$tot_st  = "Q" . number_format("$tot_st",2);
$tot_tot    = "Q" . number_format("$tot_tot",2);
//$tot_saldo  = "Q" . number_format("$tot_saldo",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">TOTALES</td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\"></td>
									<td class=\"center\">$tot_st</td>
                                    <td class=\"center\">$tot_utili</td>
                                    <td class=\"center\">$tot_utili_st</td>
                                    <td class=\"center\">$tot_tot</td>
                                    
								</tr>                               
							  </tbody>
                ";

                                
if($opt == "PDF"){
$html   =   '
<!DOCTYPE html>
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
				<a class="brand" href="index.php"><span>ST System</span></a>			
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
                             <h2>Comisión Vendedor '. $n_vendedor .' %'. $porcen .'</h2>   
            <div class="row-fluid sortable">	
				<!--<div class="box span12">-->
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>FECHA PEDIDO</th>
									  <th>NO.PEDIDO</th>
                                      <th>CLIENTE</th>
                                      <th>VENDEDOR</th>
                                      <th>VALOR PEDIDO</th>
                                      <th>COSTO TOTAL ST</th>
                                      <th>UTILIDAD TOTAL</th>
                                      <th>UTILIDAD ST</th>
                                      <th>COMISIÓN</th>
                                      
									  
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
$mpdf->Output('Reporte_Comisiones_totales.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}
?>