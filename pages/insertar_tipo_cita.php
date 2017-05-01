<?php
	include_once('model/TipoCita.php');
	
if(isset($_POST['tipoCita'])){
	$conexion = new Conexion();
	$id=0;

	$tipoCita = $_POST['tipoCita'];
	$estado=1;

	

	if(empty($tipoCita)){

		echo('<script>alert("Campo nombre de cita vacío")</script>');
	}else if(strlen($tipoCita)>30){

		echo('<script>alert("Campo nombre excedido ")</script>');
	}else
	{	

		$tipoCita = new TipoCita($tipoCita,$id,$estado);
		$Resultvalidar = $tipoCita->validadTipoCita($conexion);

		$valorResult = $conexion->getRecords($Resultvalidar);
		$es=$tipoCita->getEstado();
			echo('estado '.$es);
		if($valorResult['cantidad']==0){
			
			$tipoCita->insertarTipoCita($conexion);
			echo('<script>alert("Cita Registrada")</script>');
			$conexion->close();
		} 
		else
		{	
			echo('<script>alert("Exite cita con ese nombre")</script>');
			

		}
	    
	}


}

?>

<div class ="legend-margin">
		<h3>Registrar Tipo Cita</h3>

	</div>

	<div class="wrapper">
		
	<form id="f_insertP", method="post" class="form-horizontal", action="">

		<div class="form-group">
			<label class="col-xs-2 control-label">Nombre de Cita:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="tipoCita" />
			</div>	
		</div>

	
		 <div class="form-group">
		 		<div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary">Registrar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="location.href='system.php?page=administrarTcita'"> Cancelar</button>
                  </div>

	</form>

	</div>