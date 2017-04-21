<?php

include_once ("model/TipoUsuario.php");
if (isset ( $_GET ['id'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$id = mysqli_real_escape_string($con,(strip_tags($_GET ['id'],ENT_QUOTES)));
	//->faltan los free result y cerrar conexion
    //insertando
	$tipoUsuario = new TipoUsuario ( $id,-1);
	$tipoUsuario->deleteTipoUsuario ( $conexion );
	//mensaje de insertado y redireccionando a pagina principal
	echo "<script> alert ('Tipo de Usuario Eliminado Con Exito');</script>";
	echo "<script> window.location='system.php?page=listar_usuarios';</script>";
	$conexion->close();
}
?>