<?php
 include_once("model/TipoCita.php");
if(isset($_GET['id']))
{
	$conexion=new conexion();
 	$con=$conexion->getConexion();
 	$nombre_cita=-1;
 	$estadoActual=$_GET['estado'];

 	$id=mysqli_real_escape_string($con,$_GET['id']);
 
 		
 			$tipoCita= new TipoCita($nombre_cita,$id,$estadoActual);
 	$tipoCita->cambiarEstadoTipoCita($conexion, $estadoActual);
	$conexion->close();
	if ($estadoActual==='1') {
		echo "<script> alert ('Usuario Deshabilitado Con Exito');</script>";
		echo "<script> window.location='system.php?page=administrarTcita';</script>";
	}else{
		echo "<script> alert ('Usuario Habilitado Con Exito');</script>";
		echo "<script> window.location='system.php?page=administrarTcita';</script>";
	}
}
 	
 		



 	
?>