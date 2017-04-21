
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
     
     echo ($_POST['id_carrera']);
     $conexion= new Conexion();
    $paciente= new Paciente($nro_cuenta,$nombres,$apellidos,$fecha_nacimiento,$telefono,$genero,$carrera,$estado );
    $paciente->insertarPaciente($conexion); 

    


  }
  $conexion= new Conexion();
  $carrera = new Carrera();


  

    //$carrera->listasCarreras($conexion);

    
    $restulFacultades = $carrera->listasFacultades($conexion);
    
?>
	<div class ="legend-margin">
		<h3>Ingrese sus Datos</h3>

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
			<label class="col-xs-2 control-label">Nombre:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="nombres"/>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Apellidos:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="apellidos"/>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Fecha de Nacimiento:</label>
			<div class="col-xs-4">
				<input type="date" class="form-control" name="fecha_nacimiento"/>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Telefono:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="telefono"/>
			</div>	
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Genero:</label>
			<div class="col-xs-1">
				<label class="radio-inline">
					<input type="radio"  name="genero" value="M" />Masculino 
				</label>
			</div>	

			<div class="col-xs-1">
				 <label class="radio-inline">
				 	<input type="radio"  name="genero" value="F" />Femenino
				 </label>	
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-2 control-label">Facultad:</label>
			<div class="col-xs-4">
				<select id="id_facultad" name="id_facultad">
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
                           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  </div>

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





