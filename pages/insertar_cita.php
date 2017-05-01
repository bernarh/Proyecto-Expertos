<?php
	include_once('model/TipoCita.php');
	include_once('model/Medico.php');
	$conexion= new  Conexion();
	$nombreTipoCita=-1;
	$idTipoCita=-1;
	$estadoTipoCita=-1;

	$tipoCita= new TipoCita($nombreTipoCita,$idTipoCita,$estadoTipoCita);
    $resultTipoCitas=$tipoCita->listarTipoCita($conexion);

    

   if(isset($_POST['nro_cuenta']))
   {	
   		$nro_cuenta=$_POST['nro_cuenta'];
   		if(empty($nro_cuenta)){
   			echo('<script> window.alert("Numero de cuenta vacío")</script>');
   		}
   		else
   		{
   			

   		}
   }


?>




<div class ="legend-margin">
		<h1>Crear Cita</h1>

	</div>

	<div class="wrapper">
		
	<form id="f_insertP", method="post" class="form-horizontal", action="">

		<div class="form-group">
			<label class="col-xs-2 control-label">Numero de Cuenta:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="nro_cuenta" />
			</div>	
		</div>

		
		<div class="form-group">
			<label class="col-xs-2 control-label">Tipo de Cita:</label>
			<div class="col-xs-4">
				<select id="id_tipo_cita" name="id_tipo_cita">
				<option value="">--Seleccione la Cita--</option>
					<?php 
					while ($rowTipoCita=$conexion->getRecords($resultTipoCitas)) { ?>
					  <option  value="<?php echo( $rowTipoCita['id_tipo_cita'] );?>" ><?php echo $rowTipoCita['nombre_cita']?>
					  	
					  </option>

					<?php } ?>

				</select>
				<option></option> 
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Doctor:</label>
			<div class="col-xs-4">
				<select id="id_doctor" name="id_doctor" >
					

				</select>
			
			</div>	
		</div>

		 <div class="form-group">
		 		<div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary" id='id_enviar' name='id_enviar'>Registrar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  </div>

	</form>

	</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('#id_tipo_cita').change(function(){

		$('#id_tipo_cita option:selected').each(function(){

			id_tipo_cita=$(this).val();
			//window.alert(id_tipo_cita);
			$.post("pages/AccionDoctores.php", {id_tipo_cita: id_tipo_cita}, function(data){
				$("#id_doctor").html(data);


			});
		});
	});
});
	
</script>


