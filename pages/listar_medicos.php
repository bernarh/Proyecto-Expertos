<?php 
include_once("model/Medico.php");
$conexion = new Conexion();
$medico = new Medico();
$cantidadMedicos = $medico->cantidadMedicos($conexion);
$totalFilas = mysqli_fetch_array($cantidadMedicos)[0];
$limite= 0;
$cantidad = 10;
if (isset ( $_GET ['limite'] ))
	$limite = $_GET ['limite'];
$result = $medico->listaMedicos($conexion,$limite,$cantidad);
?>
<div class="legend"><h4>Listado de Medicos</h4></div>
<table class="table table-striped">
	<thead>
		
	<tr>
	<td colspan="5"><a href="system.php?page=medico"">Registrar Medico</a></td>
	</tr>
	<tr>
		<th>id</th>
		<th>Nombre Medico</th>
		<th>Genero</th>
		<th>Tipo de Medico</th>
		<th>Estado Medico</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_medico']; ?></td>
		<td><?php echo $row['nombre_medico']; ?></td>
		<td><?php echo $row['genero']; ?></td>
		<td><?php echo $row['nombre_tipo_medico']; ?></td>
		<td><?php echo ($row['estado']==='1')?'Activo':'Inactivo'; ?></td>
		<td><a href="system.php?page=actualizarM&id_medico=<?php echo $row['id_medico']; ?>&genero=<?php echo $row['genero']; ?>&estado=<?php echo $row['estado']; ?>">editar</a> | <a href="system.php?page=eliminar_medico&id=<?php echo $row['id_medico']; ?>&estado=<?php echo $row['estado']; ?>"><?php echo ($row['estado']==1)?'Desactivar':'Activar'; ?></a></td>
		<?php }
			$conexion->close();
			mysqli_free_result($result);
		?>
	</tr>
	
	</tbody>
	<tr>
		<td>
			<?php if (($limite - $cantidad) >= 0) {?>
			<a href="system.php?page=listar_medicos&limite=<?php echo ($limite - $cantidad);?>">Anterior</a> |
		<?php } 
			  if(($limite * $cantidad) < $totalFilas) {?>
			<a href="system.php?page=listar_medicos&limite=<?php echo ($limite + $cantidad);?>">Siguiente</a>
		<?php } ?>
		</td>
	</tr>
</table>

		
	
