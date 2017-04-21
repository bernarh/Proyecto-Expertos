<?php

include_once ("model/TipoUsuario.php");
if (isset ( $_POST ['txtTipoUsuario'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	$idTipoUsuario = - 1;
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$tipoUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['txtTipoUsuario'],ENT_QUOTES)));
	/* -> que no se elimine lo llenado al salir un error en la validacion 
	   ->faltan los free result y cerrar conexion
	*/

	//validacion de los campos
	if (empty($tipoUsuario)){
		$errors[]='el nombre de Tipo Usuario se encuentra vacio';
	}else if (strlen($tipoUsuario)>50){
		$errors[]='nombre de Tipo de Usuario muy grande';
	}else{
		//insertando
		$tipoUsuario = new TipoUsuario ( $idTipoUsuario,$tipoUsuario);
		$validarTipoUsuario= $tipoUsuario->validarTipoUsuario($conexion);
		$resultadoTipoUsuario=$conexion->getRecords($validarTipoUsuario);
		if ($resultadoTipoUsuario['cantidad']==0){
			$tipoUsuario->insertNuevoTipoUsuario ( $conexion );
			//mensaje de insertado y redireccionando a pagina principal

			$conexion->close();
			mysqli_free_result($validarTipoUsuario);
			echo "<script> alert ('Tipo de Usuario Insertado Con Exito');</script>";
			echo "<script> window.location='system.php?page=listar_usuarios';</script>";
		}else{
			$errors[]='el nombre de Tipo de Usuario ya existe';
			$conexion->close();
			mysqli_free_result($validarTipoUsuario);
		}
	}

	
}

?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Registrar Nuevo Tipo de Usuario</h4>
<form id="form1" name="form1" method="post" class="form-horizontal" action="">
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Tipo de Usuario: </label>
		<div class="col-xs-5">
			<input type="text" id="txtTipoUsuario" name="txtTipoUsuario" maxlength="50" minlength="1" autocomplete="off"/>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_tipo_usuario">Cancelar</a>|
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