<?php 
include_once("model/Usuario.php");
$conexion = new Conexion();
$usuario = new Usuario();
$cantidadUsuarios = $usuario->cantidadUsuarios($conexion);
$totalFilas = mysqli_fetch_array($cantidadUsuarios)[0];
$limite= 0;
$cantidad = 10;
if (isset ( $_GET ['limite'] ))
	$limite = $_GET ['limite'];
$result = $usuario->listarUsuarios($conexion,$limite,$cantidad);
echo EncabezadoAdministrar();
?>
<div class="legend"><h4>Listado de Usuarios</h4></div>
<table class="table table-striped">
	<thead>
		
	<tr>
	<td colspan="5"><a href="system.php?page=insertar_usuario">Registrar Usuario </a>|<a href="system.php?page=listar_tipos_usuario"> Tipos de Usuarios</a></td>
	</tr>
	<tr>
		<th>id</th>
		<th>Nombre Usuario</th>
		<th>Tipo de Usuario</th>
		<th>Estado Usuario</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result)) {?>
	<tr>
		<td><?php echo $row['id_usuario']; ?></td>
		<td><?php echo $row['usuario']; ?></td>
		<td><?php echo $row['tipo_usuario']; ?></td>
		<td><?php echo ($row['estado_usuario']==1)?'Activo':'Inactivo'; ?></td>
		<td><a href="system.php?page=editar_usuario&id=<?php echo $row['id_usuario']; ?>&id_tipo_usuario=<?php echo $row['id_tipo_usuario']; ?>">editar</a> | <a href="system.php?page=editar_pass_usuario&id=<?php echo $row['id_usuario']; ?>">Cambiar Contraseña</a> | <a href="system.php?page=eliminar_usuario&id=<?php echo $row['id_usuario']; ?>&estado=<?php echo $row['estado_usuario']; ?>"><?php echo ($row['estado_usuario']==1)?'Desactivar':'Activar'; ?></a></td>
		<?php }?>
	</tr>
	
	</tbody>
	<tr>
		<td>
			<?php if (($limite - $cantidad) >= 0) {?>
			<a href="system.php?page=listar_usuarios&limite=<?php echo ($limite - $cantidad);?>">Anterior</a> |
		<?php } 
			  if(($limite * $cantidad) < $totalFilas) {?>
			<a href="system.php?page=listar_usuarios&limite=<?php echo ($limite + $cantidad);?>">Siguiente</a>
		<?php } ?>
		</td>
	</tr>
</table>
<?php 
	$conexion->close();
	mysqli_free_result($result);

?>
	
