<?php 
include_once("model/Carrera.php");
$conexion = new Conexion();
$facultad = new Facultad();
$result = $facultad->listarFacultades($conexion);
echo EncabezadoAdministrar();
?>
<div class="legend"><h4>Listado de Facultades</h4></div>
<table class="table table-striped">
	<thead>
	<tr>
		<td colspan="5"><a href="system.php?page=insertar_facultad">Registrar Facultad</a></td>
	</tr>
	<tr>
		<th>id</th>
		<th>Nombre Facultad</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_facultad']; ?></td>
		<td><?php echo $row['nombre_facultad']; ?></td>
		<td><a href="system.php?page=editar_facultad&id=<?php echo $row['id_facultad']; ?>&nombre_facultad=<?php echo $row['nombre_facultad']; ?>">editar</a> |  <a href="system.php?page=eliminar_facultad&id=<?php echo $row['id_facultad']; ?>">eliminar</a></td>
	</tr>
	<?php }
		$conexion->close();
		mysqli_free_result($result);
	?>
	</tbody>
</table>