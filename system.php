
<?php
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( E_ALL );

include('conexion.php');
include('menu.php');

if (! isset ( $_SESSION ))
	session_start ();

/**
 * Comprueba si en la session existe una variable definida en el momento del inicio de sesion
 * de no estar definida entonces se redirecciona al login para evitar accesos no autorizados al sistema
 if (! isset ( $_SESSION ['id'] )) {
	header ( "Location: index.php" );
}
 */


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
			<div class="col-lg-4">
				<!-- BEGIN Controller-->

				<!-- END Controller -->
			</div>
			<div class="col-lg-8">
				<!-- BEGIN Body -->
        <?php
		if (isset ( $_GET ["page"] ) ) {   //&& isset ( $_SESSION ['id'] )
			if ($_GET ["page"] == "enfermeria")
				include_once ("formEnfermeria.php");
			else if ($_GET ["page"] == "tv")
				include_once ("tv.php");
			else {
				include_once ("pages/editar_componentes.php");
			}
		} else {
			header ( "Location: ./index.php" );
		}
		?>
        <!-- END Body -->
			</div>
		</div>

		<!-- Site footer -->
		<footer class="footer">
			<p>&copy; 2016 Company, Inc.</p>
		</footer>

	</div>
</div>

</section>
	<!-- /container -->
	<?php
	if (isset ( $_GET ["page"] )) { // && isset ( $_SESSION ['id'] )
		if ($_GET ["page"] == "insertar_componentes")
			include_once ('<script type="text/javascript" src="custom_assets/componentes.js');
	}
	?>

<?php echo scripts(); ?>
</body>
</html>
