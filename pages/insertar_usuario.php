<?php

include_once ("model/Usuario.php");
if (isset ( $_POST ['txtUsuario'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	$id = - 1;
	$tipoUsuario = - 1;
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$usuario = mysqli_real_escape_string($con,(strip_tags($_POST ['txtUsuario'],ENT_QUOTES)));
	$password = mysqli_real_escape_string($con,(strip_tags($_POST ['txtPassword'],ENT_QUOTES)));
	$password2 = mysqli_real_escape_string($con,(strip_tags($_POST ['txtPassword2'],ENT_QUOTES)));
	$idTipoUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['selTipoUsuario'],ENT_QUOTES)));
	/* ->falta lo de comprobar caracteres especiales en usuarios y password
	   -> que no se elimine lo llenado al salir un error en la validacion 
	*/

	//validacion de los campos
	if (empty($usuario)){
		$errors[]='el nombre de Usuario se encuentra vacio';
	}else if (strlen($usuario)>50){
		$errors[]='nombre de usuario muy grande';
	}else if ($password!=$password2){
		$errors[]='las contraseñas no coinciden';
	}else if (empty($password)){
		$errors[]='la contraseña de Usuario se encuentra vacio';
	}else if (strlen($password)<8||strlen($password)>16){
		$errors[]='la contraseña debe ser mayor que 7 caracteres y menor de 16';
	}else if (empty($idTipoUsuario)){
		$errors[]='seleccione el tipo de usuario';
	}else{
		//insertando
		$usuario = new Usuario ( $id, $usuario, $tipoUsuario ,$idTipoUsuario, $password );
		$validarUsuario= $usuario->validarUsuario($conexion);
		$resultadoUsuario=$conexion->getRecords($validarUsuario);
		if ($resultadoUsuario['cantidad']==0){
			$usuario->insertNuevoUsuario ( $conexion );
			//mensaje de insertado y redireccionando a pagina principal
			$conexion->close();
			mysqli_free_result($validarUsuario);
			echo "<script> alert ('Usuario Insertado Con Exito');</script>";

			echo "<script> window.location='system.php?page=listar_usuarios';</script>";
		}else{
			$errors[]='el nombre de usuario ya existe';
			$conexion->close();
			mysqli_free_result($validarUsuario);
		}
	}

	
}

?>
<div class="col-md-2"></div>
<h2 class="page-header">Registrar Nuevo Usuario</h2>
<form id="form1" name="form1" method="post" action="" class="form-horizontal">
	<div class="form-group">
		<label class="col-xs-3 control-label">	Nombre Usuario:</label>
		<div class="col-xs-5">
			<input type="text" id="txtUsuario" name="txtUsuario" maxlength="50" minlength="1" autocomplete="off"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Password:</label>
		<div class="col-xs-5">
			<input type="password" id="txtPassword" name="txtPassword" maxlength="16" minlength="8" autocomplete="off"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Password de Nuevo:</label>
		<div class="col-xs-5">
			<input type="password" id="txtPassword2" name="txtPassword2" maxlength="16" minlength="8" autocomplete="off"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Tipo de Usuario:</label>
		<div class="col-xs-5">
			<select id="selTipoUsuario" name="selTipoUsuario">
					<option value="">--Seleccione un Tipo de Usuario--</option>
					<?php 
						$conexion = new Conexion ();
						$usuario = new Usuario ();
						$result = $usuario->listarTiposUsuario($conexion);
						while ($row = $conexion->getRecords($result)) {?>
							<option value="<?php echo $row['id_tipo_usuario']; ?>"><?php echo $row['nombre_tipo_usuario']; ?> </option>
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
		<div class="col-xs-5"><a href="system.php?page=listar_usuarios">Cancelar</a>
			<input type="submit" id="submit" name="submit" value="Registrar" />
		</div>
	</div>
</form>