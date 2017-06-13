<?php
include_once("model/Paciente.php");
include_once("model/Carrera.php");
$conexion = new Conexion();
$paciente = new Paciente();
$carrera = new Carrera();
$result = $paciente->listarPacientes($conexion);
$resultCarrera= $carrera->listasTCarreras($conexion);
?>


<div class="legend"><h4>Listado de Pacientes</h4></div>
<table class="table table-striped">
	<thead>
	<tr>
	
	</tr>
	<tr>
		<th>Numero de Cuenta</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Telefono</th>
		<th>Fecha de Nacimiento</th>
		<th>Carrera</th>
		<th>Genero</th>
		<th>Estado</th>
	</tr> 
	</thead>
	<tbody>
	<?php while ($row = $conexion->getRecords($result) ){?>
	<tr>
		 
				<td><?php echo $row['nro_cuenta']; ?></td>
				<td><?php echo $row['nombres']; ?></td>
				<td><?php echo $row['apellidos']; ?></td>
				<td><?php echo $row['telefono']; ?></td>
				<td><?php echo $row['fecha_nacimiento']; ?></td>
				<td><?php echo $row['nombre_carrera']; ?> </td>	


				<!--<?php
							$rowCarrera= $conexion->getRecords($resultCarrera);
							if($rowCarrera['id_carrera']==$row['id_carrera'])
							{
								echo $rowCarrera['nombre_carrera'];
							}
				      	?>-->
				<td><?php echo $row['genero']; ?></td>
				<td><?php 
						 if($row['estado']==1)
						 {
						 	echo("Actvio");
						 } 
						 else{echo("Inactivo");}
						 ?>
					

				</td>
				<td><a href="system.php?page=editar_paciente&cuenta=<?php echo($row['nro_cuenta'])?>&nombre=<?php echo($row['nombres']);?>&apellido=<?php echo($row['apellidos']);?>&telefono=<?php echo($row['telefono']);?>&fecha=<?php echo($row['fecha_nacimiento']); ?>&genero=<?php echo($row['genero'])?>">editar</a></td>
				<!-- TODO: modifique la consulta para que se muestre el nombre de la carrera y no el numero -->
				<!-- TODO: Escriba los enlaces necesarios para realizar -->
				<!-- las acciones de editar y eliminar estudiante -->
				<!-- respetando la mecanica de la plantilla -->
				<!--<?php $editar= "system.php?page=editar&id=".$row['id'];?>  
				<?php $eliminar= "system.php?page=eliminar&id=".$row['id'];?>  -->
				

		
		

	</tr>
	<?php }?>
	</tbody>
</table>