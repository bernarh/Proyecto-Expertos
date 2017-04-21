<?php 
include_once("model/Carrera.php");
$conexion = new Conexion();
$carrera = new Carrera();
$cantidadCarreras = $carrera->cantidadCarreras($conexion);
$totalFilas = mysqli_fetch_array($cantidadCarreras)[0];
$limite= 0;
$cantidad = 10;
if (isset ( $_GET ['limite'] ))
	$limite = $_GET ['limite'];
$result = $carrera->listarCarreras($conexion,$limite,$cantidad);
echo EncabezadoAdministrar();
?>

<div class="legend"><h4>Listado de carreras</h4></div>
<table class="table table-striped">
	<thead>
	<tr>
		<td colspan="5"><a href="system.php?page=insertar_carrera">Registrar Carrera</a></td>
	</tr>
	<tr>
		<th>id</th>
		<th>Nombre Carrera</th>
		<th>Facultad</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_carrera']; ?></td>
		<td><?php echo $row['nombre_carrera']; ?></td>
		<td><?php echo $row['nombre_facultad']; ?></td>
		<td><a href="system.php?page=editar_carrera&id=<?php echo $row['id_carrera']; ?>&facultad=<?php echo $row['id_facultad']; ?>">editar</a> |  <a href="system.php?page=eliminar_carrera&id=<?php echo $row['id_carrera']; ?>">eliminar</a></td>
	</tr>
	<?php }
		$conexion->close();
		mysqli_free_result($result);
	?>
	</tbody>
	<tr>
		<td colspan="5"><?php if (($limite - $cantidad) >= 0) {?>
			<a href="system.php?page=listar_carrera&limite=<?php echo ($limite - $cantidad);?>">Anterior</a> |
		<?php } 
			  if(($limite * $cantidad) < $totalFilas) {?>
			<a href="system.php?page=listar_carrera&limite=<?php echo ($limite + $cantidad);?>">Siguiente</a>
		<?php } ?></td>
	</tr>
</table>