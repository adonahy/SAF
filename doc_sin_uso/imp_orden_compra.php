<?php
require 'connection.php';

$id_orden_compra=   $_POST['id_orden'];
$opt            =   "PDF";

$query  =   mysql_query("SELECT * FROM `orden_compra_principal` WHERE `id_orden_compra` = '$id_orden_compra'");
$r=mysql_fetch_array($query);

    $id_compra      =   $r['id_orden_compra'];
    $id_prod        =   $r['id_orden_prod'];
    $fecha          =   $r['fecha_orden_compra'];
    $tiempo         =   $r['tiempo_entrega'];
    $condicion      =   $r['condicion_pago'];
    $moneda         =   $r['mondeda'];
    $lugar          =   $r['lugar_entrega'];
    $horario        =   $r['horario_entrega'];
    $id_prov        =   $r['id_proveedor'];
    $ob             =   $r['observaciones'];
    $estatus        =   $r['estatus'];
    
    $query1     =   mysql_query("SELECT `id_proveedor`,`nombre_proveedor`,`direccion`,`no_telefono_proveedor`,`contacto` FROM `proveedores` WHERE id_proveedor = '$id_prov'");
    $result1    =   mysql_fetch_array($query1);
    
    $name_prov  =   $result1['nombre_proveedor'];
    $dir_prov   =   $result1['direccion'];
    $tel_prov   =   $result1['no_telefono_proveedor'];
    $contacto_prov= $result1['contacto'];
    
    $query2     =   mysql_query("SELECT * FROM `orden_compra_secundaria` WHERE `id_orden_compra` = '$id_orden_compra'");

    $total      =   0;

    while($r2=mysql_fetch_array($query2)){
        
        $codigo     =   $r2['codigo'];
        $des        =   $r2['descripcion'];
        $ref        =   $r2['referencia'];
        $can        =   $r2['cantidad'];
        $cos        =   $r2['costo'];
        $tot        =   $r2['total'];
        
        if($tot > 0){
        $val=$val . "
                    <tbody>
                        <tr>
                            <td class=\"center\"> $codigo </td>
                            <td class=\"center\"> $des </td>
                            <td class=\"center\"> $ref </td>
                            <td class=\"center\"> $can </td>
                            <td class=\"center\"> $cos </td>
                            <td class=\"center\"> $tot </td>
                        <tr>
                    <tbody>
                    ";
        }

        $total  =   $total + $tot;
    }

$total      =   number_format("$total",2);
$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
                                    <td class=\"center\">&nbsp;</td>
									<td class=\"center\">TOTAL</td>
                                    <td class=\"center\">$total</td>
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
				<a class="brand" href="index.php"><span>ILH System</span></a>			
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
                <h1>INDUSTRIAS LH, SOCIEDAD ANONIMA</h1>
                <h3>35 Avenida 0-25 Zona 11 Guatemala, Guatemala</h3>
                <h3>Tel (502) 2439-4260 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ORDEN DE COMPRA: &nbsp; '. $id_compra .'</h3>
                <h3>Fax (502) 2439-4705 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ORDEN DE PRODUCCION: &nbsp; '. $id_prod .'</h3>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                            <table border="0" style="width:100%">
                                <tr>
                                    <td class="center">
                                        PROVEEDOR:&nbsp;'. $name_prov .'
                                    </td>
                                    <td class="center">
                                        FECHA:&nbsp;'. $fecha .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        DIRECCION:&nbsp;'. $dir_prov .'
                                    </td>
                                    <td class="center">
                                        TIEMPO DE ENTREGA:&nbsp;'. $tiempo .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        TELEFONO:&nbsp;'. $tel_prov .'
                                    </td>
                                    <td class="center">
                                        CONDICIONES DE PAGO:&nbsp;'. $condicion .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        CONTACTO:&nbsp;'. $contacto_prov .'
                                    </td>
                                    <td class="center">
                                        MONEDA:&nbsp;'. $moneda .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        OBSERVACIONES:&nbsp;'. $ob .'
                                    </td>
                                    <td class="center">
                                        LUGAR DE ENTREGA:&nbsp;'. $lugar .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        &nbsp;
                                    </td>
                                    <td class="center">
                                        HORARIO DE ENTREGA:&nbsp;'. $horario .'
                                    </td>
                                </tr>
                            </table>
                            <br>
							  Agradeceremos atendernos con lo siguiente, de acuerdo a nuestros requerimientos
                            
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>CODIGO</th>
									  <th>DESCRIPCION</th>
									  <th>REFERENCIA PROVEEDOR</th>
                                      <th>CANTIDAD</th>
                                      <th>COSTO</th>
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
								</tr>                               
							  </tbody>
                         '. $totales .'
						 </table>     
					</div>
				</div><!--/span-->
			</div><!--/row-->
            <br>
            
            <table class="center" border="0" style="width:100%">
                <tr>
                    <td>
                        <label class="control-label" for="name"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
                    </td>
                    <td>
                        <label class="control-label" for="name"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
                    </td>
                    <td>
                        <label class="control-label" for="name"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
                    </td>
                </tr>
                <tr class="center">
                    <td class="center">
                        ENCARGADO DE COMPRAS
                    </td>
                    <td class="center">
                        CONTABILIDAD
                    </td>
                    <td class="center">
                        VO. BO.
                    </td>
                </tr>
            </table>
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

$mpdf=new mPDF('c');

$mpdf->WriteHTML($html);

//$mpdf->WriteHTML(estado_de_cuenta_bancos.php);
$mpdf->Output('Orden_de_compra.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}else{

}
?>