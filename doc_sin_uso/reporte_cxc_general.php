<?php
require 'connection.php';

$del            =   $_POST['date01'];
$al             =   $_POST['date02'];
$opt            =   $_POST['opt'];
//$banco_t        =   $_POST['banco'];
$documento      =   $_POST['documento'];

$query  =   mysql_query("SELECT `fecha`,`id_cliente`,`total`,`no_factura`,`serie` FROM `factu_principal` WHERE estatus != '3' AND fecha >= '$del' AND fecha <= '$al' ORDER BY id_cliente");

while($r=mysql_fetch_array($query)){
  
    $fecha              =   $r['fecha'];
    $id_cliente         =   $r['id_cliente'];
    $total_factu        =   $r['total'];
    $no_factura         =   $r['no_factura'];
    $no_factura_ref     =   "FAC. " . $no_factura;
    $serie              =   $r['serie'];
    $doctos             =   "";
    $saldo              =   0;
    $abono              =   0;
    
    $query2 =   mysql_query("SELECT `codigo`,`nombre_comercial` FROM `clientes` WHERE codigo = '$id_cliente'");
    $r2     =   mysql_fetch_array($query2);
    
    $nombre_cliente =   $r2['nombre_comercial'];
    
    $query3 =   mysql_query("SELECT `id_cxc`,`no_docto`,`serie`,`v_abono` FROM `cxc_detalle` WHERE no_docto = '$no_factura' AND serie = '$serie'");
    
    while($r3=mysql_fetch_array($query3)){
        $id_cxc =   $r3['id_cxc'];
        if($documento == 'Recibos'){
            $query1 =   mysql_query("SELECT `id_cxc`,`banco`,`cuenta`,`tipo_docto`,`no_recibo` FROM `cxc_cabecera` WHERE id_cxc = '$id_cxc' AND tipo_docto = 'Recibo' AND id_cliente = '$id_cliente'");
           
        }else if($documento == 'Notas'){
            $query1 =   mysql_query("SELECT `id_cxc`,`banco`,`cuenta`,`tipo_docto`,`no_recibo` FROM `cxc_cabecera` WHERE id_cxc = '$id_cxc' AND tipo_docto = 'Notas' AND id_cliente = '$id_cliente'");
          
        }else{
            $query1 =   mysql_query("SELECT `id_cxc`,`banco`,`cuenta`,`tipo_docto`,`no_recibo` FROM `cxc_cabecera` WHERE id_cxc = '$id_cxc' AND id_cliente = '$id_cliente'");
           
        }
       
            $r1     =   mysql_fetch_array($query1);
            $banco  =   $r1['banco'];

            $tipo   =   $r1['tipo_docto'];

            if($tipo == 'Recibo'){
                $doctos = $doctos . "REC.";
            }
            if($tipo == 'Notas'){
                $doctos = $doctos . "NOT.";
            }
        
        $abono  =   $abono + $r3['v_abono'];
        
        if ($doctos == ""){
            $doctos = "";
        }else{
            $doctos =   $doctos . $r1['no_recibo'] . ", ";
        }
        
    }
    
    $saldo  =   $total_factu - $abono;
    
    if($saldo < $total){
        $diferencia = 0;
    }else{
        $diferencia = 1;
    }
    
    
    if($doctos == "" && $deferencia > 0){
        $doctos = "No se a cancelado nada";
    }
    
    if($doctos != "" || $documento == "General"){
    $total_facturas =   $total_facturas + $total_factu;
    $total_saldo    =   $total_saldo    + $saldo;
    $saldo          =   "Q" . number_format("$saldo",2);
    $total_factu    =   "Q" . number_format("$total_factu",2);
    
    $val=$val . "
                <tbody>
                    <tr>
				        <td class=\"center\"> $fecha </td>
				        <td class=\"center\"> $doctos </td>
				        <td class=\"center\"> $nombre_cliente </td>
				        <td class=\"center\"> $banco </td>  
                        <td class=\"center\"> $no_factura_ref </td>
                        <td class=\"center\"> $total_factu </td>
                        <td class=\"center\"> $saldo </td>
                        
                    <tr>
                <tbody>
                ";
    }
    
}

$total_facturas =   "Q" . number_format("$total_facturas",2);
$total_saldo    =   "Q" . number_format("$total_saldo",2);

$totales    =   "     <tbody>
								<tr>
									<td class=\"center\"><b>TOTALES</b></td>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td> 
                                    <td class=\"center\">&nbsp;</td>
                                    <td class=\"center\">$total_facturas</td>
                                    <td class=\"center\">$total_saldo</td>
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
                <h1>Reporte general de clientes</h1>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                              <h2>Fecha</h2>
                            
							  <label class="control-label" for="date01">del:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="'. $del .'">
							  </div>
							  <label class="control-label" for="date02">al:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date02" name="date02" value="'. $al .'">
							  </div>
							  <label class="control-label" for="documento">Tipo de documento:</label>
							  <div class="controls">
								<input type="text" class="span46 typeahead" id="documento" name="documento" value="'. $documento .'">
							  </div>
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>Fecha</th>
									  <th>No. Docto</th>
									  <th>Cliente</th>
									  <th>Banco</th>
                                      <th>Referencia</th>
                                      <th>Valor</th>
                                      <th>Saldo</th>
                                      
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
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://e-technologyca.com" alt="ILH">E-Technology C.A.</a></span>
			
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
$mpdf->Output('Reporte_general_clientes.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `estados_cuenta` ");
exit;

}else{

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=estado_de_cuenta.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('FECHA', 'NO.DOCTO', 'CENCEPTO', 'CREDITO', 'DEBITO'));

$rows = mysql_query("SELECT `fecha`,`no_docto`,`concepto`,`credito`,`debito` FROM `estados_cuenta` WHERE banco = '$banco' AND cuenta = '$cuenta' ORDER BY `fecha`, `id` ASC");

while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
}
//$query  =   mysql_query("TRUNCATE TABLE `estados_cuenta` ");
?>