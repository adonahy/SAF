<?php
if($security == 'go'){ 
    echo '
        <div class="nav-no-collapse header-nav">
            <ul class="nav pull-right">       
				<!-- start: User Dropdown -->
				    <li class="dropdown">
				        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				            <i class="halflings-icon white user"></i> '. $u .'
				            <span class="caret"></span>
				        </a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Ajustes de cuenta</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Perfil</a></li>
								<li><a href="index.php"><i class="halflings-icon off"></i> Cerrar Sesión</a></li>
							</ul>
				    </li>
				<!-- end: User Dropdown -->
            </ul>
        </div>';
}else{
     echo '
        <div class="nav-no-collapse header-nav">
            <ul class="nav pull-right">       
				<!-- start: User Dropdown -->
				    <li class="dropdown">
				        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				            <i class="halflings-icon white user"></i> Usuario no autorizado!
				            <span class="caret"></span>
				        </a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Ajustes de cuenta</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Perfil</a></li>
								<li><a href="index.php"><i class="halflings-icon off"></i> Cerrar Sesión</a></li>
							</ul>
				    </li>
				<!-- end: User Dropdown -->
            </ul>
        </div>';
}
?>