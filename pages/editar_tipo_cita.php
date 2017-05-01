<?php
include_once('model/TipoCita.php');
if(isset($_POST['tipoCita'])){
	$conexion = new Conexion();
	

	$nombretipoCita = $_POST['tipoCita'];
	$id_tipo_cita = $_POST['id_tipo_cita'];
	//$estado=1;

	

	if(empty($nombretipoCita)){

		echo('<script>alert("Campo nombre de cita vacío")</script>');
	}else if(strlen($nombretipoCita)>30){

		echo('<script>alert("Campo nombre excedido ")</script>');
	}else
	{	

		$tipoC = new TipoCita($nombretipoCita,$id_tipo_cita);
		
		$nombreCita= $tipoC->selectionTipoCita($conexion);
		$valorResult = $conexion->getRecords($nombreCita);
		
		if($valorResult['nombre_cita']===$nombretipoCita){
			echo('<script>alert("Exite cita con ese nombre")</script>');
			
		} 
		else
		{	
			
			$tipoC->actualizarTipoCita($conexion);

			echo('<script>alert("Cita Editada")</script>');
			$conexion->close();
			echo "<script> window.location='system.php?page=administrarTcita';</script>";
			/*sleep(1);

			header('location:system.php?page=administrarTcita');*/

		}
	    
	}


}

?>



<div class ="legend-margin">
		<h3>Editar Tipo Cita</h3>

	</div>

	<div class="wrapper">
		
	<form id="f_insertP", method="post" class="form-horizontal", action="">

		<div class="form-group">
			<label class="col-xs-2 control-label" >Nombre de Cita:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="tipoCita" value="<?php echo $_GET['nombre_cita']?>" maxlength="30" minlength="1" autocomplete="off" />
				<input type="hidden" name="id_tipo_cita" value="<?php echo $_GET['id']?>">
			</div>	
		</div>

	
		 <div class="form-group">
		 		<div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary">Editar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="location.href='system.php?page=administrarTcita'"> Cancelar</button>
                  </div>

	</form>

	</div>