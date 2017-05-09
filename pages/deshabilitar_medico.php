<?php

include_once("model/Medico.php");
$conexion = new Conexion();
$conn=$conexion->getConexion();
$estado=mysqli_real_escape_string($conn,(strip_tags($_GET['estado'],ENT_QUOTES)));
$id=mysqli_real_escape_string($conn,(strip_tags($_GET['id'],ENT_QUOTES)));
if($estado==1){
	$medico = new Medico();
	//cantidad de pacientes del medico a deshabilitar
	$resultCantidadPacientes = $medico->cantidadPacientes($conexion,$id);
	$cantidadPacientes = mysqli_fetch_array($resultCantidadPacientes)[0];
	$result = $medico->listaPacientes($conexion,$id);
	mysqli_free_result($resultCantidadPacientes);	
	while ( $rowPaciente=$conexion->getRecords($result)) {	

		//cantidad de medicos disponible para ese tipo de consulta
		if(!($resultCantidadMedicoDisponible = $medico->cantidadMedicosDisponible($conexion,$id,$rowPaciente['id_tipo_cita']))){
			$errors[]= $resultCantidadMedicoDisponible;
			mysqli_free_result($resultCantidadMedicoDisponible);
		}
		$cantidadMedicoDisponible = mysqli_fetch_array($resultCantidadMedicoDisponible)[0];
		if ($cantidadMedicoDisponible<=0){
			$errors[]= 'no hay medicos disponible para este tipo de citas';
		}else{
			//lista de medicos disponible
			$resultListaMedicoDisponible = $medico->listaMedicosDisponible($conexion,$id,$rowPaciente['id_tipo_cita']);
			$totalAnterior = 100;
			while ( $rowMedicos=$conexion->getRecords($resultListaMedicoDisponible)){
				//buscando el medico con menos citas
				$resultCantidadPacientes = $medico->cantidadPacientes($conexion,$rowMedicos['id_medico']);
				$totalNuevo = mysqli_fetch_array($resultCantidadPacientes)[0];
				if($totalNuevo<$totalAnterior){
					$totalAnterior=$totalNuevo;
					$idMedico=$rowMedicos['id_medico'];
				}
				mysqli_free_result($resultCantidadPacientes);
			}
			//guardando cuantos pacientes tiene cada medico
			$medico->cambiarMedico($conexion,$rowPaciente['id_cita'],$idMedico);
			echo "<script> setInterval(window.location='system.php?page=listar_medicos',3000);</script>";
		}
		mysqli_free_result($resultListaMedicoDisponible);

	}
	$medico->activarMedico($conexion,$estado,$id);
	$messages[]="deshabilitado con exito";
	//echo "<script> setInterval(window.location='system.php?page=listar_medicos',3000);</script>";
	mysqli_free_result($result);
}else{
		$id=$_GET['id'];
		$estado=$_GET['estado'];
		$medico = new Medico();
		if($medico->activarMedico($conexion,$estado,$id)){
			$messages[]="habilitado con exito";
			echo "<script> setInterval(window.location='system.php?page=listar_medicos',3000);</script>";
		}else{
			$errors='error desconocido';
		}
}


$conexion->close();
if (isset($errors)){ ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
		if (isset($messages)){ ?>
					<div class="alert alert-success" role="alert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>¡Bien hecho!</strong>
							<?php
								foreach ($messages as $message) {
										echo $message;
									}
								?>
					</div>
		<?php
		}
?>