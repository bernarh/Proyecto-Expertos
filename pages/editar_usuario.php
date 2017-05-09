<?php

include_once ("model/Usuario.php");
include_once ("model/Conexion.php");
if (isset ( $_POST ['txtUsuario'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcion
	$id = mysqli_real_escape_string($con,(strip_tags($_POST ['txtIdUsuario'],ENT_QUOTES)));
	$nameUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['txtUsuario'],ENT_QUOTES)));
	$idTipoUsuario = mysqli_real_escape_string($con,(strip_tags($_POST ['selTipoUsuario'],ENT_QUOTES)));
	$tipoUsuario = - 1;
	$password=-1;
	if (empty($nameUsuario)){
		$errors[]='el nombre de Usuario se encuentra vacio';
	}else if (empty($id)){
		$errors[]='error desconocido';
	}else if (strlen($nameUsuario)>50){
		$errors[]='nombre de usuario muy grande';
	}else if (empty($idTipoUsuario)){
		$errors[]='seleccione el tipo de usuario';
	}else{
		$usuario = new Usuario ( $id, $nameUsuario, $tipoUsuario ,$idTipoUsuario, $password );
		$validarUsuario= $usuario->nombreUsuario($conexion);
		$resultadoUsuario=$conexion->getRecords($validarUsuario);
		if ($resultadoUsuario['usuario']===$nameUsuario){
			$usuario->updateUsuario( $conexion );
			$conexion->close();
			mysqli_free_result($validarUsuario);
			$messages[]='Usuario Editado Con Exito';
			echo "<script> setInterval(window.location='system.php?page=listar_usuarios',3000);</script>";
		}else{
			$validarUsuario= $usuario->validarUsuario($conexion);
			$resultadoUsuario=$conexion->getRecords($validarUsuario);
			if ($resultadoUsuario['cantidad']==0){
				$usuario->updateUsuario( $conexion );
				$conexion->close();
				mysqli_free_result($validarUsuario);
				$messages[]='Usuario Editado Con Exito';
				echo "<script> setInterval(window.location='system.php?page=listar_usuarios',3000);</script>";
			}else{
				$errors[]='nombre de usuario ya existe';
				$conexion->close();
				mysqli_free_result($validarUsuario);
			}
		}
	}

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
}
	$conexion = new Conexion ();
	$usuario = new Usuario ($_GET['id'],-1,-1,-1,-1);
	$result = $usuario->selectUsuario($conexion);
	$row=$conexion->getRecords($result);
	mysqli_free_result($result);
?>
<div class="col-md-2"></div>
<h2 class="page-header">Editar Usuario</h2>
<div id="resultado"></div>
<form id="form1" name="form1" class="form-horizontal" method="post" action="">
	<input type="hidden" id="txtIdUsuario" name="txtIdUsuario" value="<?php echo $_GET['id']; ?>" />
	<div class="form-group">
		<label class="col-xs-3 control-label">Nombre Usuario:</label>
		<div class="col-xs-5">
			<input type="text" id="txtUsuario" name="txtUsuario" value="<?php echo $row['usuario']; ?>" maxlength="50" minlength="1" autocomplete="off"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Tipo de Usuario:</label>
		<div class="col-xs-5">
			<select id="selTipoUsuario" name="selTipoUsuario">
					<option value="">--Seleccione un Usuario--</option>
					<?php 
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
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5">
			<a href="system.php?page=listar_usuarios">Cancelar</a>
			|<input type="submit" id="submit" name="submit" value="Registrar" />
		</div>
	</div>
</form>
<script type="text/javascript">
	$("#form1").submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "editar_usuario.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultado").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultado").html(datos);
					
				  }
			});
		  event.preventDefault();
		});
</script>