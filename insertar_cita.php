<?php
include_once('model/Conexion.php');
include_once('model/Cita.php');

if(isset($_POST['nro_cuenta']))
{
	$nro_cuenta=$_POST['nro_cuenta'];
	$id_cita=$_POST['id_cita'];
	$id_tipo_cita=$_POST['id_tipo_cita'];
	$id_medico=$_POST['id_medico'];
	$fecha=$_POST['fecha'];
	$estado=$_POST['estado'];

	$conexion = new Conexion();

	$cita = new Cita($id_cita,$id_tipo_cita,$nro_cuenta,$fecha,$estado,$id_medico);

	$cita->insertarCita($conexion);

}


?>