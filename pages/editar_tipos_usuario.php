<?php

include_once ("model/TipoUsuario.php");
if (isset ( $_POST ['txtTipoUsuario'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$nameTipoUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['txtTipoUsuario'],ENT_QUOTES)));
	$idTipoUsuario =mysqli_real_escape_string($con,(strip_tags($_POST ['txtIdTipoUsuario'],ENT_QUOTES)));
	/* -> que no se elimine lo llenado al salir un error en la validacion 
	   ->faltan los free result y cerrar conexion
	*/

	//validacion de los campos
	if (empty($nameTipoUsuario)){
		$errors[]='el nombre de tipo usuario se encuentra vacio';
	}else if (strlen($nameTipoUsuario)>500){
		$errors[]='nombre de tipo usuario muy grande';
	}else{
		//insertando
		$tipoUsuario = new TipoUsuario ( $idTipoUsuario,$nameTipoUsuario);
		$nombreTipoUsuario= $tipoUsuario->selectTipoUsuario($conexion);
		$resultadoTipoUsuario=$conexion->getRecords($nombreTipoUsuario);
		if ($resultadoTipoUsuario['nombre_tipo_usuario']===$nameTipoUsuario) {
			$conexion->close();
			mysqli_free_result($nombreTipoUsuario);
			echo "<script> alert ('Tipo de Usuario ya tiene ese nombre');</script>";
			echo "<script> window.location='system.php?page=listar_tipos_usuario';</script>";
		}else{
			$validarTipoUsuario= $tipoUsuario->validarTipoUsuario($conexion);
			$resultado=$conexion->getRecords($validarTipoUsuario);
			if ($resultado['cantidad']==0){
				$tipoUsuario->updateTipoUsuario ( $conexion );
				$conexion->close();
				mysqli_free_result($nombreTipoUsuario);
				mysqli_free_result($validarTipoUsuario);
				//mensaje de insertado y redireccionando a pagina principal
				echo "<script> alert ('Tipo de Usuario Editado Con Exito');</script>";
				echo "<script> window.location='system.php?page=listar_tipos_usuario';</script>";
			}else{
				$errors[]='el nombre de Tipo de Usuario ya existe';
				$conexion->close();
				mysqli_free_result($nombreTipoUsuario);
				mysqli_free_result($validarTipoUsuario);

			}
		}
	}

	
}

?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Editar Facultad</h4>
<form id="form1" name="form1" method="post" class="form-horizontal" action="">
	<input type="hidden" id="txtIdTipoUsuario" name="txtIdTipoUsuario" value="<?php echo $_GET['id']?>" maxlength="8" minlength="1" autocomplete="off"/>
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Tipo Usuario: </label>
		<div class="col-xs-5">
			<input type="text" id="txtTipoUsuario" name="txtTipoUsuario" value="<?php echo $_GET['nombre_tipo_usuario']?>" maxlength="50" minlength="1" autocomplete="off"/>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_tipos_usuario">Cancelar</a>|
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