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
	<title>SAF</title>
	<meta name="description" content="SAF">
	<meta name="author" content="Mariles Rustrian">
	
	<!-- end: Meta -->
	
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
     <script src="http://code.jquery.com/jquery-1.0.4.js"></script>

	
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

		
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
    
    
    
    
     function suma(cantidad,total,codigo,total2)
       {
          var xmlhttp_total;
          var precio;
          var tot;

          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_total  =   new XMLHttpRequest();
          }
          else
          {// code for IE6, IE5
            xmlhttp_total  =   new ActiveXObject("Microsoft.XMLHTTP");
          }	

          xmlhttp_total.onreadystatechange = function() {
            if(xmlhttp_total.readyState == 4 && xmlhttp_total.status == 200)
            {
              //document.getElementById("des").value = xmlhttp.responseText;
              //document.getElementById(total).innerHTML = xmlhttp_total.responseText;
                codigo = document.getElementById(codigo).value;
                document.getElementById(total).innerHTML = xmlhttp_total.responseText;
                document.getElementById(total2).value = xmlhttp_total.responseText;
                
                sum_tot2();
            }
          }
          
          cod = document.getElementById(codigo).value;
            sum = document.getElementById(total2).value;
            sum2 = ++ sum
            tot = 0;

          xmlhttp_total.open("GET","search_pu2.php?codigo="+cod+"&can="+cantidad, true);
          xmlhttp_total.send();
           
        

      }
    
    /*----  Suma Total   --------
    function sum_tot(valor, precio, nombre, iva, value_total) {
        //alert("
        
        //input value has changed. The new value is: " + val);
        //var y = ++ val;
        var num1 = document.getElementById(precio).value;
        var tot = valor * num1;

        //  document.getElementById("tot_bi").value = tot;
        document.getElementById(nombre).innerHTML = '<font color=\"green\">'+tot+'</font>';
       // document.getElementById(total).innerHTML = '<font color=\"green\">'+tot+'</font>';
        document.getElementById(value_total).value = tot;
        sum_tot2();
        
    }*/
    
    function sum_tot2() {
        
       // alert("The input value has changed. The new value is: " +cod+ "" );
        //var y = ++ val;
        
        var tot1    =   Number(document.getElementById('tot21').value);
        var tot2    =   Number(document.getElementById('tot22').value);
        var tot3    =   Number(document.getElementById('tot23').value);
        var tot4    =   Number(document.getElementById('tot24').value);
        var tot5    =   Number(document.getElementById('tot25').value);
        var tot6    =   Number(document.getElementById('tot26').value);
        var tot7    =   Number(document.getElementById('tot27').value);
        var tot8    =   Number(document.getElementById('tot28').value);
        var tot9    =   Number(document.getElementById('tot29').value);
        var tot10   =   Number(document.getElementById('tot210').value);
        var tot11   =   Number(document.getElementById('tot211').value);
        var tot12   =   Number(document.getElementById('tot212').value);
        var tot13   =   Number(document.getElementById('tot213').value);
        var tot14   =   Number(document.getElementById('tot214').value);
        var tot15   =   Number(document.getElementById('tot215').value);
        var tot16   =   Number(document.getElementById('tot216').value);
        var tot17   =   Number(document.getElementById('tot217').value);
        var tot18   =   Number(document.getElementById('tot218').value);
        var tot19   =   Number(document.getElementById('tot219').value);
        var tot20   =   Number(document.getElementById('tot220').value);
        
        var gran_total  = tot1 + tot2 + tot3 + tot4 + tot5 + tot6 + tot7 + tot8 + tot9 +tot10 + tot11 + tot12 + tot13 + tot14 + tot15 + tot16 + tot17 + tot18 + tot19 + tot20;
        
        //alert("The input value has changed. The new value is: " +gran_total;

        
        document.getElementById('span_grantotal').innerHTML = '<font color=\"green\">'+tot1+'</font>';
        document.getElementById('gran_tota').value = tot1;
        
    }
    
 
    
    /*--- Fin Suma Total ----*/
    /*
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
      }*/
    
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
				<a class="brand" href="index.php"><span>ST System</span></a>
								
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
                    <a href="#">Ventas</a>
                    <i class="icon-angle-right"></i>
                    <a href="manto_pedidos.php">Mantenimiento de pedidos</a>
                    <i class="icon-angle-right"></i>
                    <a href="#">Ingreso de pre-cotización</a>
                </li>
			</ul>
                <?php
                if($security == 'go'){
                //INICIA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="next"){
                        $id_pedido      =   $_POST['pedido'];
                        $fecha_pedido   =   $_POST['date01'];
                        $fecha_despacho =   $_POST['f_despacho'];
                        $id_cliente     =   $_POST['id_cliente'];
                        $id_vendedor    =   $_POST['vendedor'];
                        $trans_dep      =   $_POST['trans_departamental'];
                    
                        //$u          =   "Usuario Registrado";
                        $d          =   "Ingreso el pedido: ";
                        $t          =   "pedidos_cabecera";
                        
                        $query2     =   mysql_query("INSERT INTO `pedidos_cabecera` (`id_pedido`, `fecha_pedido`, `fecha_despacho`, `id_cliente`, `id_vendedor`, `transporte_departamental`) VALUES (NULL, '$fecha_pedido', '$fecha_despacho', '$id_cliente', '$id_vendedor','$trans_dep')");
                        
                        insert_logs($da, $u, $d, $t, $id_pedido);
                        //echo "<h3>Orden de compra ingresada con éxito!</h3>";
                        $flag1  =   "next";
                }
                //FINALIZA IF PARA GUARDAR CABECERA DE EL PEDIDO----------------
                
                //INICIA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                if(empty($_POST)===false && $_POST['flag1']=="guardar"){
                        $id_pedido    =   $_POST['pedido'];
                        
                        $count = 0;
                        while($count < 20){ 
                                 
                                  $count        =   $count + 1;
                            
                                  $name_cod     =   "cod" . $count;
                                  $name_cantidad=   "can" . $count;
                                  $name_ex      =   "ex2" . $count;
                                  $name_des     =   "des2" . $count;
                                  $name_pu      =   "pu2" . $count;
                                  $name_total   =   "tot2" . $count;
                            
                                  $cod          =   $_POST["$name_cod"];
                                  $cantidad     =   $_POST["$name_cantidad"];
                                  $ex           =   $_POST["$name_ex"];
                                  $des          =   $_POST["$name_des"];
                                  $pu           =   $_POST["$name_pu"];
                                  $total        =   $_POST["$name_total"];
                                  
                        
                        //$query4     =   mysql_query("SELECT `codigo`,`descripcion` FROM `inventario_central` WHERE codigo = '$cod'");
                        //$r4         =   mysql_fetch_array($query4);
                        //$des        =   $r4['descripcion'];
                        if($cod!=""){
                        $query2     =   mysql_query("INSERT INTO `pedidos_secundaria` (`id_control`, `id_pedido`, `codigo`, `cantidad`, `producto`, `precio_u`, `total`) VALUES (NULL, '$id_pedido', '$cod', '$cantidad', '$des', '$pu', '$total')");
                        }
                           // echo "$cod, $des, $ref, $can, $cos, $tot <br>";
                        }
                    
                        $flag1  =   "guardar";
                }
                //FINALIZA IF PARA GUARDAR EL CUERPO DE EL PEDIDO----------------
                
                //INICIA LA CABECERA DE EL PEDIDO--------------------
                ?>
                <h1>Ingreso de Pre-cotización</h1>
                    <div class="box-content">
                        <?php
                            if($flag1=="one"){
                        ?>
						<form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $da; ?>">
							  </div>
                             <label class=" control-label" for="pedido">NO. Pre-cotiación: </label>
                                  <div class="controls">
                                      <?php
                                        $query1     =   mysql_query("SELECT `id_pedido` FROM `pedidos_cabecera` ORDER BY `id_pedido` DESC LIMIT 1");
                                        $result1    =   mysql_fetch_array($query1);
                                        $codigo     =   $result1['id_pedido'] + 1;
                                      ?>
								<input type="text" class="input-medium typeahead" id="pedido" name="pedido" value="<?php echo "$codigo";?>">
							  </div><br>    
							</div>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                <tr>
                                    
                                    <td>
                                        <label class="control-label" for="tel">TELEFONO: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="tel" name="tel">
                                        </div>
                                    </td>
                                </tr>
                              
							    <tr>
                                    <td>
                                        <label class="control-label" for="cliente">CLIENTE: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="cliente" name="cliente">
                                            <input type="hidden" id="id_cliente" name="id_cliente">
							            </div>
                                    </td>
                                   
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <select id="vendedor" name="vendedor" data-rel="chosen">
									           <option value=""></option>
                                               <?php
                                                    $query2   =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM `vendedores` ORDER BY `id_vendedor` DESC");
                                      
                                                    while($result2=mysql_fetch_array($query2)){
                                                        $name       =   $result2['nombre_vendedor'];
                                                        $last_name  =   $result2['apellido_vendedor'];
                                                        $id         =   $result2['id_vendedor'];
                                                ?>
                                                        <option value="<?php echo "$id";?>"><?php echo "$name $last_name";?></option>
                                                <?php
                                                    }
                                                ?>
								            </select>
								        </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="dir_entrega">DIRECCION DE ENTREGA: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="dir_entrega" name="dir_entrega">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="condiciones_pago">CONDICIONES DE PAGO: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="condiciones_pago" name="condiciones_pago">
							            </div>
                                    </td>
                                    <td><!--
                                        <label class="control-label" for="otros">OTROS: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="otros" name="otros">
                                        </div>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <label class="control-label" for="f_despacho">FECHA DESPACHO:</label>
							  <div class="controls">
								<input type="text" class="input-medium datepicker" id="f_despacho" name="f_despacho" value="<?php echo $da; ?>">
							  </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="dir_transporte">DIRECCION TRANSPORTE: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="dir_transporte" name="dir_transporte">
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <label class="control-label" for="trans_departamental">TRANPORTE DEPARTAMENTAL: </label>
                                        <div class="controls">
								            <input type="text" class="input-xlarge typeahead" id="trans_departamental" name="trans_departamental">
							            </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
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
                                        $f          =   $_POST['date01'];
                                        $no_pedido  =   $_POST['pedido'];
                                        $nit        =   $_POST['nit'];
                                        $tel        =   $_POST['tel'];
                                        $fax        =   $_POST['fax'];
                                        $cliente    =   $_POST['cliente'];
                                        $contacto   =   $_POST['contacto'];
                                        $facturar_a =   $_POST['facturar_a'];
                                        $direccion_f=   $_POST['dir_fiscal'];
                                        $vendedor   =   $_POST['vendedor'];
                                        $direccion_e=   $_POST['dir_entrega'];
                                        $condiciones=   $_POST['condiciones_pago'];
                                        $fecha_despacho=$_POST['f_despacho'];
                                        $direccion_t=   $_POST['dir_transporte'];
                                        $trans_dep  =   $_POST['trans_departamental'];
                                
                                        $query2   =   mysql_query("SELECT `id_vendedor`,`nombre_vendedor`,`apellido_vendedor` FROM `vendedores` WHERE id_vendedor = '$vendedor'");
                                        $r2       =   mysql_fetch_array($query2);
                                        $vendedor =   $r2['nombre_vendedor'] . " " . $r2['apellido_vendedor'];
                                ?>
                        <form class="form-horizontal" method="post" >
						  <fieldset>
                            <div class="control-group">
							  <label class="control-label" for="date01">FECHA:</label>
							  <div class="controls">
								<input disabled type="text" class="input-xlarge datepicker" id="date01" name="date01" value="<?php echo $f; ?>">
							  </div>
                             <label class=" control-label" for="pedido">NO. PEDIDO: </label>
                                  <div class="controls">
                                    
								<input disabled type="text" class="input-medium typeahead" id="pedido2" name="pedido2" value="<?php echo "$no_pedido";?>">
                                      <input type="hidden"  id="pedido" name="pedido" value="<?php echo "$no_pedido";?>">
							  </div><br>    
							</div>
							<div class="control-group">
                            <table border="0" style="width:100%">
                                <tr>
                                    <td>
                                        <label class="control-label" for="nit">NIT: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="nit" name="nit" value="<?php echo "$nit";?>">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="tel">TELEFONO: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="tel" name="tel" value="<?php echo "$tel";?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="fax">FAX: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="fax" name="fax" value="<?php echo "$fax";?>">
							            </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
							    <tr>
                                    <td>
                                        <label class="control-label" for="cliente">CLIENTE: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="cliente" name="cliente" value="<?php echo "$cliente";?>">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="contacto">CONTACTO: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="contacto" name="contacto" value="<?php echo "$contacto";?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="facturar_a">FACTURAR A: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="facturar_a" name="facturar_a" value="<?php echo "$facturar_a";?>">
							            </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="dir_fiscal">DIRECCION FISCAL: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="dir_fiscal" name="dir_fiscal" value="<?php echo "$direccion_f";?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="vendedor">VENDEDOR: </label>
                                        <div class="controls">
								            <select disabled id="vendedor" name="vendedor" data-rel="chosen">
									           <option value=""><?php echo "$vendedor";?></option>
                                               
								            </select>
								        </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="dir_entrega">DIRECCION DE ENTREGA: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="dir_entrega" name="dir_entrega" value="<?php echo $direccion_e; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-label" for="condiciones_pago">CONDICIONES DE PAGO: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="condiciones_pago" name="condiciones_pago" value="<?php echo $condiciones; ?>">
							            </div>
                                    </td>
                                    <td><!--
                                        <label class="control-label" for="otros">OTROS: </label>
                                        <div class="controls">
								            <input type="text" class="input-medium typeahead" id="otros" name="otros">
                                        </div>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <label class="control-label" for="f_despacho">FECHA DESPACHO:</label>
							  <div class="controls">
								<input disabled type="text" class="input-medium datepicker" id="f_despacho" name="f_despacho" value="<?php echo $fecha_despacho; ?>">
							  </div>
                                    </td>
                                    <td>
                                        <label class="control-label" for="dir_transporte">DIRECCION TRANSPORTE: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-medium typeahead" id="dir_transporte" name="dir_transporte" value="<?php echo $direccion_t; ?>">
                                        </div>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <label class="control-label" for="trans_departamental">TRANPORTE DEPARTAMENTAL: </label>
                                        <div class="controls">
								            <input disabled type="text" class="input-xlarge typeahead" id="trans_departamental" name="trans_departamental" value="<?php echo $trans_dep; ?>">
							            </div>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
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
                                  
                                  <th>CODIGO</th>
                                  <th>CANTIDAD</th>
                                  <th>EXISTENCIA</th>
								  <th>PRODUCTO</th>
                                  <th>PRECIO UNITARIO</th>
                                  <th>TOTAL</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                            
                              $count=0;
                            // comienza loop para la creacion de la tabla de ingreso de los distintos productos a solicitar en el pedido!
                              while($count < 20){ 
                                 
                                  $count        =   $count + 1;
                                  
                                  $name_cod     =   "cod" . $count;
                                  $name_cantidad=   "can" . $count;
                                  $name_ex      =   "ex" . $count;
                                  $name_des     =   "des" . $count;
                                  $name_pu      =   "pu" . $count;
                                  $name_total   =   "tot" . $count;
                                  
                                  $name_ex2      =   "ex2" . $count;
                                  $name_des2     =   "des2" . $count;
                                  $name_pu2      =   "pu2" . $count;
                                  $name_total2   =   "tot2" . $count;
                                 
                                  
                          ?>
							<tr>
								<td class="center">
                                    <input  type="text" class="input-small typeahead" id="<?php echo "$name_cod";?>" name="<?php echo "$name_cod";?>" onkeyup="search(this.value,'<?php echo "$name_ex";?>','<?php echo "$name_des";?>','<?php echo "$name_pu";?>','<?php echo "$name_des2";?>','<?php echo "$name_pu2";?>');">
                                </td>
								<td class="center">
                                    <input type="text" class="input-small typeahead" id="<?php echo "$name_cantidad"?>" name="<?php echo "$name_cantidad"?>" value="" onkeyup="suma(this.value,'<?php echo "$name_total";?>','<?php echo "$name_cod";?>','<?php echo "$name_total2";?>');">
                                </td>
                                <td class="center">
                                    <span id="<?php echo "$name_ex";?>" name="<?php echo "$name_ex";?>"></span>
                                    <input type="hidden" id="<?php echo "$name_ex2"?>" name="<?php echo "$name_ex2"?>">
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_des";?>" name="<?php echo "$name_des";?>"></span>
                                   <input type="hidden" id="<?php echo "$name_des2"?>" name="<?php echo "$name_des2"?>">
                                </td>
                                <td class="center">
                                   <span id="<?php echo "$name_pu";?>" name="<?php echo "$name_pu";?>"></span>
                                   <input type="hidden" id="<?php echo "$name_pu2"?>" name="<?php echo "$name_pu2"?>">
                                </td>
                                <td class="center">
                                    <span id="<?php echo "$name_total";?>" name="<?php echo "$name_total";?>"></span>
                                    <input type="text" id="<?php echo "$name_total2"?>" name="<?php echo "$name_total2"?>"  />
                                </td>
							</tr>
                          <?php
                              }
                          ?>
                              
						  </tbody>
                            
					  </table>
                         <table >
						  <thead>
                              <tr>
                                  <td style="height:150px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                                <td>
                                   <h1><b>TOTAL: </b></h1>
                                </td>
                                  <td>
                                      
                                      <input type="text" id="gran_tota" name="gran_tota" value="" / >
                                    <span id='span_grantotal' name='span_grantotal'></span>
                                  </td>
                                </tr>
                             </thead>
                             <tbody></tbody>
                         </table>
					</div>
							<div class="form-actions">
                            <?php
                                if($flag1=="next"){
                            ?>
							  <button type="submit" class="btn btn-primary">Guardar</button>
                              <input type="hidden" id="flag1" name="flag1" value="guardar">
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
                        <input type="text" id="texto" value="some text"/>
  <p></p>
                        

<script>
var variab =document.getElementById('#tot21').value;
document.writeln('<input type="text" name="numero" id="txt_numero" value="' +
    variab + '" ><br>');

$('#tot21').keyup(function () {
      var value = $(this).val();
      $("#span_grantotal").text(value);
    }).onkeyup();
</script>
                                <?php
                                //-----------FINALIZA IF DE VISUALIZACION LUEGO QUE FUE PRECIONADO EL BOTON SIGUIENTE!-----------
                            } else if($flag1=="guardar"){
                                echo "<h3>Pedido ingresado con éxito!</h3>";
                            }
                        ?>
					</div>
			<!-- TERMINA: CONTENIDO ************************************************************** -->
                <?php }else{echo "Usuario no autorizado!";} ?>
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
	
	<?php require 'footer.php';?>
	
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
