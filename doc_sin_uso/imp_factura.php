<?php
require 'connection.php';
require 'core.php';

$id_factura     =   $_POST['factura'];
$id_serie       =   $_POST['serie'];
$flag           =   $_POST['imp'];
$f              =   date("d/m/Y");
$opt            =   "PDF";
$ob             =   "";//observaciones de la factura pero aun no se sabe de donde se obtienen!!

// SI LA VARIABLE IMP DEL MANTO DE FACTURAS ES POSITIVA SE IMPRIMIRA LA FACTURA DE LO CONTRARIO SOLO SE VISUALIZARA!!
if($flag == "yes"){
$query  =   mysql_query("SELECT `no_factura`,`serie`,`fecha`,`id_cliente`,`pedido`,`total`,`estatus` FROM `factu_principal` WHERE `no_factura` = '$id_factura' AND `serie` = '$id_serie'");
$r=mysql_fetch_array($query);

    $id_cliente         =   $r['id_cliente'];
    //$id_vendedor        =   $r['id_vendedor'];
    $pedido             =   $r['pedido'];
    $query1             =   mysql_query("SELECT `id_pedido`,`id_vendedor` FROM `pedidos_cabecera` WHERE id_pedido = '$pedido'");
    $r1                 =   mysql_fetch_array($query1);
    $id_vendedor        =   $r1['id_vendedor'];
    

    $query4             =   mysql_query("SELECT `codigo`,`nit`,`direccion_fiscal`,`nombre_fiscal`,`tel` FROM `clientes` WHERE codigo = '$id_cliente'");
    $r4                 =   mysql_fetch_array($query4);
    $nombre_cliente     =   $r4['nombre_fiscal'];
    $nit                =   $r4['nit'];
    $direccion          =   $r4['direccion_fiscal'];
    $tel                =   $r4['tel'];
    
    $query6             =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM `vendedores` WHERE id_vendedor = '$id_vendedor'");
    $r6                 =   mysql_fetch_array($query6);
    $vendedor_name      =   $r6['nombre_vendedor'] . " " . $r6['apellido_vendedor'];
    
    //$test = "FACTURA: $id_factura<br> SERIE: $id_serie<br> FLAG: $flag <br> CLIENTE: $id_cliente<br>";
    
    $encabezado    =   "     <tbody>
                                <tr>
                                    <td width=\"12%\">&nbsp;</td>
									<td width=\"69%\">&nbsp;</td>
                                    <td width=\"21%\">&nbsp;</td>
								</tr>
								<tr>
                                    <td height=\"170\" valign=\"bottom\" style=\"font-size:8px\">&nbsp;</td>
									<td valign=\"bottom\" style=\"font-size:8px\">$nombre_cliente</td>
									<td valign=\"bottom\" style=\"font-size:8px\">$nit</td>
								</tr>
                                <tr>
                                    <td height=\"16\" valign=\"bottom\" style=\"font-size:8px\" >&nbsp;</td> 
									<td valign=\"bottom\" style=\"font-size:8px\" >$direccion</td> 
                                    <td valign=\"bottom\" style=\"font-size:8px\">$f</td>
								</tr>
                                <tr>
                                    <td height=\"16\" valign=\"bottom\" style=\"font-size:8px\">&nbsp;</td>
									<td valign=\"bottom\" style=\"font-size:8px\">$ob</td>
									<td  valign=\"bottom\" style=\"font-size:8px\">$vendedor_name</td>
								</tr>
                                <tr>
                                    <td height=\"40\">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
								</tr>
							 </tbody>
                ";
    
    $query2     =   mysql_query("SELECT `no_factura`,`serie`,`codigo`,`cantidad`,`descripcion`,`p_unitario`,`total` FROM `factu_secundaria` WHERE `no_factura` = '$id_factura' AND serie = '$id_serie'");

    $tot        =   0;
    $numero     =   0;
    while($r2=mysql_fetch_array($query2)){
        
        $codigo     =   $r2['codigo'];
        $can        =   $r2['cantidad'];
        $prod       =   $r2['descripcion'];
        $um         =   '';
        $precio_u   =   $r2['p_unitario'];
        $total      =   $r2['total'];
        
        if($total > 0){
        $val=$val . "
                         <tbody>
                              <tr>
                                <td width=\"19%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$codigo</td>
                                <td width=\"10%\">$can</td>
                                <td width=\"45%\">$prod</td>
                                <td width=\"10%\">$um</td>
                                <td width=\"14%\">Q.$precio_u</td>
                                <td width=\"11%\">Q.$total</td>
                              </tr>
                         </tbody>
                    ";
        }

        $tot  =   $tot + $total;
        $numero = $numero + 1;
    }

$tot      =   number_format("$tot",2);

$count  =   0;
$resta  =   34-$numero;

while($count < $resta){
    $count  =   $count +1;
    $espacios   = $espacios.  "    
				              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                ";
}

$totales    =   "     <tbody>
				              $espacios
                              <tr>
                              <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                              <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                               <tr>
                              <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                               <tr>
                              <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                              <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td >Q.$tot</td>
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
	<link href=\'http://fonts.googleapis.com/css?family=Caviar+Dreams:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext\' rel=\'stylesheet\' type=\'text/css\'>
	<!-- end: CSS -->
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->		
</head>

<body>
		<!-- start: Header -->
	'. $test .'
                          <table style="width:100%" border="0">
                                '. $encabezado .'
                          </table>
                        
                          <table width="100%" border="0">
                                '. $val .'
                                <tbody>
				              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>                            
							  </tbody>
                         '. $totales .'
                          </table>
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
                          
            <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
						     
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
	<!--
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://e-technologyca.com" alt="ILH">E-Technology C.A.</a></span>
			
		</p>

	</footer>-->
	
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
$mpdf->Output('factura.pdf', 'D');
//$query  =   mysql_query("TRUNCATE TABLE `rep_ingreso_bancos`");
exit;

}else{

}
}
?>