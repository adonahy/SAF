<?php
$query100   =   mysql_query("SELECT * FROM `permissions` WHERE user = '$u'");
$r100       =   mysql_fetch_array($query100);
$c          =   $r100['alumnos'];
$c1         =   $r100['inscripciones'];
$c2         =   $r100['pagos'];
$c3         =   $r100['tareas'];
$c4         =   $r100['lista_alumnos'];
/*$c5         =   $r100['facturacion'];
$c6         =   $r100['gadicionales'];
$c7         =   $r100['conta_reportes'];
$c8         =   $r100['conta_reportes_comi'];*/
$ct         =   0;
$v          =   $r100['gastos'];
$v1         =   $r100['gastos_adicionales'];
$v2         =   $r100['gastos_academia'];
$v3         =   $r100['ventas_pedido'];
/*$v4         =   $r100['ventas_pfinal'];
$v5         =   $r100['ventas_reportes'];*/
$vt         =   0;
$compras    =   $r100['compras'];
$compras1   =   $r100['proveedores'];
$comprast   =   0;
$admin      =   $r100['administracion'];
$admin1     =   $r100['admin_c_u'];
$admin2     =   $r100['admin_e_u'];
$admin3     =   $r100['admin_ar'];
$admin4     =   $r100['admin_bancos'];
$admin5     =   $r100['admin_reportes'];
$admint     =   0;


if($security == 'go'){ 
    
echo '
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
        ';
    if ($c > 0){ 
        $ct=$c1+$c3 ;
        echo '
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Productos</span></a>
                <ul>
                ';
            if($c1 > 0){
                echo '
                    <li><a class="submenu" href="inscrip.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Inventario</span></a></li>';
            }
            
            if($c3 > 0){    
        echo'
                    <li><a class="submenu" href="manto_cxc.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Proveedores</span></a></li>';
            }
            
        echo'
                </ul>	
            </li>
            ';
    }
	
	
    if ($v > 0){ 
        $vt=$v1+$v2+$v3;
    echo '
            <li>
				<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Ventas</span></a>
				<ul>';
        if($v1 > 0){
            echo'
				    <li><a class="submenu" href="manto_gastos_adici.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Pre-Orden de compras</span></a></li>';
        }
        if($v2 > 0){
            echo'
				    <li><a class="submenu" href="manto_gastos_acad.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Orden de compras</span></a></li>';
        }
       
        if($v3 > 0){
            echo'
                
                    <li><a class="submenu" href="manto_pedidos.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Facturación</span></a></li>
                    ';
		}
        if($v4 > 0){
            echo'
                    <li><a class="submenu" href="manto_pedidos_finales.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Clientes</span></a></li>
                    ';
        }
        
        /*if($v5 > 0){
            echo'
                    <li><a class="submenu" href="reportes_ventas.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Reportes</span></a></li>
                    ';
        }*/
    
        echo'
				</ul>	
            </li>
            ';
    }
	
	
  /* if ($compras > 0){ 
        $comprast=$compras1;
    echo'
            <li>
				<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Pagos</span><span class="label label-important"> '.$comprast.' </span></a>
				<ul>';
        if($compras1 > 0){
            echo'
                    <li><a class="submenu" href="manto_proveedores.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Proveedores</span></a></li>';
        }
       if($compras2 > 0){
            echo'
                    <li><a class="submenu" href="manto_proveedores.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Servicios</span></a></li>';
        }
       if($compras3 > 0){
            echo'
                    <li><a class="submenu" href="manto_proveedores.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Cuentas</span></a></li>';
        }
       if($compras4 > 0){
            echo'
                    <li><a class="submenu" href="manto_proveedores.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Planillas</span></a></li>';
        }
       
        echo'
				</ul>	
            </li>';
    }
 
*/
    
if ($admin > 0){ 
        $admint=$admin1+$admin2+$admin3+$admin4+$admin5;
    echo '
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Administración</span></a>
				<ul>';
    if($admin1 > 0){
            echo'
				    <li><a class="submenu" href="creacion_usuarios.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Creación de usuarios</span></a></li>';
    }
    if($admin2 > 0){
            echo'
				    <li><a class="submenu" href="eliminar_usuarios.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Eliminación de usuarios</span></a></li>';
    }
    if($admin3 > 0){
            echo'
                    <!--<li><a class="submenu" href="manto_roles.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Asignación de roles</span></a></li>-->
                    <li><a class="submenu" href="manto_roles.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Asignación de roles</span></a></li>
                    ';
    }
    /*if($admin4 > 0){
            echo'
                    <!--<li><a class="submenu" href="logs.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Bancos</span></a></li>-->
                    <li><a class="submenu" href="manto_bancos.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Bancos</span></a></li>
                    ';
    }
    if($admin5 > 0){
            echo'
                    <li><a class="submenu" href="reporte_conta.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Reportes</span></a></li>';
    }*/
    echo'
				</ul>	
            </li>';
}
    echo'
            <li>
                <a href="index.php">
                    <i class="icon-lock"></i>
                        <span class="hidden-tablet"> Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</div>
';
}else{
    echo "Usuario no autorizado!";
}
?>