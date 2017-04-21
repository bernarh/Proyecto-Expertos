
<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( E_ALL );

include('model/Conexion.php');
include('menu.php');

//if (! isset ( $_SESSION ))
//	session_start ();

/**
 * Comprueba si en la session existe una variable definida en el momento del inicio de sesion
 * de no estar definida entonces se redirecciona al login para evitar accesos no autorizados al sistema
 */
 if (! isset ( $_SESSION ['id'] )) {
	header ( "Location: index.php" );
}
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">

  <?php echo css(); ?>


</head>

<body class="sticky-header">

<section>
<?php echo menu(); ?>
<!-- main content start-->
<div class="main-content" >

  <?php echo Encabezado(); ?>


	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			
			<div class="col-lg-12">
				<!-- BEGIN Body -->
		        <?php
				if (isset ( $_GET ["page"] ) && isset ( $_SESSION ['id'] )) { 
					if ($_GET ["page"] == "enfermeria")
						include_once ("pages/formEnfermeria.php");
					else if ($_GET ["page"] == "tv")
						include_once ("tv.php");
					else if ($_GET ["page"] == "dashboard")
						include_once ("pages/dashboard.php");
					else if ($_GET ["page"] == "menu_administrador")
						include_once ("menu/menu_administrador.php");
					else if ($_GET ["page"] == "listar_usuarios")
						include_once ("pages/listar_usuarios.php");
					else if ($_GET ["page"] == "paciente")
						include_once ("pages/listar_paciente.php");
					else if ($_GET ["page"] == "listar_carrera")
						include_once ("pages/listar_carrera.php");
					else if ($_GET ["page"] == "listar_facultades")
						include_once ("pages/listar_facultades.php");
					else if ($_GET ["page"] == "listar_medicos")
						include_once ("pages/listar_medicos.php");
					else if ($_GET ["page"] == "listar_tipos_usuario")
						include_once ("pages/listar_tipos_usuario.php");
					else if ($_GET ["page"] == "insertar_usuario")
						include_once ("pages/insertar_usuario.php");
					else if ($_GET ["page"] == "insertar_tipo_usuario")
						include_once ("pages/insertar_tipo_usuario.php");
					else if ($_GET ["page"] == "insertar")
						include_once ("pages/insertar_paciente.php");
					else if ($_GET ["page"] == "insertar_carrera")
						include_once ("pages/insertar_carrera.php");
					else if ($_GET ["page"] == "insertar_facultad")
						include_once ("pages/insertar_facultad.php");
					else if ($_GET ["page"] == "editar_usuario")
						include_once ("pages/editar_usuario.php");
					else if ($_GET ["page"] == "editar_tipos_usuario")
						include_once ("pages/editar_tipos_usuario.php");
					else if ($_GET ["page"] == "editar_carrera")
						include_once ("pages/editar_carrera.php");
					else if ($_GET ["page"] == "editar_pass_usuario")
						include_once ("pages/editar_pass_usuario.php");
					else if ($_GET ["page"] == "editar_facultad")
						include_once ("pages/editar_facultad.php");
					else if ($_GET ["page"] == "eliminar_usuario")
						include_once ("pages/eliminar_usuario.php");
					else if ($_GET ["page"] == "eliminar_carrera")
						include_once ("pages/eliminar_carrera.php");
					else if ($_GET ["page"] == "eliminar_facultad")
						include_once ("pages/eliminar_facultad.php");
					else if ($_GET ["page"] == "eliminar_tipo_usuario")
						include_once ("pages/eliminar_tipo_usuario.php");
					else if ($_GET ["page"] == "medico")
						include_once ("pages/insertar_medico.php");
					else if ($_GET ["page"] == "tipo")
						include_once ("pages/insertar_tipo_medico.php");
					else if ($_GET ["page"] == "vista")
						include_once ("pages/vista_medico.php");
					else if ($_GET ["page"] == "listamedicos")
						include_once ("pages/listar_medicos.php");
					else if ($_GET ["page"] == "actualizarM")
						include_once ("pages/actualizar_medico.php");
					else {
						include_once ("pages/dashboard.php");
					}
				} else {
					header ( "Location: index.php" );
				}
				?>
				
        <!-- END Body -->
			</div>

		</div>
			<!-- Site footer -->
			

	</div>

</section>
<footer class="footer">
	<center><p>&copy; 2017 INGENIERIA EN SISTEMAS - UNAH.</p></center>
</footer>
	<!-- /container -->
	<script src="js/jquery.min.js"></script>
	<?php
	if (isset ( $_GET ["page"] )) { // && isset ( $_SESSION ['id'] )
		if ($_GET ["page"] == "insertar_componentes")
			include_once ('<script type="text/javascript" src="custom_assets/componentes.js');
		else if ($_GET ["page"] == "editar_usuario"){?>	
			<script type="text/javascript">
				$(document).ready(function(){
			    	$('#selTipoUsuario > option[value="<?php echo $_GET['id_tipo_usuario']; ?>"]').attr('selected', 'selected');
				});
			</script>

		<?php }else if ($_GET ["page"] == "editar_carrera"){?>
			<script type="text/javascript">
				$(document).ready(function(){
			    	$('#selFacultad > option[value="<?php echo $_GET['facultad']; ?>"]').attr('selected', 'selected');
				});
			</script>
		<?php }
		
	}
	echo scripts(); ?>
</body>
</html>
