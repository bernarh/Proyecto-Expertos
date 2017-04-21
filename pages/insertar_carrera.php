<?php

include_once ("model/Carrera.php");
if (isset ( $_POST ['txtCarrera'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	$idCarrera = - 1;
	$facultad = - 1;
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$carrera = mysqli_real_escape_string($con,(strip_tags($_POST ['txtCarrera'],ENT_QUOTES)));
	$idFacultad= mysqli_real_escape_string($con,(strip_tags($_POST ['selFacultad'],ENT_QUOTES)));
	/* ->falta lo de comprobar caracteres especiales en usuarios y password
	   -> que no se elimine lo llenado al salir un error en la validacion 
	   ->faltan los free result y cerrar conexion
	*/

	//validacion de los campos
	if (empty($carrera)){
		$errors[]='el nombre de Carrera se encuentra vacio';
	}else if (strlen($carrera)>100){
		$errors[]='nombre de la carrera muy grande';
	}else if (empty($idFacultad)){
		$errors[]='seleccione el tipo de usuario';
	}else{
		//insertando
		$carrera = new Carrera ( $idCarrera, $carrera, $idFacultad ,$facultad);
		$validarCarrera= $carrera->validarCarrera($conexion);
		$resultadoCarrera=$conexion->getRecords($validarCarrera);
		if ($resultadoCarrera['cantidad']==0){
			$carrera->insertNuevaCarrera ( $conexion );
			//mensaje de insertado y redireccionando a pagina principal
			$conexion->close();
			mysqli_free_result($validarCarrera);
			echo "<script> alert ('Carrera Insertada Con Exito');</script>";
			echo "<script> window.location='system.php?page=listar_carrera';</script>";
		}else{
			$errors[]='el nombre de carrera ya existe';
			$conexion->close();
			mysqli_free_result($validarCarrera);
		}
	}

	
}

?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Registrar Nueva Carrera</h4>
<form id="form1" name="form1" method="post" class="form-horizontal" action="">
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Carrera: </label>
		<div class="col-xs-5">
			<input type="text" id="txtCarrera" name="txtCarrera" maxlength="100" minlength="1" autocomplete="off"/>
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
	
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_carrera">Cancelar</a>|
			<input type="submit" id="submit" name="submit" value="Registrar" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">	
			<?php
			if (isset($errors)){
				foreach ($errors as $error) {
					echo $error;
				}
			}?></label>
	</div>
</form>