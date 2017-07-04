<?php
    require 'ini.php';
    require 'connection.php';
    require 'core.php';
    $monica = "no";
    $flag1  = "one";
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
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
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<script type="text/javascript">    
    function search(codigo,name,producto,pu,producto2,pu2)
       {
          var xmlhttp_ex;
          var xml_producto;
          var xml_pu;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_ex  =   new XMLHttpRequest();
            xml_producto=   new XMLHttpRequest();
            xml_pu      =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_ex  =   new ActiveXObject("Microsoft.XMLHTTP");
            xml_producto=   new ActiveXObject("Microsoft.XMLHTTP");
            xml_pu      =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_ex.onreadystatechange = function() {
            if(xmlhttp_ex.readyState == 4 && xmlhttp_ex.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(name).innerHTML = xmlhttp_ex.responseText;
            }
          }
          
          xml_producto.onreadystatechange = function() {
            if(xml_producto.readyState == 4 && xml_producto.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(producto).innerHTML = xml_producto.responseText;
                document.getElementById(producto2).value = xml_producto.responseText;
            }
          }
          
          xml_pu.onreadystatechange = function() {
            if(xml_pu.readyState == 4 && xml_pu.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
                document.getElementById(pu).innerHTML = xml_pu.responseText;
                document.getElementById(pu2).value = xml_pu.responseText;
            }
          }

          xmlhttp_ex.open("GET","search_ex.php?codigo="+codigo, true);
          xmlhttp_ex.send();
          xml_producto.open("GET","search_prod.php?codigo="+codigo, true);
          xml_producto.send();
          xml_pu.open("GET","search_pu.php?codigo="+codigo, true);
          xml_pu.send();

      }
    
    
    function sum_tot(valor, costo, nombre) {
        //alert("The input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(costo).value;
        var tot = valor * num1;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(nombre).innerHTML = '<font color=\"green\">'+tot+'</font>';

    }
    
    
     function suma(cantidad)
       {
          var tot;

          num   =   document.getElementById("v_abono").value;
          if(num == ""){
              num = 0;
          }
          tot   =   cantidad + num;
          document.getElementById("v_abono").value = tot;

      }
    
    function search_nit(nit)
       {
           var xmlhttp_tel;
           var xmlhttp_cliente;
           var xmlhttp_contacto;
           var xmlhttp_facturar_a;
           var xmlhttp_dir_fiscal;
           var xmlhttp_dir_entrega;
           var xmlhttp_condiciones_pago;
           var xmlhttp_dir_transporte;
           var id_cliente;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_tel                 =   new XMLHttpRequest();
            xmlhttp_fax                 =   new XMLHttpRequest();
            xmlhttp_cliente             =   new XMLHttpRequest();
            xmlhttp_contacto            =   new XMLHttpRequest();
            xmlhttp_facturar_a          =   new XMLHttpRequest();
            xmlhttp_dir_fiscal          =   new XMLHttpRequest();
            xmlhttp_dir_entrega         =   new XMLHttpRequest();
            xmlhttp_condiciones_pago    =   new XMLHttpRequest();
            xmlhttp_dir_transporte      =   new XMLHttpRequest();
            id_cliente                  =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_tel                 =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_fax                 =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_cliente             =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_contacto            =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_facturar_a          =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_dir_fiscal          =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_dir_entrega         =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_condiciones_pago    =   new ActiveXObject("Microsoft.XMLHTTP");
            xmlhttp_dir_transporte      =   new ActiveXObject("Microsoft.XMLHTTP");
            id_cliente                  =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_tel.onreadystatechange = function() {
            if(xmlhttp_tel.readyState == 4 && xmlhttp_tel.status == 200)
            {
              
                document.getElementById("tel").value = xmlhttp_tel.responseText;
            }
          }
          
          xmlhttp_cliente.onreadystatechange = function() {
            if(xmlhttp_cliente.readyState == 4 && xmlhttp_cliente.status == 200)
            {
          
                document.getElementById("cliente").value = xmlhttp_cliente.responseText;
            }
          }
        
          xmlhttp_contacto.onreadystatechange = function() {
            if(xmlhttp_contacto.readyState == 4 && xmlhttp_contacto.status == 200)
            {
          
                document.getElementById("contacto").value = xmlhttp_contacto.responseText;
            }
          }
          
          xmlhttp_facturar_a.onreadystatechange = function() {
            if(xmlhttp_facturar_a.readyState == 4 && xmlhttp_facturar_a.status == 200)
            {
          
                document.getElementById("facturar_a").value = xmlhttp_facturar_a.responseText;
            }
          }
          
          xmlhttp_dir_fiscal.onreadystatechange = function() {
            if(xmlhttp_dir_fiscal.readyState == 4 && xmlhttp_dir_fiscal.status == 200)
            {
          
                document.getElementById("dir_fiscal").value = xmlhttp_dir_fiscal.responseText;
            }
          }
          
          xmlhttp_dir_entrega.onreadystatechange = function() {
            if(xmlhttp_dir_entrega.readyState == 4 && xmlhttp_dir_entrega.status == 200)
            {
          
                document.getElementById("dir_entrega").value = xmlhttp_dir_entrega.responseText;
            }
          }
          
          xmlhttp_condiciones_pago.onreadystatechange = function() {
            if(xmlhttp_condiciones_pago.readyState == 4 && xmlhttp_condiciones_pago.status == 200)
            {
          
                document.getElementById("condiciones_pago").value = xmlhttp_condiciones_pago.responseText;
            }
          }
          
          xmlhttp_dir_transporte.onreadystatechange = function() {
            if(xmlhttp_dir_transporte.readyState == 4 && xmlhttp_dir_transporte.status == 200)
            {
          
                document.getElementById("dir_transporte").value = xmlhttp_dir_transporte.responseText;
            }
          }
          
          id_cliente.onreadystatechange = function() {
            if(id_cliente.readyState == 4 && id_cliente.status == 200)
            {
          
                document.getElementById("id_cliente").value = id_cliente.responseText;
            }
          }
         
          xmlhttp_tel.open("GET","search_nit.php?nit="+nit, true);
          xmlhttp_tel.send();
          xmlhttp_cliente.open("GET","search_nit2.php?nit="+nit, true);
          xmlhttp_cliente.send();   
          xmlhttp_contacto.open("GET","search_nit3.php?nit="+nit, true);
          xmlhttp_contacto.send(); 
          xmlhttp_facturar_a.open("GET","search_nit4.php?nit="+nit, true);
          xmlhttp_facturar_a.send(); 
          xmlhttp_dir_fiscal.open("GET","search_nit5.php?nit="+nit, true);
          xmlhttp_dir_fiscal.send(); 
          xmlhttp_dir_entrega.open("GET","search_nit6.php?nit="+nit, true);
          xmlhttp_dir_entrega.send(); 
          xmlhttp_condiciones_pago.open("GET","search_nit7.php?nit="+nit, true);
          xmlhttp_condiciones_pago.send();
          xmlhttp_dir_transporte.open("GET","search_nit8.php?nit="+nit, true);
          xmlhttp_dir_transporte.send();
          id_cliente.open("GET","search_nit9.php?nit="+nit, true);
          id_cliente.send();
      }
    
    function search_code(code)
       {
           var nombre_fiscal;
           var dir_fiscal;
           var plazo;
           var nit;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            nombre_fiscal       =   new XMLHttpRequest();
            dir_fiscal          =   new XMLHttpRequest();
            plazo               =   new XMLHttpRequest();
            nit                 =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            nombre_fiscal       =   new ActiveXObject("Microsoft.XMLHTTP");
            dir_fiscal          =   new ActiveXObject("Microsoft.XMLHTTP");
            plazo               =   new ActiveXObject("Microsoft.XMLHTTP");
            nit                 =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          nombre_fiscal.onreadystatechange = function() {
            if(nombre_fiscal.readyState == 4 && nombre_fiscal.status == 200)
            {
              
                document.getElementById("nombre_cliente").value = nombre_fiscal.responseText;
            }
          }
          
          dir_fiscal.onreadystatechange = function() {
            if(dir_fiscal.readyState == 4 && dir_fiscal.status == 200)
            {
              
                document.getElementById("dir_fiscal").value = dir_fiscal.responseText;
            }
          }
          
          plazo.onreadystatechange = function() {
            if(plazo.readyState == 4 && plazo.status == 200)
            {
              
                document.getElementById("plazo").value = plazo.responseText;
            }
          }
          
          nit.onreadystatechange = function() {
            if(nit.readyState == 4 && nit.status == 200)
            {
              
                document.getElementById("nit").value = nit.responseText;
            }
          }
          
          nombre_fiscal.open("GET","search_code.php?code="+code, true);
          nombre_fiscal.send();
          dir_fiscal.open("GET","search_code2.php?code="+code, true);
          dir_fiscal.send();
          plazo.open("GET","search_code3.php?code="+code, true);
          plazo.send();
          nit.open("GET","search_code4.php?code="+code, true);
          nit.send();
      }
    
</script>
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
				<?php
                    require 'user.php';
                ?>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: MAIN MENU **************************************************** -->
		      <?php
                require 'side_bar.php';
              ?>
			<!-- end: MAIN MENU ****************************************************** -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Advertencia!</h4>
					<p>Necesitas tener <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> habilitado en tu computadora!.</p>
				</div>
			</noscript>
			
			<!-- start: Content ****************************************************** --->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="one.php">Inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li>
                    <a href="#">Contabilidad</a>
                    <i class="icon-angle-right"></i>
                    <a href="cuentas_cobrar.php">Cuentas x Cobrar</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Abonos</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_abonos.php">Mantenimiento de Abonos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de Abonos</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){ 
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="next"){
                        $codigo_cliente     =   $_POST['codigo'];
                        $fecha              =   $_POST['date01'];
                        //$valor_abono        =   $_POST['v_abono'];
                        $no_recibo          =   $_POST['no_recibo'];
                        $no_deposito        =   $_POST['no_deposito'];
                        $bancotodo          =   $_POST['banco'];
                        $serie              =   $_POST['serie'];
                        $ob                 =   $_POST['ob'];
                        $nombre_cliente     =   $_POST['nombre_cliente'];
                    
                        $bancotodo_length  = strlen($bancotodo);
                        $esta              = strpos("$bancotodo", "-");

                        $banco          = substr($bancotodo,0,$esta);
                        $pos            = $esta + 1;
                        $cuenta         = substr($bancotodo,$pos,$bancotodo_length);
                    
                        //$u          =   "Usuario Registrado";
                        $d          =   "Ingreso un abono del cliente: ";
                        $t          =   "cxc_cabecera";
                        
                        $query2     =   mysql_query("INSERT INTO `cxc_cabecera` (`id_cxc`, `id_cliente`, `fecha`, `valor_abono`, `no_recibo`, `no_deposito`, `banco`, `cuenta`, `serie`, `observaciones`,`tipo_docto`) VALUES (NULL, '$codigo_cliente', '$fecha', '', '$no_recibo', '$no_deposito', '$banco', '$cuenta', '$serie', '$ob','Recibo')");
                        $query9     =   mysql_query("SELECT `id_cxc` FROM `cxc_cabecera` ORDER BY id_cxc DESC LIMIT 1");
                        $r9         =   mysql_fetch_array($query9);
                        $id_cxc     =   $r9['id_cxc'];
                    
                        insert_logs($da, $u, $d, $t, $nombre_cliente);
                        //echo "<h3>Orden de compra ingresada con éxito!</h3>";
                        $flag1  =   "next";
                }
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
                //INICIA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                        $conta        =   $_POST['contador'];
                        $id_cxc       =   $_POST['id_cxc'];
                        $banco        =   $_POST['banco_v'];
                        $cuenta       =   $_POST['cuenta_v'];
                        //$recibo       =   $_POST['recibo'];
                        $deposito     =   $_POST['deposito'];
                        $cliente      =   $_POST['cliente'];
                        $ob           =   $_POST['ob'];
                    
                        $count = 0;
                        while($count < $conta){ 
                            $count      =   $count + 1;
                            $name_sel   =   "sel" . $count;
                            $sel        =   $_POST["$name_sel"];
                       
                                 
                        $name_fac         =   "fac" . $count;
                        $name_fac_v       =   $_POST["$name_fac"];
                                  
                        $name_serie         =   "serie" . $count;
                        $name_serie_v       =   $_POST["$name_serie"];
                        
                        $name_valor       =   "valor" . $count;
                        $name_valor_v     =   $_POST["$name_valor"];
                            
                        $name_valor_ingreso   =   "v" . $count;
                        $name_valor_ingreso_v = $_POST["$name_valor_ingreso"];   
                        
                        
                            
                            if($sel != ""){
                            $query3     =   mysql_query("INSERT INTO `cxc_detalle` (`id_cxc_detalle`, `id_cxc`, `no_docto`, `serie`, `v_abono`) VALUES (NULL, '$id_cxc', '$name_fac_v', '$name_serie_v', '$name_valor_ingreso_v')");
                            $query12  =   mysql_query("SELECT `no_docto`,`serie`,`v_abono` FROM `cxc_detalle` WHERE no_docto = '$name_fac_v' AND serie = '$name_serie_v'");
                                $monto_b = $monto_b + $name_valor_ingreso_v; // Monto a ingresar en el area de ingreso a bancos.
                                $todas_facturas = $todas_facturas . " " . $name_fac_v;
                                      $tot  =   0;
                                      while($r12=mysql_fetch_array($query12)){
                                          $tot = $tot + $r12['v_abono'];
                                      }
                                      $saldo = $name_valor_v - $tot;
                                if($saldo <= 0){
                                     $query11    =   mysql_query("UPDATE `factu_principal` SET `estatus` = '3' WHERE CONCAT(`factu_principal`.`no_factura`) = '$name_fac_v'");
                                }else{
                                     $query11    =   mysql_query("UPDATE `factu_principal` SET `estatus` = '2' WHERE CONCAT(`factu_principal`.`no_factura`) = '$name_fac_v'");
                                }
                            }
                        
                        }
                    
                    
                    $estado_b       = mysql_query("SELECT * FROM `estados_cuenta` WHERE banco = '$banco' AND cuenta = '$cuenta' ORDER BY fecha, id DESC LIMIT 1");
                        $result_estado  = mysql_fetch_array($estado_b);
                        $estado         = $result_estado['saldo'];
                        $s              = $estado + $monto_b;
                        
                        $razon          = "Ingreso de abono a la factura: $todas_facturas";
                    
                     $query15      = mysql_query("INSERT INTO `ingreso_bancos` (`id`, `fecha`, `banco`, `cuenta`, `cliente_afectado`, `no_deposito`, `monto`, `razon`, `observaciones`) VALUES (NULL, '$da', '$banco', '$cuenta', '$cliente', '$deposito', '$monto_b', 'Deposito', '$ob');");
                    $query2     = mysql_query("INSERT INTO `estados_cuenta` (`id`, `fecha`, `no_docto`, `concepto`, `credito`, `debito`, `saldo`, `banco`, `cuenta`) VALUES ('NULL', '$da', '$deposito', '$razon', '$monto_b', '', '$s', '$banco','$cuenta')");
                    
                        $flag1  =   "guardar";
                }
                //FINALIZA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                
                //INICIA LA CABECERA DE EL PEDIDO--------------------
                ?>
                <h1>Ingreso de abonos</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                              <table border="0" style="width:100%">
                                <tr>
                                    <td>
                                        <label class="control-label" for="codigo">CODIGO CLIENTE: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="codigo" name="codigo" onkeyup="search_code(this.value);">
							            </div>
                                        <!--<label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>-->
                                        <div class="controls">
								            <input type="text" class="input-xlarge typeahead" id="nombre_cliente" name="nombre_cliente" placeholder="El nombre del cliente saldra automático!">
							            </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">FECHA:</label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <label class="control-label" for="no_recibo">No. Recibo: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="no_recibo" name="no_recibo">
							            </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="no_deposito">No. Deposito: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="no_deposito" name="no_deposito" >
							            </div>
                            <div class="control-group">
								<label class="control-label" for="banco">Nombre del banco y cuenta: </label>
								<div class="controls">
								  <select id="banco" name="banco" data-rel="chosen">
                                      <option value=""></option>
                                    <?php
                                      $query=mysql_query("SELECT * FROM `bancos`");
                                      
                                      while($result_bancos=mysql_fetch_array($query)){
                                        $r=$result_bancos['nombre'];
                                        $r2=$result_bancos['cuenta'];  
                                    ?>
                                      <option value="<?php echo "$r";?>-<?php echo "$r2";?>"><?php echo "$r";?> - <?php echo "$r2";?></option>
                                    <?php
                                      }
                                    ?>
									
								  </select>
								</div>
							  </div>
                                    </td>
                                    <td>
                                         <label class="control-label" for="serie">SERIE: </label>
                                         <div class="controls">
								            <select class="input-small" id="serie" name="serie" data-rel="chosen">
									           <option value="A">A</option>
                                               <option value="B">B</option>
                                               <option value="C">C</option>
								            </select>
								        </div>
                                    </td>
                                </tr>
                              </table>
                            <label class="control-label" for="ob">Observaciones: </label>
                                        <div class="controls">
								            <input type="text" class="input-xxlarge typeahead" id="ob" name="ob" >
							            </div>
                        
							<div class="form-actions">
                            <?php
                                if($flag1=="no"){
                            ?>
							  <button type="submit" class="btn btn-primary">Buscar</button>
                              <input type="hidden" id="flag1" name="flag1" value="yes">
                            <?php
                                }else{
                            ?>
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
                                
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>   
                                <?php
                                //-----------FINALIZA LA CABECERA DE EL PEDIDO----------------
                                    }else if($flag1=="next"){
                                //-----------INICIA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                                       
                                ?>
                        <form class="form-horizontal" method="post" >
						  <fieldset>
                            <table border="0" style="width:100%">
                                <tr>
                                    <td>
                                        <label class="control-label" for="codigo">CODIGO CLIENTE: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="codigo" name="codigo" value="<?php echo "$codigo_cliente";?>">
							            </div>
                                        <!--<label class="control-label" for="nombre_cliente">NOMBRE CLIENTE: </label>-->
                                        <div class="controls">
								            <input type="text" class="input-xlarge typeahead" id="nombre_cliente" name="nombre_cliente" value="<?php echo "$nombre_cliente";?>">
							            </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">FECHA:</label>
                                          <div class="controls">
                                            <input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $fecha; ?>">
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <label class="control-label" for="no_recibo">No. Recibo: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="no_recibo" name="no_recibo" value="<?php echo "$no_recibo";?>">
							            </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="no_deposito">No. Deposito: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="no_deposito" name="no_deposito" value="<?php echo "$no_deposito";?>">
							            </div>
                            <div class="control-group">
								<label class="control-label" for="banco">Nombre del banco y cuenta: </label>
								<div class="controls">
								  <select disabled id="banco" name="banco" data-rel="chosen">
                                      <option value=""><?php echo "$banco - $cuenta";?></option>
									
								  </select>
								</div>
							  </div>
                                    </td>
                                    <td>
                                         <label class="control-label" for="serie">SERIE: </label>
                                         <div class="controls">
								            <select disabled class="input-small" id="serie" name="serie" data-rel="chosen">
									           <option value="A"><?php echo "$serie";?></option>
								            </select>
								        </div>
                                    </td>
                                </tr>
                              </table>
                            <label class="control-label" for="ob">Observaciones: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-xxlarge typeahead" id="ob" name="ob" value="<?php echo "$ob";?>">
							            </div>
                        
                    
                     <div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <!--
                                  <th>CODIGO</th>
                                  <th>DESCRIPCION</th>
                                  <th>REFERENCIA</th>
								  <th>CANTIDAD</th>
                                  <th>COSTO</th>
                                  <th>TOTAL</th>
                                  -->
                                  
                                  <th>SELECCION</th>
                                  <th>FECHA</th>
                                  <th>DOCTO NO</th>
                                  <th>SERIE</th>
								  <th>VALOR</th>
                                  <th>SALDO</th>
                                  <th>VALOR ABONO</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            
                              $query_todo   =   mysql_query("SELECT `fecha`,`no_factura`,`serie`,`id_cliente`,`total`,`estatus` FROM `factu_principal` WHERE id_cliente = '$codigo_cliente' AND estatus != '1' AND estatus != '3'");
                              $count=0;
                            // comienza loop para la creacion de la tabla de ingreso de los distintos productos a solicitar en el pedido!
                              while($search=mysql_fetch_array($query_todo)){ 
                                 
                                  $count            =   $count + 1;
                                  $estatus          =   $search['estatus'];
                                  
                                  $name_sel         =   "sel" . $count;
                                  $id_selec         =   $search['no_factura'];
                                  
                                  $name_f           =   "f" . $count;
                                  $name_f_v         =   $search['fecha'];
                                 
                                  $name_fac         =   "fac" . $count;
                                  $name_fac_v       =   $search['no_factura'];
                                  
                                  $name_serie         =   "serie" . $count;
                                  $name_serie_v       =   $search['serie'];
                                  
                                  $name_valor       =   "valor" . $count;
                                  $name_valor_v     =   $search['total'];
                                  
                                  if($estatus == 0){
                                    $saldo  =   $name_valor_v;
                                  }else{
                                      $query10  =   mysql_query("SELECT `no_docto`,`serie`,`v_abono` FROM `cxc_detalle` WHERE no_docto = '$name_fac_v' AND serie = '$name_serie_v'");
                                      $tot  =   0;
                                      while($r10=mysql_fetch_array($query10)){
                                          $tot = $tot + $r10['v_abono'];
                                      }
                                      $saldo = $name_valor_v - $tot;
                                  }
                                  
                                  $name_valor_ingreso   =   "v" . $count;
                          ?>
							<tr>
                                <td>
                                    <input type="checkbox" class="input-small typeahead" name="<?php echo "$name_sel";?>" id="<?php echo "$name_sel";?>" value="<?php echo "$id_selec";?>">
                                </td>
								<td class="center">
                                    <span id="<?php echo "$name_f";?>" name="<?php echo "$name_f";?>"><?php echo "$name_f_v";?></span>
                                </td>
								<td class="center">
                                    <span id="factu" name="factu"><?php echo "$name_fac_v";?></span>
                                    <input type="hidden" id="<?php echo "$name_fac";?>" name="<?php echo "$name_fac";?>" value="<?php echo "$name_fac_v";?>">
                                </td>
                                <td class="center">
                                    <span id="serie" name="serie"><?php echo "$name_serie_v";?></span>
                                    <input type="hidden" id="<?php echo "$name_serie";?>" name="<?php echo "$name_serie";?>" value="<?php echo "$name_serie_v";?>">
                                </td>
                                <td class="center">
                                   <span id="val" name="val"><?php echo "$name_valor_v";?></span>
                                   <input type="hidden" id="<?php echo "$name_valor";?>" name="<?php echo "$name_valor";?>" value="<?php echo "$name_valor_v";?>">
                                </td>
                                <td class="center">
                                   <span id="saldo" name="saldo"><?php echo "$saldo";?></span>
                                </td>
                                <td class="center">
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_valor_ingreso"?>" name="<?php echo "$name_valor_ingreso"?>" value="" >
                                    
                                </td>
							</tr>
                          <?php
                              }
                          ?>
						  </tbody>
					  </table>            
					</div>
							<div class="form-actions">
                            <?php
                                if($flag1=="next"){
                            ?>
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag1" name="flag1" value="guardar">
                              <input type="hidden" id="contador" name="contador" value="<?php echo"$count";?>">
                              <input type="hidden" id="id_cxc" name="id_cxc" value="<?php echo"$id_cxc";?>">
                              <input type="hidden" id="banco_v" name="banco_v" value="<?php echo"$banco";?>">
                              <input type="hidden" id="cuenta_v" name="cuenta_v" value="<?php echo"$cuenta";?>">  
                              <input type="hidden" id="deposito" name="deposito" value="<?php echo"$no_deposito";?>"> 
                              <input type="hidden" id="cliente" name="cliente" value="<?php echo"$codigo_cliente";?>">
                              <input type="hidden" id="ob" name="ob" value="<?php echo"$ob";?>">
                            <?php
                                }else{
                            ?>
                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                <input type="hidden" id="flag1" name="flag1" value="next">
                            <?php
                                }
                            ?>
							</div>
						  </fieldset>
						</form>  
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Abono ingresado con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php 
                }else{
                    echo "Usuario no autorizado!";
                }
                ?>
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
    </div>
		
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
	
<?php require 'footer.php' ?>
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

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