<?php

include_once ("model/Carrera.php");
if (isset ( $_GET ['id'] )) {
	$conexion = new Conexion ();
	$con=$conexion->getConexion();
	$facultad = - 1;
	//elimina injecciones html y javascript NOTA: no se que tan desfasado estan estas funcionn
	$idCarrera = mysqli_real_escape_string($con,(strip_tags($_GET['id'],ENT_QUOTES)));
	
	

	//validacion de los campos
	if (empty($idCarrera)){
		$errors[]='error deconocido';
	}else{
		//insertando
		$carrera = new Carrera ( $idCarrera, -1, -1,-1);
		$carrera->deleteCarrera ( $conexion );
		//mensaje de insertado y redireccionando a pagina principal
		$conexion->close();
		echo "<script> alert ('Carrera Eliminada Con Exito');</script>";
		echo "<script> window.location='system.php?page=listar_carrera';</script>";
	}
	
	
}