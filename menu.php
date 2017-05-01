<?php


session_start();
    
    //if (!isset($_SESSION['usuario'])) {
      //  header("location: index.php");
        //exit;
        //}

     



 function css(){
 	return '<link href="css/style.css" rel="stylesheet">'.
  			'<link href="css/style-responsive.css" rel="stylesheet">'.
  			'<link href="fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
  			//'<link rel="stylesheet" href="media/css/dataTables.bootstrap.min.css">'.
		    //'<link rel="stylesheet" href="media/font-awesome/css/font-awesome.css">';
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
			//'<script src="js/CalculadoraPrincipal.js"></script>'.
			'<script src="js/scripts.js"></script>'.
			
			'<!--Javascript en proyectos-->';  
		   // '<script src="media/js/jquery-1.10.2.js"></script>'.
		    //'<script src="media/js/jquery.dataTables.min.js"></script>'.
		    //'<script src="media/js/dataTables.bootstrap.min.js"></script>';       
		    //'<script src="media/js/bootstrap.js"></script>'.

}

function menu(){
	return '<!-- left side start-->'.
		    '<div class="sticky-left-side left-side">'.

		        '<!--logo and iconic logo start-->'.
		        '<div class="logo">'.
		          '  <a href="index.php"><img class="img-responsive" src="images/logo.png" alt=""></a>'.
		        '</div>'.

		        '<div class="logo-icon text-center">'.
		            '<a href="index.php"><img class="img-responsive" src="images/logo_icon.png" alt=""></a>'.
		        '</div>'.
		        '<!--logo and iconic logo end-->'.

		        '<div class="left-side-inner">'.

		            '<!--sidebar nav start-->'.
		            '<ul class="nav nav-pills nav-stacked custom-nav">'.
		                '<li><a href="system.php?page=dashboard"><i class="fa fa-home"></i> <span>Inicio</span></a>'.
		                '</li>'.
		                
		                '<li><a href="pages/tv.php"><i class="fa fa-television"></i> <span> Ver TV</span></a></li>'.
		                
		               

		                '<li><a href="system.php?page=paciente"><i class="fa fa-archive"></i> <span>Archivo</span></a></li>'.
		                '<li><a href="system.php?page=insertar_cita"><i class="fa fa-archive"></i> <span>Citas</span></a></li>'.

		                '<li><a href="system.php?page=administrarTcita"><i class="fa fa-tablet"></i> <span>Administrar Tipo Cita</span></a></li>'.

		                '<li><a href="system.php?page=insertar"><i class="fa fa-tablet"></i> <span>Tablet</span></a></li>'.


		                '<li><a href="system.php?page=enfermeria"><i class="fa fa-medkit"></i> <span>Enfermería</span></a></li>'.

		                '<li><a href="system.php?page=listar_medicos"><i class="fa fa-user-md"></i> <span>Medicos</span></a></li>'.


		                '<li><a href="system.php?page=vista"><i class="fa fa-users"></i> <span>Datos Pacientes</span></a></li>'.

		                '<li><a href="system.php?page=listar_usuarios"><i class="fa fa-user-circle-o"></i> <span>Administrar</span></a></li>'.

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
	            '<!--<form class="searchform" action="index.html" method="post">-->'.
	                '<!--<input type="text" class="form-control" name="keyword" placeholder="Buscar aqui..." />-->'.
	            '<!--</form>-->'.

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

function EncabezadoAdministrar(){
	return  '<!-- page heading end-->'.
		'<div class="wrapper">'.
			'<div class="row">'.
			  '<div class="col-lg-12">'.
				'<section class="panel">'.
	                        '<header class="panel-heading custom-tab dark-tab">'.
	                           ' <ul class="nav nav-tabs">'.
	                                '<li>'.
	                                    '<a  href="system.php?page=dashboard">'.
	                                        '<i class="fa fa-home"></i>'.
	                                    '</a>'.
	                                '</li>'.
	                                '<li>'.
	                                   ' <a  href="system.php?page=listar_usuarios">'.
	                                        '<i class="fa fa-user"></i>'.
	                                        'USUARIOS'.
	                                    '</a>'.
	                               ' </li>'.
	                                '<li class="">'.
	                                    '<a  href="system.php?page=listar_facultades">'.
	                                        '<i class="fa fa-university "></i>'.
	                                        'FACULTADES'.
	                                   ' </a>'.
	                                '</li>'.
	                                '<li class="">'.
	                                    '<a href="system.php?page=listar_carrera">'.
	                                        '<i class="fa fa-flask"></i>'.
	                                        'CARRERAS'.
	                                    '</a>'.
	                                '</li>'.
	                            '</ul>'.
	                        '</header>'.
	            '</section>'.
	       ' </div>'.
	    '</div>'.
	'</div>';
}
?>