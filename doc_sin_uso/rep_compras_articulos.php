<?php
require 'connection.php';

$del            =   $_POST['date01'];
$al             =   $_POST['date02'];
$codigo         =   $_POST['codigo'];
$opt            =   "PDF";
$tot_cantidad   =   0;
$tot_costo      =   0;

$query  =   mysql_query("SELECT `id_orden_compra`,`id_proveedor`,`fecha_orden_compra` FROM orden_compra_principal WHERE fecha_orden_compra >= '$del' AND fecha_orden_compra <= '$al'");


while($r=mysql_fetch_array($query)){
    
    $id     =   $r['id_orden_compra'];
    $prov   =   $r['id_proveedor'];
    $fecha  =   $r['fecha_orden_compra'];
    
    $query2     =   mysql_query("SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedores` WHERE id_proveedor = '$prov'");
    $result2    =   mysql_fetch_array($query2);
    
    $name_prv   =   $result2['nombre_proveedor'];
   
    $query1 =   mysql_query("SELECT * FROM `orden_compra_secundaria` WHERE id_orden_compra = '$id' AND codigo = '$codigo'");
    
    while($r1=mysql_fetch_array($query1)){
        
        $codigo =   $r1['codigo'];
        $des    =   $r1['descripcion'];
        $can    =   $r1['cantidad'];
        $cos    =   $r1['costo'];
        
        
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\"> $fecha </td>
				        <td class=\"center\"> $codigo </td>
				        <td class=\"center\"> $des </td>
				        <td class=\"center\"> $can </td>
                        <td class=\"center\"> $cos </td>
                        <td class=\"center\"> $name_prv </td>
                    <tr>
                <tbody>
                ";
        $tot_cantidad   =   $tot_cantidad + $can;
        $tot_costo      =   $tot_costo + $cos;
    }
}

$tot_cantidad   =   number_format("$tot_cantidad",2);
$tot_costo      =   number_format("$tot_costo",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
                                    <td class=\"center\">TOTAL</td>
									<td class=\"center\">$tot_cantidad</td>
                                    <td class=\"center\">$tot_costo</td>
                                    <td class=\"center\">&nbsp;</td>
								</tr>                               
							  </tbody>
                ";

                                
if($opt == "PDF"){
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
                <h1>Reporte de Compras</h1>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                              <h2>Fecha</h2>
                            
							  <b>del:</b>&nbsp;'. $del .'<br>
							  <b>al:</b>&nbsp;'. $al .'<br>
							  <b>Código:</b>&nbsp;'. $codigo .'<br><br>
							  
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>FECHA</th>
									  <th>CODIGO</th>
									  <th>DESCRIPCION</th>
									  <th>UNIDADES</th>
                                      <th>COSTO</th>
                                      <th>PROVEEDOR</th>
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

$mpdf=new mPDF('c');

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML(estado_de_cuenta_bancos.php);
$mpdf->Output('Reporte_de_compras.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}else{

}
?>