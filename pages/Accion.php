<?php


	include_once('../model/Carrera.php');
	include_once('../model/Conexion.php');
	$conexion = new Conexion();
	$carrera = new Carrera();
	$html='';

		$resultCarrera= $carrera->listasCarreras($conexion,$_POST['id_facultad']);
		if($resultCarrera->num_rows>0)
		{
			$html.='';

			while($row = $conexion->getRecords($resultCarrera))
				{
					$html.='<option value"'.$row['id_carrera'].'">'.$row['nombre_carrera'].'</option>';

				}

		}else{
			$html.='<option value="">No exiten carreras</option>';
		}
		

 echo $html;


?>