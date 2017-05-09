<?php
if (!isset ( $_POST ['txtUsuario'] )) {
include_once ("model/Usuario.php");
}
if (isset ( $_POST ['txtUsuario'] )) {
	include_once ("../model/Conexion.php");
	include_once ("../model/Usuario.php");
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
		$usuario = new Usuario ( $id, $usuario, $tipoUsuario ,$idTipoUsuario, sha1($password) );
		$validarUsuario= $usuario->validarUsuario($conexion);
		$resultadoUsuario=$conexion->getRecords($validarUsuario);
		if ($resultadoUsuario['cantidad']==0){
			$usuario->insertNuevoUsuario ( $conexion );
			
			$conexion->close();
			mysqli_free_result($validarUsuario);
			//mensaje de insertado y redireccionando a pagina principal
			$messages[]='Usuario Insertado Con Exito';
			echo "<script> setInterval(window.location='system.php?page=listar_usuarios', 3000);</script>";
		}else{
			$errors[]='el nombre de usuario ya existe';
			$conexion->close();
			mysqli_free_result($validarUsuario);
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
if (!isset ( $_POST ['txtUsuario'] )) {
?>

<div class="col-md-2"></div>
<h2 class="page-header">Registrar Nuevo Usuario</h2>
<div id="resultado">		
</div>
<form id="form1" name="form1" method="post" action="" class="form-horizontal">
	<div class="form-group">
		<label class="col-xs-3 control-label">	Nombre Usuario:</label>
		<div class="col-xs-5">
			<input type="text" id="txtUsuario" name="txtUsuario" maxlength="50" minlength="1" autocomplete="off" required="" placeholder=" Nombre de Usuario"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Password:</label>
		<div class="col-xs-5">
			<input type="password" id="txtPassword" name="txtPassword" maxlength="16" minlength="8" autocomplete="off" required="" placeholder=" Contraseña" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Password de Nuevo:</label>
		<div class="col-xs-5">
			<input type="password" id="txtPassword2" name="txtPassword2" maxlength="16" minlength="8" autocomplete="off" required="" placeholder=" Repita Contraseña"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-xs-3 control-label">Tipo de Usuario:</label>
		<div class="col-xs-5">
			<select id="selTipoUsuario" name="selTipoUsuario" required="">
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
	
	<div class="form-group">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-5"><a href="system.php?page=listar_usuarios">Cancelar</a>
			<input type="submit" id="submit" name="submit" value="Registrar" />
		</div>
	</div>
</form>
<script src="./js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$("#form1").submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "./pages/insertar_usuario.php",
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
<?php } ?>