<?php
	include_once('../model/Cita.php');
	include_once('../model/Conexion.php');
	$conexion= new Conexion();
	$cita = new Cita();

    $html='';
    $resultDoctores = $cita->listarDoctores($conexion, $_POST['id_tipo_cita']);
	
	
  //////////////////////////////////////////////////////////////////////////////////////////
	
	$resultCCitas= $cita->cantidad_de_Citas($conexion);
	while ($rowCCita=$conexion->getRecords($resultCCitas)) {
		if($rowCCita['cant_de_citas']>=2){
			echo($rowCCita['id_medico']);

			 mysqli_data_seek ($resultDoctores,$rowCCita['id_medico'] );
		}

			
	}

  //////////////////////////////////////////////////////////////////////////////////////////
	

	//echo($id);
	if($resultDoctores->num_rows>0)
	{
		$html.=' <option value="">--Seleccione un Doctor --</option>';

		while($row=$conexion->getRecords($resultDoctores))
		{
			$html.='<option value="'.$row['id_medico'].'">'.$row['nombre_medico'].'</option>';
		}
	}
	else{
			$html.='<option value="">No exiten Medico</option>';
		}
		

 echo $html;


?>