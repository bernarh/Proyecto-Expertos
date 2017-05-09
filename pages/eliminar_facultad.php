<?php

include_once ("model/Carrera.php");
if (isset ( $_GET ['id'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$id = mysqli_real_escape_string($con,(strip_tags($_GET ['id'],ENT_QUOTES)));
	//->faltan los free result y cerrar conexion
    //insertando
	$facultad = new Facultad ( $id,-1);
	$facultad->deleteFacultad ( $conexion );
	$facultad->limpiarCarreras ( $conexion );
	//mensaje de insertado y redireccionando a pagina principal
	$conexion->close();
	echo "<script> alert ('Facultad Eliminada Con Exito');</script>";
	echo "<script> window.location='system.php?page=listar_facultades';</script>";	
}
?>