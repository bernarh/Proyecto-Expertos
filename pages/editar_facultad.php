<?php

include_once ("model/Carrera.php");
if (isset ( $_POST ['txtFacultad'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$nameFacultad = mysqli_real_escape_string($con,(strip_tags($_POST ['txtFacultad'],ENT_QUOTES)));
	$idFacultad =mysqli_real_escape_string($con,(strip_tags($_POST ['txtIdFacultad'],ENT_QUOTES)));
	/* -> que no se elimine lo llenado al salir un error en la validacion 
	   ->faltan los free result y cerrar conexion
	*/

	//validacion de los campos
	if (empty($nameFacultad)){
		$errors[]='el nombre de Facultad se encuentra vacio';
	}else if (strlen($nameFacultad)>100){
		$errors[]='nombre de Facultad muy grande';
	}else{
		//insertando
		$facultad = new Facultad ( $idFacultad,$nameFacultad);
		$nombreFacultad= $facultad->selectFacultad($conexion);
		$resultadoFacultad=$conexion->getRecords($nombreFacultad);
		if ($resultadoFacultad['nombre_facultad']===$nameFacultad) {
			$conexion->close();
			mysqli_free_result($nombreFacultad);
			echo "<script> alert ('Facultad ya tiene ese nombre');</script>";
			echo "<script> window.location='system.php?page=listar_facultades';</script>";
		}else{
			$validarFacultad= $facultad->validarFacultad($conexion);
			$resultado=$conexion->getRecords($validarFacultad);
			if ($resultado['cantidad']==0){
				$facultad->updateFacultad ( $conexion );
				//mensaje de insertado y redireccionando a pagina principal
				$conexion->close();
				mysqli_free_result($nombreFacultad);
				mysqli_free_result($validarFacultad);
				echo "<script> alert ('Facultad Editado Con Exito');</script>";
				echo "<script> window.location='system.php?page=listar_facultades';</script>";
			}else{
				$errors[]='el nombre de facultad ya existe';
				$conexion->close();
				mysqli_free_result($nombreFacultad);
				mysqli_free_result($validarFacultad);
			}
		}
	}

	
}

?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Editar Facultad</h4>
<form id="form1" name="form1" method="post" class="form-horizontal" action="">
	<input type="hidden" id="txtIdFacultad" name="txtIdFacultad" value="<?php echo $_GET['id']?>" maxlength="8" minlength="1" autocomplete="off"/>
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Facultad: </label>
		<div class="col-xs-5">
			<input type="text" id="txtFacultad" name="txtFacultad" value="<?php echo $_GET['nombre_facultad']?>" maxlength="100" minlength="1" autocomplete="off"/>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_facultades">Cancelar</a>|
			<input type="submit" id="submit" name="submit" value="Editar" />
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