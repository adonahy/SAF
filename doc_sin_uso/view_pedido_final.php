<?php
require 'connection.php';
require 'core.php';

$pedido =   $_POST['no_pedido'];
$opt    =   "PDF";

$query  = mysql_query("SELECT `id_pedido`,`id_cliente`,`id_vendedor`,`fecha_despacho`,`impuesto` FROM `pedidos_cabecera` WHERE id_pedido = '$pedido'");
$r      = mysql_fetch_array($query);

$id_cliente = $r['id_cliente'];
$id_vendedor= $r['id_vendedor'];
$fecha_viaje= $r['fecha_despacho'];
$iva        = $r['impuesto'];


$query1 = mysql_query("SELECT `nombre_comercial`,`codigo`,`tel` FROM `clientes` WHERE codigo = '$id_cliente'");
$r1     = mysql_fetch_array($query1);

$cliente_nombre = $r1['nombre_comercial'];
$cliente_tel    = $r1['tel'];

$query2 = mysql_query("SELECT `id_vendedor`,`nombre_vendedor` FROM `vendedores` WHERE id_vendedor = '$id_vendedor'");
$r2     = mysql_fetch_array($query2);

$vendedor_nombre    = $r2['nombre_vendedor'];
    
$query3 = mysql_query("SELECT `id_pedido`,`cantidad`,`producto`,`sub_total`,`precio`,`costo` FROM `pedidos_secundaria` WHERE id_pedido = '$pedido'");

while($r3=mysql_fetch_array($query3)){
    //cantidad - descripcion - precio total
    $cantidad   = $r3['cantidad'];
    $des        = $r3['producto'];
    $costo      = $r3['costo'];
    $precio     = $r3['precio'];
    $total      = $r3['sub_total'];
   // $impuesto   = $r3['impuesto'];
    $total_st   = $cantidad * $costo;
    $tot        = $tot + $total;
    $tot_iva    = $tot + $iva;
    $tot_pre    = $tot_pre + $precio;
    $tot_cos    = $tot_cos + $costo;
    $tot_st     = $tot_st  + $total_st;
    $tot_uti    = $total - $total_st;
    $total_uti  = $total_uti + $tot_uti;
    $costo      = "Q" . number_format("$costo",2);
    $total      = "Q" . number_format("$total",2);
    $cantidad   = number_format("$cantidad",0);
    $precio     = "Q" . number_format("$precio",2);
    $total_st   = "Q" . number_format("$total_st",2);
    $tot_uti    = "Q" . number_format("$tot_uti",2);
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\"> $cantidad </td>
				        <td class=\"center\"> $des </td>
                        <td class=\"center\"> $costo </td>
                        <td class=\"center\"> $total_st </td>
                        <td class=\"center\"> $precio </td>
                        <td class=\"center\"> $total </td>
                        <td class=\"center\"> $tot_uti </td>
                    <tr>
                <tbody>
                ";
    
}
$tot_costo  = "Q" . number_format("$tot_cos",2);
$tot_precio = "Q" . number_format("$tot_pre",2);
$tot_tot    = "Q" . number_format("$tot",2);
$tot_st     = "Q" . number_format("$tot_st",2);
$total_uti  = "Q" . number_format("$total_uti",2);
$tot_iva    = "Q" . number_format("$tot_iva",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">TOTALES</td>
									<td class=\"center\"></td>
                                    <td class=\"center\">$tot_costo</td>
                                    <td class=\"center\">$tot_st</td>
                                    <td class=\"center\">$tot_precio</td>
                                    <td class=\"center\">$tot_tot</td>
                                    <td class=\"center\">$total_uti </td>
								</tr>
                                <tr>
									<td class=\"center\">CON IVA</td>
									<td class=\"center\"></td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\"></td>
                                    <td class=\"center\">$tot_iva</td>
                                    <td class=\"center\"></td>
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
                              <h2 align="center">SPORT AND TRAVEL</h2>
                              <h2 align="center">DIRECCION: 22 CALLE "A" 14-46 ZONA 11</h2>
                              <h2 align="center">TELEFONO: 2476-3490</h2>
                              <h2 align="center">CORREO: ventas@snt.com.gt</h2>
                              <h2 align="center">WEB: www.snt.com.gt</h2>
                              <h2 align="center">Pedido:'.$pedido.'</h2><br><br>
							  
							  <label class="control-label" for="typeahead"><b>Cliente:</b> </label>'.$cliente_nombre.'<br>
                              <label class="control-label" for="typeahead"><b>Teléfono:</b> </label>'.$cliente_tel.'<br>
                              <label class="control-label" for="typeahead"><b>Vendedor:</b> </label>'.$vendedor_nombre.'<br>
                              <label class="control-label" for="typeahead"><b>Fecha emisión:</b>&nbsp;</label>'.$da.'<br>
                              <label class="control-label" for="typeahead"><b>Fecha viaje:</b>&nbsp;</label>'.$fecha_viaje.'<br>
                              <h2><label class="control-label" for="typeahead"><b>IMPUESTO:</b>&nbsp;</label>'.$iva.'</h2><br><br>
							  
            <div class="row-fluid sortable">	
				<!--<div class="box span12">-->
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>CANTIDAD</th>
									  <th>DESCRIPCION</th>
                                      <th>COSTO ST</th>
                                      <th>PRECIO TOTAL S&T</th>
                                      <th>PRECIO UNITARIO CLIENTE</th>
                                      <th>PRECIO TOTAL</th>
                                      <th>UTILIDADES</th>
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
								</tr>                               
							  </tbody>
                         '. $totales .'
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
                        Firma vendedor
                    </td>
                    <td class="center">
                        Firma cliente
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
$mpdf->Output('Pedido_final.pdf', 'D');
$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}
?>