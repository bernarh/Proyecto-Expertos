<?php

include_once ("model/Carrera.php");
if (isset ( $_POST ['txtCarrera'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	$facultad = - 1;
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$idCarrera = mysqli_real_escape_string($con,(strip_tags($_POST ['txtIdCarrera'],ENT_QUOTES)));
	$nameCarrera = mysqli_real_escape_string($con,(strip_tags($_POST ['txtCarrera'],ENT_QUOTES)));
	$idFacultad= mysqli_real_escape_string($con,(strip_tags($_POST ['selFacultad'],ENT_QUOTES)));
	/* ->falta lo de comprobar caracteres especiales en usuarios y password
	   -> que no se elimine lo llenado al salir un error en la validacion 
	*/

	//validacion de los campos
	if (empty($nameCarrera)){
		$errors[]='el nombre de Carrera se encuentra vacio';
	}else if (strlen($nameCarrera)>100){
		$errors[]='nombre de la carrera muy grande';
	}else if (empty($idFacultad)){
		$errors[]='seleccione el tipo de usuario';
	}else{
		//insertando
		$carrera = new Carrera ( $idCarrera, $nameCarrera, $idFacultad ,$facultad);
		$nombreCarrera= $carrera->selectCarrera($conexion);
		$resultadoNombreCarrera=$conexion->getRecords($nombreCarrera);
		if ($resultadoNombreCarrera['nombre_carrera']===$nameCarrera) {
			$carrera->updateCarrera ( $conexion );
			//mensaje de insertado y redireccionando a pagina principal
			$conexion->close();
			mysqli_free_result($resultadoNombreCarrera);
			echo "<script> alert ('Carrera Editada Con Exito');</script>";
			echo "<script> window.location='system.php?page=listar_carrera';</script>";
		}else {
			$validarCarrera= $carrera->validarCarrera($conexion);
			$resultadoCarrera=$conexion->getRecords($validarCarrera);
			if ($resultadoCarrera['cantidad']==0){
				$carrera->updateCarrera ( $conexion );
				$conexion->close();
				mysqli_free_result($nombreCarrera);
				//mensaje de insertado y redireccionando a pagina principal
				echo "<script> alert ('Carrera Editada Con Exito');</script>";
				echo "<script> window.location='system.php?page=listar_carrera';</script>";
			}else{
				$errors[]='el nombre de carrera ya existe';
				$conexion->close();
				mysqli_free_result($nombreCarrera);
			}
		}
	}
	
	
}
	$conexion = new Conexion ();
	$carrera = new Carrera ($_GET['id'],-1,-1,-1);
	$result = $carrera->selectCarrera($conexion);
	$row=$conexion->getRecords($result);
	$conexion->close();
	mysqli_free_result($result);
?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Editar Carrera</h4>
<form id="form1" name="form1" method="post" class="form-horizontal" action="">
	<input type="hidden" id="txtIdCarrera" name="txtIdCarrera" value="<?php echo $_GET['id'] ?>" maxlength="11" minlength="1" autocomplete="off"/>
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Carrera: </label>
		<div class="col-xs-5">
			<input type="text" id="txtCarrera" name="txtCarrera" value="<?php echo $row['nombre_carrera'] ?>" maxlength="100" minlength="1" autocomplete="off"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Facultad:</label>
		<div class="col-xs-5">
			<select id="selFacultad" name="selFacultad">
					<option value="">--Seleccione la Facultad--</option>
					<?php 
						$conexion = new Conexion ();
						$facultad = new Facultad ();
						$result = $facultad->listarFacultades($conexion);
						while ($row = $conexion->getRecords($result)) {?>
							<option value="<?php echo $row['id_facultad']; ?>"><?php echo $row['nombre_facultad']; ?> </option>
					<?php }
						$conexion->close();
						mysqli_free_result($result);
					?>
			</select>
		</div>
	</div>
	<?php
			if (isset($errors)){
				foreach ($errors as $error) {
					echo $error;
				}
			}?>
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_carrera">Cancelar</a>|
			<input type="submit" id="submit" name="submit" value="Editar" />
		</div>
	</div>
</form>