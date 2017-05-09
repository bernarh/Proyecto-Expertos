<?php
	include_once('model/TipoCita.php');
	include_once('model/Medico.php');
	include_once('model/Cita.php');
	include_once('model/Paciente.php');
	$conexion= new  Conexion();
	$nombreTipoCita=-1;
	$idTipoCita=-1;
	$estadoTipoCita=-1;

	$tipoCita= new TipoCita($nombreTipoCita,$idTipoCita,$estadoTipoCita);
    $resultTipoCitas=$tipoCita->listarTipoCita($conexion);

    

   if(isset($_POST['nro_cuenta']))
   {
   		$id_cita=-1;
   		$nro_cuenta=$_POST['nro_cuenta'];
   		$id_tipo_cita=$_POST['id_tipo_cita'];
   		$id_doctor=$_POST['id_doctor'];
   	    $fecha=date("Y-m-d H:i:s");
   		//$fecha=date('d-m-Y');
   		$estado =1;

   		//validar paciente 


	   	if(verificarRegistro()!=true)
	   	{
	   		echo " <script>alert('Primero debe registrarse o su cuenta esta inactiva!');</script>";
	   	}	
	   	else if (verificarCita()==true) {
	   		echo " <script>alert('Usted ya tiene una cita!');</script>";
	   	}
	   	else
	   	{
	   		$cita= new Cita($id_cita,$id_tipo_cita,$nro_cuenta,$fecha,$estado,$id_doctor);
   						$cita->insertarCita($conexion);
   					  echo " <script>alert('cita creada!');</script>";
	   	}

   }

  function verificarRegistro()
  { 
  		$conex = new Conexion();
  		$nombre=-1;
   		$apellido=-1;
   		$est=-1;
   		$fecha_nacimiento=-1;
   		$genero=-1;
   		$id_carrera=-1;
   		$cuenta=-1;
   		$telefono=-1;

   		$numerosArray= array();
   		$paciente=new Paciente($cuenta,$nombre,$apellido,$est,$fecha_nacimiento,$genero,$id_carrera,$telefono);
   		$resultBuscar= $paciente->buscarPaciente($conex);
   		while($rowBuscar=$conex->getRecords($resultBuscar))
   		{
   			$numerosArray[]=$rowBuscar['nro_cuenta'];
   			
   		}
   		foreach ($numerosArray as  $value) {
   				if($_POST['nro_cuenta']==$value){
   					
   					return true;
   				}
   			}
   			return false;

  }
  function verificarCita()
  {
	  	$e=-1;
	  	$date=-1;
	  	$id_c=-1;
	  	$id_m=-1;
	  	$id_t_c=-1;
	  	$n_cuenta=-1;
	  	$conex = new Conexion();

	  	$citasArray= array();
	  	$cita= new Cita($e,$date,$id_c,$id_m,$id_t_c,$n_cuenta);
	  	$resultCita=$cita->buscarCita($conex);
	  	while($rowCita= $conex->getRecords($resultCita))
	  	{
	  		$citasArray[]=$rowCita['nro_cuenta'];
	  	}

	  	foreach ($citasArray as $value) {
	  		if($_POST['nro_cuenta']==$value)
	  		{
	  			return true;
	  		}
	  		
	  	}return false;
	   	
	}

?>



	   
      



<div class ="legend-margin">
<fieldset>
	<legend><h1>Crear Cita</h1>
		

	</div>

	<div class="wrapper">
		
	<form  method="post" id="form1" class="form-horizontal", action="">

		<div class="form-group">
			<label class="col-xs-2 control-label">Numero de Cuenta:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" maxlength="11"  name="nro_cuenta"  id="nro_cuenta" />
			</div>	
		</div>

		
		<div class="form-group">
			<label class="col-xs-2 control-label">Tipo de Cita:</label>
			<div class="col-xs-4">
				<select id="id_tipo_cita" name="id_tipo_cita">
				<option value="" selected>--Seleccione la Cita--</option>
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
		<!--/////////////////////////////////////////////////-->
			 <div class="form-group">
		 		       <div class="col-xs-2"></div>
                         <div class="col-xs-5">
                           <button type="button" name="view"  id="<?php if (isset($_GET['nro_cuenta'])){ echo $_GET['nro_cuenta'];}?>" class="btn btn-info btn-xs view_data" >Confirmar Datos</button>
                       </div>
             </div>
                  </br>

			
		<!--////////////////////////////////////////location.href='system.php?page=dashboard'/////////-->

		 <div class="form-group">
		 		<div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary" id='bEnviar' name='bEnviar'>Registrar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="formReset()">Cancelar</button>
                  </div>
          </div>

	</form>
	</legend>
</fieldset>

</div>


<!--/////////////////////////////////////////////////-->
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detalles del Paciente</h4>  
                </div>  
                <div class="modal-body" id="paciente_detalle">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
                </div>  
           </div>  
      </div>  
 </div
<!--/////////////////////////////////////////////////-->







<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('#id_tipo_cita').change(function(){

		$('#id_tipo_cita option:selected').each(function(){

			id_tipo_cita=$(this).val();
		//	window.alert(id_tipo_cita);
			$.post("pages/AccionDoctores.php", {id_tipo_cita: id_tipo_cita}, function(data){
				$("#id_doctor").html(data);

			});
		});

	});


});
	

</script>


<script type="text/javascript">
	$("#form1").submit(function(e) {
  

     var nameField = $("input#nro_cuenta").filter(function() {
        return !$.trim(this.value).length;
    });

    if (nameField.length) {
        nameField.css("border", "1px solid red");
        alert("Ingrese su numero de cuenta!");

        return false;
    }



var stateField = $("#id_tipo_cita");

if (stateField.val() == 0) {
    stateField.css("border", "1px solid red");
    alert("Seleccione una cita!");
    return false;
}
else
{	
	var stateField1 = $('#id_doctor');
	if(stateField1.val()==0)
	{
		stateField1.css('border','1px solid red');
		alert('Seleccione un Doctor');
		return false;
	}
}

});
</script>

<script src="js/jquery.numeric.js"></script>
<script type="text/javascript">
$('input#nro_cuenta').numeric();
</script>

<!--/////////////////////////////////////////////////-->

<script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){ 
      	
			 var nro_cuenta = $("#nro_cuenta").val(); 
		
			 var nombreCita = $("#id_tipo_cita option:selected").text();
			 var doctor =$("#id_doctor option:selected").text();

	
      	$.ajax({
      		    url:"pages/AccionModal.php",  
                method:"post", 
                data:{nro_cuenta:nro_cuenta, nombreCita:nombreCita, doctor:doctor},
                success:function(data){
                		$('#paciente_detalle').html(data);
                		$('#dataModal').modal("show");
                		
                }

      	});

      	
      });  
 });  
 </script>


<!--/////////////////////////////////////////////////-->
<script type="text/javascript">
function formReset()
{
document.getElementById("form1").reset();
}
</script>