<?php
require 'connection.php';
require 'core.php';

$id_pedido      =   $_POST['id_pedido'];
$opt            =   "PDF";

$query  =   mysql_query("SELECT * FROM `pedidos_cabecera` WHERE `id_pedido` = '$id_pedido'");
$r=mysql_fetch_array($query);

    $id_pedido      =   $r['id_pedido'];
    $fecha_pedido   =   $r['fecha_pedido'];
    $fecha_despacho =   $r['fecha_despacho'];
    $id_cliente     =   $r['id_cliente'];
    $id_vendedor    =   $r['id_vendedor'];
    $transporte      =   $r['transporte_departamental'];
    $ob             =   $r['observaciones'];
    
    $query1     =   mysql_query("SELECT `codigo`,`nit`,`tel`,`nombre_comercial`,`nombre_contacto`,`nombre_fiscal`,`direccion_fiscal`,`direccion_entrega`,`forma_pago`,`credito`,`direccion_transporte` FROM `clientes` WHERE codigo = '$id_cliente'");
    $result1    =   mysql_fetch_array($query1);
    
    $nit                =   $result1['nit'];
    $tel                =   $result1['tel'];
    $nombre_comercial   =   $result1['nombre_comercial'];
    $nombre_contacto    =   $result1['nombre_contacto'];
    $nombre_fiscal      =   $result1['nombre_fiscal'];
    $dir_fiscal         =   $result1['direccion_fiscal'];
    $dir_entrega        =   $result1['direccion_entrega'];
    $forma_pago         =   $result1['forma_pago'];
    $credito            =   $result1['credito'];
    $dir_transporte     =   $result1['direccion_transporte'];
    
    
    $query3     =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM vendedores WHERE id_vendedor = '$id_vendedor'");
    $r3         =   mysql_fetch_array($query3);
    $vendedor   =   $r3['nombre_vendedor'] . " " . $r3['apellido_vendedor'];
    
    $query2     =   mysql_query("SELECT * FROM `pedidos_secundaria` WHERE `id_pedido` = '$id_pedido'");

    $tot      =   0;

    while($r2=mysql_fetch_array($query2)){
        
        $codigo     =   $r2['codigo'];
        $can        =   $r2['cantidad'];
        $prod       =   $r2['producto'];
        $precio_u   =   $r2['precio_u'];
        $total      =   $r2['total'];
        
        if($total > 0){
        $val=$val . "
                    <tbody>
                        <tr>
                            <td class=\"center\"> $codigo </td>
                            <td class=\"center\"> $can </td>
                            <td class=\"center\"> $prod </td>
                            <td class=\"center\"> $precio_u </td>
                            <td class=\"center\"> $total </td>
                        <tr>
                    <tbody>
                    ";
        }

        $tot  =   $tot + $total;
    }

$tot      =   "Q" . number_format("$tot",2);
$totales    =   "     <tbody>
								<tr>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">&nbsp;</td>
									<td class=\"center\">TOTAL</td>
                                    <td class=\"center\">$tot</td>
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
                <h3>Tel (502) 2439-4260 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PEDIDO: &nbsp; '. $id_pedido .'</h3>
                <h3>Fax (502) 2439-4705 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h3>
                <div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
                            <table border="0" style="width:100%">
                                <tr>
                                    <td class="center">
                                        &nbsp;
                                    </td>
                                    <td class="center">
                                        FECHA:&nbsp;'. $da .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        CLIENTE:&nbsp;'. $nombre_comercial .'
                                    </td>
                                    <td class="center">
                                        CONTACTO:&nbsp;'. $nombre_contacto .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        FACTURAR A:&nbsp;'. $nombre_fiscal .'
                                    </td>
                                    <td class="center">
                                        DIRECCION FISCAL:&nbsp;'. $dir_fiscal .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        NIT:&nbsp;'. $nit .'
                                    </td>
                                    <td class="center">
                                        TELEFONO:&nbsp;'. $tel .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        VENDEDOR:&nbsp;'. $vendedor .'
                                    </td>
                                    <td class="center">
                                        DIRECCION DE ENTREGA:&nbsp;'. $dir_entrega .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        CONDICIONES DE PAGO:&nbsp;'. $forma_pago .'&nbsp;'. $credito .'
                                    </td>
                                    <td class="center">
                                        FECHA DE DESPACHO:&nbsp;'. $fecha_despacho .'
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">
                                        DIRECCION TRANSPORTE:&nbsp; '. $dir_transporte .'
                                    </td>
                                    <td class="center">
                                        TRANSPORTE DEPARTAMENTAL:&nbsp;'. $transporte .'
                                    </td>
                                </tr>
                            </table>
                            <br>
                            
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>CODIGO</th>
                                      <th>CANTIDAD</th>
                                      <th>PRODUCTO</th>
                                      <th>PRECIO UNITARIO</th>
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
                        Vo. Bo. Gerencia de ventas
                    </td>
                    <td class="center">
                        Vendedor
                    </td>
                    <td class="center">
                        Firma y Sello Cliente
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
$mpdf->Output('Pedido.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}else{

}
?>