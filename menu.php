<?php


session_start();
    /*
    if (!isset($_SESSION['usuario']) AND $_SESSION['usuario'] != 1) {
        header("location: login.php");
        exit;
        }

     */



 function css(){
 	return '<link href="css/style.css" rel="stylesheet">'.
  			'<link href="css/style-responsive.css" rel="stylesheet">'.
  			'<link href="fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">'.
  			'<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">'.
		    '<link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">';
 }

function scripts(){
	return '<!-- Placed js at the end of the document so the pages load faster -->'.
			'<script src="js/jquery-1.10.2.min.js"></script>'.
			'<script src="js/jquery-ui-1.9.2.custom.min.js"></script>'.
			'<script src="js/jquery-migrate-1.2.1.min.js"></script>'.
			'<script src="js/bootstrap.min.js"></script>'.
			'<script src="js/modernizr.min.js"></script>'.
			'<script src="js/jquery.nicescroll.js"></script>'.

			'<!--common scripts for all pages-->'.
			'<script src="js/CalculadoraPrincipal.js"></script>'.
			'<script src="js/scripts.js"></script>'.
			
			'<!--Javascript en proyectos-->'.    
		   // '<script src="media/js/jquery-1.10.2.js"></script>'.
		    '<script src="media/js/jquery.dataTables.min.js"></script>'.
		    '<script src="media/js/dataTables.bootstrap.min.js"></script>';       
		    //'<script src="media/js/bootstrap.js"></script>'.

}

function menu(){
	return '<!-- left side start-->'.
		    '<div class="sticky-left-side left-side">'.

		        '<!--logo and iconic logo start-->'.
		        '<div class="logo">'.
		          '  <a href="index.php"><img src="images/logo.png" alt=""></a>'.
		        '</div>'.

		        '<div class="logo-icon text-center">'.
		            '<a href="index.php"><img src="images/logo_icon.png" alt=""></a>'.
		        '</div>'.
		        '<!--logo and iconic logo end-->'.

		        '<div class="left-side-inner">'.

		            '<!--sidebar nav start-->'.
		            '<ul class="nav nav-pills nav-stacked custom-nav">'.
		                '<li><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a>'.
		                '</li>'.
		                
		                '<li><a href="nuevoProyecto.php"><i class="fa fa-pencil-square-o"></i> <span> Ver TV</span></a></li>'.
		                
		                '<li><a href="calculadora.php"><i class="fa fa-calculator"></i> <span>Citas</span></a></li>'.

		                '<li><a href="quienesomos.php"><i class="fa fa-user"></i> <span>Archivo</span></a></li>'.

		                '<li><a href=""><i class="fa fa-bar-chart-o"></i> <span>Enfermería</span></a></li>'.

		                '<li><a href="mapa.php"><i class="fa fa-map-marker"></i> <span>Doctores</span></a></li>'.

		                '<li><a href=""><i class="fa fa-file-text"></i> <span>Administrar</span></a></li>'.

		                '<li><a href="logout.php"><i class="fa fa-sign-in"></i> <span>Cerrar Sesión</span></a></li>'.

		            '</ul>'.
		            '<!--sidebar nav end-->'.

		        '</div>'.
		   ' </div>'.
		    '<!-- left side end-->';
}

function Encabezado(){
	
	return '<!-- header section start-->'.
	        '<div class="header-section">'.

	            '<!--toggle button start-->'.
	            '<a class="toggle-btn"><i class="fa fa-bars"></i></a>'.
	            '<!--toggle button end-->'.

	            '<!--search start-->'.
	            '<form class="searchform" action="index.html" method="post">'.
	                '<input type="text" class="form-control" name="keyword" placeholder="Buscar aqui..." />'.
	            '</form>'.

	            '<!--search end-->'.

	            '<!--notification menu start -->'.
	            '<div class="menu-right">'.
	                '<ul class="notification-menu">'.
	                    '<li>'.
	                        '<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">'.
	                            '<img src="images/photos/user-avatar.png" alt="" />'.
	                            $_SESSION['usuario'].
	                            '<span class="caret"></span>'.
	                        '</a>'.
	                        '<ul class="dropdown-menu dropdown-menu-usermenu pull-right">'.
	                            '<li><a href="#"><i class="fa fa-user"></i>  Perfil</a></li>'.
	                            '<li><a href="#"><i class="fa fa-cog"></i>  Configuracion</a></li>'.
	                            '<li><a href="logout.php"><i class="fa fa-sign-out"></i> Desconectarse</a></li>'.
	                        '</ul>'.
	                    '</li>'.

	                '</ul>'.
	            '</div>'.
	            '<!--notification menu end -->'.

	        '</div>'.
	        '<!-- header section end-->';
}

?>