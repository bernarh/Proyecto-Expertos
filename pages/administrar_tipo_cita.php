<?php
include_once('model/TipoCita.php');

 $conexion = new Conexion();
 $tipoCita = new TipoCita();

$result= $tipoCita->listarTipoCita($conexion);

?>

<div class="legend"><h4>Listado de Tipos de Cita</h4></div>
<table class="table table-striped">
	<thead>
	<tr>
		<td colspan="5"><a href="system.php?page=insertar_tipo_cita">Registrar Tipo Cita</a></td>
	</tr>
	<tr>
		<th>Id</th>
		<th>Tipo Cita</th>
		<th>Estado</th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_tipo_cita']; ?></td>
		<td><?php echo $row['nombre_cita']; ?></td>
		<td><?php 
						 if($row['estado']==1)
						 {
						 	echo("Actvio");
						 } 
						 else{echo("Inactivo");}
						 ?>
		<td><a href="system.php?page=editar_tipo_cita&id=<?php echo $row['id_tipo_cita']; ?>&nombre_cita=<?php echo $row['nombre_cita']; ?>">editar</a> |  
		<a href="system.php?page=cambiar_e_tcita&id=<?php echo $row['id_tipo_cita']; ?>&estado=<?php echo $row['estado']?>">
			<?php 
						 if($row['estado']==1)
						 {
						 	echo("Desactivar");
						 } 
						 else{echo("Activar");}
						 ?>
						 </a></td>
	</tr>
	<?php }?>
	</tbody>
</table>
<?php 
	$conexion->close();
	mysqli_free_result($result);

?>