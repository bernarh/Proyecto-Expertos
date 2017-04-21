<?php
include_once ("model/Usuario.php");
include_once ("model/Conexion.php");
if (isset ( $_GET ['id'] )) {

	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$id = mysqli_real_escape_string($con,(strip_tags($_GET ['id'],ENT_QUOTES)));
	$estadoUsuario = mysqli_real_escape_string($con,(strip_tags($_GET ['estado'],ENT_QUOTES)));
	$tipoUsuario = - 1;
	$password=-1;
	$nameUsuario=-1;
	$idTipoUsuario=-1;

	$usuario = new Usuario ( $id, $nameUsuario, $tipoUsuario ,$idTipoUsuario, $password );
	$usuario->deleteUsuario($conexion,$estadoUsuario );
	$conexion->close();
	if ($estadoUsuario==='1') {
		echo "<script> alert ('Usuario Deshabilitado Con Exito');</script>";
		echo "<script> window.location='system.php?page=listar_usuarios';</script>";
	}else{
		echo "<script> alert ('Usuario Habilitado Con Exito');</script>";
		echo "<script> window.location='system.php?page=listar_usuarios';</script>";
	}
	
}
?>