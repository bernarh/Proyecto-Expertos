<?php 
include_once("model/TipoUsuario.php");
$conexion = new Conexion();
$tipoUsuario = new TipoUsuario();
$result = $tipoUsuario->listarTipoUsuario($conexion);
echo EncabezadoAdministrar();
?>
<div class="legend"><h4>Listado de Tipos de Usuario</h4></div>
<table class="table table-striped">
	<thead>
	<tr>
		<td colspan="5"><a href="system.php?page=listar_usuarios">Atras</a>|<a href="system.php?page=insertar_tipo_usuario">Registrar Tipo Usuario</a></td>
	</tr>
	<tr>
		<th>id</th>
		<th>Tipo Usuario</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_tipo_usuario']; ?></td>
		<td><?php echo $row['nombre_tipo_usuario']; ?></td>
		<td><a href="system.php?page=editar_tipos_usuario&id=<?php echo $row['id_tipo_usuario']; ?>&nombre_tipo_usuario=<?php echo $row['nombre_tipo_usuario']; ?>">editar</a> |  <a href="system.php?page=eliminar_tipo_usuario&id=<?php echo $row['id_tipo_usuario']; ?>">eliminar</a></td>
	</tr>
	<?php }?>
	</tbody>
</table>
<?php 
	$conexion->close();
	mysqli_free_result($result);

?>