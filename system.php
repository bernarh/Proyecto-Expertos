
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

  <!--codigo select -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!--codigo select fin -->


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
			<div class="col-lg-11">
				<!-- BEGIN Body -->
		        <?php
				if (isset ( $_GET ["page"] ) && isset ( $_SESSION ['id'] )) { 
					if ($_GET ["page"] == "enfermeria" && ($_SESSION['id_tipo_usuario']==1||$_SESSION['id_tipo_usuario']==3))
						include_once ("pages/formEnfermeria.php");
					
					else if ($_GET ["page"] == "dashboard"){
						if($_SESSION['id_tipo_usuario']==1){
							include_once ("pages/dashboard.php");
						}else if($_SESSION['id_tipo_usuario']==2){
							include_once ("pages/vista_medico.php");
						}else if($_SESSION['id_tipo_usuario']==3){
							include_once ("pages/formEnfermeria.php");
						}else if($_SESSION['id_tipo_usuario']==4){
							
						}

					}
					else if ($_GET ["page"] == "menu_administrador" && $_SESSION['id_tipo_usuario']==1)
						include_once ("menu/menu_administrador.php");
					else if ($_GET ["page"] == "listar_usuarios" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/listar_usuarios.php");
					else if ($_GET ["page"] == "paciente" && ($_SESSION['id_tipo_usuario']==1||$_SESSION['id_tipo_usuario']==4))
						include_once ("pages/listar_paciente.php");
					else if ($_GET ["page"] == "listar_carrera" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/listar_carrera.php");
					else if ($_GET ["page"] == "reporte_citas" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/reporte_citas.php");
					else if ($_GET ["page"] == "listar_facultades" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/listar_facultades.php");
					else if ($_GET ["page"] == "listar_medicos" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/listar_medicos.php");
					else if ($_GET ["page"] == "insertar_usuario" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_usuario.php");
					
					else if ($_GET ["page"] == "insertar")
						include_once ("pages/insertar_paciente.php");
					else if ($_GET ["page"] == "insertar_carrera" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_carrera.php");
					else if ($_GET ["page"] == "insertar_facultad" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_facultad.php");
					else if ($_GET ["page"] == "editar_usuario" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/editar_usuario.php");
					
					else if ($_GET ["page"] == "editar_carrera" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/editar_carrera.php");
					else if ($_GET ["page"] == "editar_pass_usuario" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/editar_pass_usuario.php");
					else if ($_GET ["page"] == "editar_facultad" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/editar_facultad.php");
					else if ($_GET ["page"] == "eliminar_usuario" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/eliminar_usuario.php");
					else if ($_GET ["page"] == "eliminar_carrera" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/eliminar_carrera.php");
					else if ($_GET ["page"] == "eliminar_facultad" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/eliminar_facultad.php");
					else if ($_GET ["page"] == "deshabilitar_medico" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/deshabilitar_medico.php");
					else if ($_GET ["page"] == "medico" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_medico.php");
					else if ($_GET ["page"] == "tipo" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_tipo_medico.php");
					else if ($_GET ["page"] == "vista" && $_SESSION['id_tipo_usuario']==2)
						include_once ("pages/vista_medico.php");
					else if ($_GET ["page"] == "listamedicos" && $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/listar_medicos.php");
					else if ($_GET ["page"] == "actualizarM"&& $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/actualizar_medico.php");
					//MODIFICADOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
					else if ($_GET ["page"] == "administrarTcita"&& $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/administrar_tipo_cita.php");
					else if ($_GET ["page"] == "insertar_tipo_cita"&& $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/insertar_tipo_cita.php");
					else if ($_GET ["page"] == "editar_tipo_cita"&& $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/editar_tipo_cita.php");
					else if ($_GET ["page"] == "cambiar_e_tcita"&& $_SESSION['id_tipo_usuario']==1)
						include_once ("pages/cambiar_estado_tCita.php");
					else if ($_GET ["page"] == "insertar_cita"&& ($_SESSION['id_tipo_usuario']==1 or $_SESSION['id_tipo_usuario']==4))
						include_once ("pages/insertar_cita.php");
					
		//MODIFICDOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
					else {
						header ( "Location: system.php?page=dashboard" );
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
	<script type="text/javascript">
  
$(document).ready(function(){
	$('#btn_espera').click(function(){
		var id=$('#id_cita').val();
		$.ajax({
			url: "funciones.php",
			method: "POST",
			data: {condicion:"regresar",
					id_cita: id},
			dataType: "text",
			success: function(data){
			
				alert("Se ha pasado el paciente a sala de espera de EnfermerÃ­a");
				window.location="system.php?page=enfermeria";
			}
		});
	});

	$('#btn_finalizar').click(function(){
		var id=$('#id_cita').val();
		var confirmar= confirm("Este paciente ya no podrÃ¡ pasar con ningun mÃ©dico si finaliza esta cita. Â¿EstÃ¡ seguro que desea finalizar esta cita?");
		if(confirmar){
			$.ajax({
				url: "funciones.php",
				method: "POST",
				data: {condicion:"finalizar",
						id_cita: id},
				dataType: "text",
				success: function(data){
				
					alert("Se ha finalizado esta cita");
					window.location="system.php?page=enfermeria";
				}
			});

		}
	});
});



</script>
</body>
</html>
