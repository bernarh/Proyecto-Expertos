
<?php
  include_once('model/Paciente.php');
  include_once('model/Carrera.php');

/*  if(isset($_SESSION))
    session_start();*/
  

  if(isset($_POST['nro_cuenta'])){

     $nro_cuenta=$_POST['nro_cuenta'];
     $nombres= $_POST['nombres'];
     $apellidos = $_POST['apellidos'];
     $fecha_nacimiento= $_POST['fecha_nacimiento'];
     $telefono= $_POST['telefono'];
     $genero= $_POST['genero'];
     $carrera= $_POST['id_carrera'];
     $estado= 1;
     
     
     $conexion= new Conexion();
    $paciente= new Paciente($nro_cuenta,$nombres,$apellidos,$fecha_nacimiento,$telefono,$genero,$carrera,$estado );

    if(verificarRegistro()){
    	echo " <script>alert('Ya existe estudiante con ese numero de cuenta!');</script>";
    }
    else{
    	 $paciente->insertarPaciente($conexion); 
    echo " <script>alert('Paciente Ingresado con exito!');</script>";

    }
   
    


  }
  $conexion= new Conexion();
  $carrera = new Carrera();


    $restulFacultades = $carrera->listasFacultades($conexion);

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

    
?>
	<div class ="legend-margin">
		<h3>Ingrese Datos del Paciente</h3>

	</div>

	<div class="wrapper">
		
	<form id="f_insertP", method="post" class="form-horizontal", action="" >

		<div class="form-group">
			<label class="col-xs-2 control-label">Numero de Cuenta:</label>
			<div class="col-xs-4">
			<input type="text" class="form-control" maxlength="11" minlength="8" name="nro_cuenta" id="nro_cuenta" />
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Nombre:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="nombres" id="nombres" />
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Apellidos:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="apellidos" id="apellidos" />
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Fecha de Nacimiento:</label>
			<div class="col-xs-4">
				<input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" />
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Telefono:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" maxlength="8" name="telefono" id="telefono" />
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Genero:</label>
			<div class="col-xs-1">
				<label class="radio-inline">
					<input type="radio"  name="genero" value="M" id="radioM" />Masculino 
				</label>
			</div>	

			<div class="col-xs-1">
				 <label class="radio-inline">
				 	<input type="radio"  name="genero" value="F" id="radioF" />Femenino
				 </label>	
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Facultad:</label>
			<div class="col-xs-4">
				<select id="id_facultad" name="id_facultad">
				<option value="">--Seleccione la Facultad--</option>
					<?php 
					while ($rowFacultad=$conexion->getRecords($restulFacultades)) { ?>
					  <option  value="<?php echo( $rowFacultad['id_facultad'] );?>" ><?php echo $rowFacultad['nombre_facultad']?>
					  	
					  </option>

					<?php } ?>

				</select>
				<option></option> 
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Carrera:</label>
			<div class="col-xs-4">
				<select id="id_carrera" name="id_carrera" >
					

				</select>
			
			</div>	
		</div>

		 <div class="form-group">
		 		<div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary">Registrar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="formReset()">Cancelar</button>
                  </div>
                  <!--location.href='system.php?page=dashboard'-->

	</form>

	</div>
<script src="js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$('#id_facultad').change(function(){

		$('#id_facultad option:selected').each(function(){

			id_facultad=$(this).val();
			$.post("pages/Accion.php", {id_facultad: id_facultad}, function(data){
				$("#id_carrera").html(data);


			});
		});
	})
});
	
</script>




<script type="text/javascript">
	$("#f_insertP").submit(function(e) {
  

     var nameField = $("input#nro_cuenta").filter(function() {
        return !$.trim(this.value).length;
    });

    if (nameField.length) {
        nameField.css("border", "1px solid red");
        alert("Ingrese su numero de cuenta!");

        return false;
    }

    //////////////////////////////////////////////

    	 var nombre = $("input#nombres").filter(function() {
        return !$.trim(this.value).length;
    });

    if (nombre.length) {
        nombre.css("border", "1px solid red");
        alert("Campo Nombres vacio!");

        return false;
    }

    	 var apellidos = $("input#apellidos").filter(function() {
        return !$.trim(this.value).length;
    });

    if (apellidos.length) {
        apellidos.css("border", "1px solid red");
        alert("Campo Apellidos vacio!");

        return false;
    }

     var fecha = $("input#fecha_nacimiento").filter(function() {
        return !$.trim(this.value).length;
    });

    if (fecha.length) {
        fecha.css("border", "1px solid red");
        alert("Campo Fecha de Nacimiento vacio!");

        return false;
    }

    var telefono = $("input#telefono").filter(function() {
        return !$.trim(this.value).length;
    });

    if (telefono.length) {
        telefono.css("border", "1px solid red");
        alert("Campo Telefono vacio!");

        return false;
    }





    /////////////////////////////////////////////


    var radios = document.getElementsByName("genero");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Seleccione el genero !");
    //return formValid;

///////////////////////////////
var stateField = $("#id_facultad");

if (stateField.val() == 0) {
    stateField.css("border", "1px solid red");
    alert("Seleccione una Facultad!");
    return false;
}
else
{	
	var stateField1 = $('#id_carrera');
	if(stateField1.val()==0)
	{
		stateField1.css('border','1px solid red');
		alert('Seleccione una Carrera');
		return false;
	}
}

});
</script>


<script src="js/jquery.numeric.js"></script>
<script type="text/javascript">
$('input#nro_cuenta').numeric();
$('input#telefono').numeric();
</script>

<script type="text/javascript">
function formReset()
{
document.getElementById("f_insertP").reset();
}
</script>


