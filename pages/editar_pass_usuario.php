<?php

include_once ("model/Usuario.php");
include_once ("model/Conexion.php");
if (isset ( $_POST ['txtUsuario'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcion
	$id = mysqli_real_escape_string($con,(strip_tags($_POST ['txtIdUsuario'],ENT_QUOTES)));
	$nameUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['txtUsuario'],ENT_QUOTES)));
	$password = mysqli_real_escape_string($con,(strip_tags($_POST ['txtPassword'],ENT_QUOTES)));
	$password2 = mysqli_real_escape_string($con,(strip_tags($_POST ['txtPassword2'],ENT_QUOTES)));
	$tipoUsuario = - 1;
	$idTipoUsuario=-1;
	//validacion de los campos
	if (empty($nameUsuario)){
		$errors[]='el nombre de Usuario se encuentra vacio';
	}else if (strlen($nameUsuario)>50){
		$errors[]='nombre de usuario muy grande';
	}else if ($password!=$password2){
		$errors[]='las contraseñas no coinciden';
	}else if (empty($password)){
		$errors[]='la contraseña de Usuario se encuentra vacio';
	}else if (strlen($password)<8||strlen($password)>16){
		$errors[]='la contraseña debe ser mayor que 7 caracteres y menor de 16';
	}else{
		$usuario = new Usuario ( $id, $nameUsuario, $tipoUsuario ,$idTipoUsuario, $password );
		$validarUsuario= $usuario->nombreUsuario($conexion);
		$resultadoUsuario=$conexion->getRecords($validarUsuario);
			$usuario->updatePassUsuario( $conexion );
			$conexion->close();
			mysqli_free_result($validarUsuario);
			echo "<script> alert ('La Password Usuario Editado Con Exito');</script>";
			echo "<script> window.location='system.php?page=listar_usuarios';</script>";
		}
	}
	
		$conexion = new Conexion ();
		$usuario = new Usuario ($_GET['id'],-1,-1,-1,-1);
		$result = $usuario->selectUsuario($conexion);
		$row=$conexion->getRecords($result);
		$conexion->close();
		mysqli_free_result($result);
	
?>
	<div class="col-md-2"></div>
	<h2 class="page-header">Editar contraseña Usuario</h4>
<form id="form1" name="form1" method="post" action="" class="form-horizontal" >
	<input type="hidden" id="txtIdUsuario" name="txtIdUsuario" value="<?php echo $_GET['id']; ?>" />
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Usuario: </label>
		<div class="col-xs-5">
			<input type="text" id="txtUsuario" name="txtUsuario" value="<?php echo $row['usuario']; ?>" maxlength="50" minlength="1" autocomplete="off"/>
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
			<a href="system.php?page=listar_usuarios">Cancelar</a>
			|<input type="submit" id="submit" name="submit" value="Cambiar" />
		</div>
	</div>
</form>