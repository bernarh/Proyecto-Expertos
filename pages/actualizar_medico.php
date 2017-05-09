<?php
include("model/Medico.php");
include("model/Medicos_x_tipoCita.php");
include("model/TipoCita.php");
include("model/sala.php");

//Codigo para  actualizar medico

if (isset($_POST['txtNombre'])&&isset($_POST['listaTC'])){
	

	try {
		$link= new Conexion();
		$conexion = $link->getConexion();
		mysqli_begin_transaction ( $conexion );
		
		
		$id_medico=$_GET['id_medico'];
		$nombre =$_POST['txtNombre'];
		$apellido =$_POST['txtApellido'];
		$genero =$_POST['genero'];
		$estado =$_GET['estado'];
		$idUsuario =$_POST['usuario'];
		$id_sala =$_GET['id_sala'];
		//echo "sala :".$_POST['id_sala'];

		$medicoA = new Medico($id_medico,$nombre,$apellido,$genero,$estado,$idUsuario,$id_sala);

		$medicoA->actualizarMedico($link);

		$arregloCitasMedico = $_POST ["listaTC"];
	
		//print_r ( $arregloTags );

		$Medico_x_tipoCita = new  Medico_x_tipoCita();
		$Medico_x_tipoCita->eliminarTipoMxC($link,$id_medico);

		
		foreach ( $arregloCitasMedico as &$value ){
			
			$resultMedico_Cita = $Medico_x_tipoCita->insertarMedico_x_tipoCita($link,$id_medico,$value);
		}
		

		mysqli_commit ( $conexion );
		
	} catch ( Exception $e ) {
		mysqli_rollBack ( $conexion );
		echo "Failed: " . $e->getMessage ();
	}

	header("Location: system.php?page=listamedicos");
	
}

//Codigo para obtener el medico a actualizar
$id= $_GET['id_medico'];

$conexion = new Conexion();
$medico = new Medico();
$resultM = $medico->buscarMedico($conexion,$id);
$rowM = $conexion->getRecords($resultM);

//Codigo para obtener el usuario seleccionado y los diponibles por si desea cambiarlo
$id_usuario=$_GET['id_usuario'];
//echo "usuario :".$_GET['id_usuario'];

$medico=new Medico();
$resultUsua=$medico->listarUsuariosActualizar($conexion,$id_usuario);

//Codigo para obtener la sala seleccionada y los diponibles por si desea cambiarlo
$id_sala=$_GET['id_sala'];
//echo "sala ".$_GET['id_sala'];
$sala = new  Sala();
$resultSala = $sala->listarSalasActualizar($conexion,$id_sala);

//obtener categorias de citas disponibles
$resutlCDisp=$medico->mostrarTiposCitasDisponiblesA($conexion,$id);

//Codigo para obtener las categoria seleccionadas
$medico_x_cita = new Medico_x_tipoCita();
$resultMxC= $medico_x_cita->listarMedico_x_tipoCita($conexion,$id);
//$cantidadTxC =$conexion->getNumRows($resultMxC);

//Codigo para obtener las todas las categorias 
//$tipoCita = new TipoCita();
//$resultC = $tipoCita->listarTipoCita($conexion);



//$cantidadTC =$conexion->getNumRows($resultC);

//Codigo para obtener las categorias disponibles
//$resultCA= $medico_x_cita->listarMedico_x_tipoCitaUnico($conexion,$id);
//$cantidadC =$conexion->getNumRows($resultCA);



//$resultado=array_diff($arrayC, $arrayCA);
//print_r($resultado);





?>

<title>Actualizar medico</title>

<div class="container">
<div class="row">
  <div class="col-md-10">
    <div class="well">
		<div class="col-md-3"></div>
		<h2 class="page-header">Actualizar medico</h2>

	  <div class="card-content ">
		<form id="form" class="form-horizontal" method="POST">
		  
			<div class="form-group">
				<label class="control-label col-xs-3">Nombre:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo $rowM['nombre_medico'] ?>" placeholder="Nombre">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Apellido:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido" value="<?php echo $rowM['apellido_medico'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Genero:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio"  id="generoM" name="genero"  value="M" required <?php if($rowM['genero']=="M"){ echo "checked"; }?>>Masculino
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" id="generoF" name="genero" required <?php if($rowM['genero']=="F"){ echo "checked"; }?> value="F">Femenino
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Elija un usuario:</label>
				<div class="col-xs-5">
					<select  name="usuario" id="usuario"  class="form-control" > 
						<?php
							while($rowUsu = $conexion->getRecords($resultUsua)){ ?> 

								<option value="<?php echo $rowUsu['id_usuario']; ?>" <?php if($rowUsu['id_usuario']==$rowM['id_usuario']){echo "selected";} ?> ><?php echo $rowUsu['usuario'];?></option>

								<?php	} ?>
					</select>
				</div>

			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Elija una sala:</label>
				<div class="col-xs-5">
					<select  name="sala" id="sala"  class="form-control" > 
						<?php
							while($rowSalas = $conexion->getRecords($resultSala)){ ?> 
								<option value="<?php echo $rowSalas['id_sala'];?>" <?php if($rowSalas['id_sala']==$rowM['id_sala']){echo "selected";} ?>><?php echo $rowSalas['nombre_sala'];?></option>
								<?php	} ?>
								
					</select>
				</div>

			</div>

			<!-- SELECTS LISTAS -->

			<div class="row form-group ">

		   		<label class="control-label col-xs-3">Citas que atendera :</label>
			
				<div class="col-xs-3 ">
					<select id="listTCDisponible" name="listTCDisponible" class="form-control" multiple="multiple">
				<?php 
				while($rowsCDisp= $conexion->getRecords($resutlCDisp)) { ?>
						<option value="<?php echo $rowsCDisp['id_tipo_cita'] ?>"  ><?php echo $rowsCDisp['nombre_cita']; ?></option>      
   			<?php     
   				 	//mysqli_data_seek($rowCA, 0);
   				 }	?>
					</select>
				</div>
				<div class="col-xs-1 form-group">
				
					<div class="col-xs-1">
		                	<button id="btnAgregar" class=""><span  class="glyphicon glyphicon-chevron-right"></span></button>
		                <br/>
		            </div>
	            	
	            	<div class="col-xs-1">
		               		 <button id="btnQuitar" class=""><span class="glyphicon glyphicon-chevron-left"></span></button>
		            </div>
		            
            	</div>


			<!--divicion de tags 
			<label class="control-label col-xs-3">Tipo de medico :</label>-->
			
				
				<div class="col-xs-3">
					<select id="listaTC" name="listaTC[]" class="form-control" multiple="multiple">
					<?php while($rowMxC = $conexion->getRecords($resultMxC)) { 
						if ($rowMxC['id_medico']=$rowM['id_medico']) ?>
						
						<option value="<?php echo $rowMxC['id_tipo_cita'];?>" selected="<?php echo 'selected'; ?>"><?php echo $rowMxC['nombre_cita']; ?></option>	

							
				<?php	} ?>	
					</select>
				</div>
			
		  </div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-1">
					<input type="submit" class="btn btn-primary" id="btnActualizar" name="btnActualizar" value="Actualizar">
				</div>
				<div class="col-xs-offset-3 col-xs-1">
					<a href="system.php?page=listamedicos" class="btn btn-default btn-sm">Cancelar</a>
				</div>
			</div>
		</form>
	 </div>
	</div>
   </div>
</div>
</div>

<!-- Funciones de javascrips para validar el formulario -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script type="text/javascript">

	var formulario = document.getElementById("form");
	
	var validarNombre =function(e){
		if (formulario.txtNombre.value==0) {
			alert("Ingrese un nombre por favor");
			e.preventDefault();
		}
	};
	var validarGenero = function(e){
		if (formulario.genero[0].checked == true || formulario.genero[1].checked == true) {

		}else{
			alert("Selecione el genero por favor");
			e.preventDefault();
		}
	};
	/*var validarEstado = function(e){
		if (formulario.estado[0].checked == true|| formulario.estado[1].checked == true) {

		}else{
			alert("Asignele un estado por favor");
			e.preventDefault();
		}
	};*/

	
	var validar = function(e){
		validarNombre(e);
		validarGenero(e);
		//validarEstado(e);
	} ;
	
	formulario.addEventListener("submit",validar);


	//funciones del boton de select



	$().ready(function(){
		$("#btnAgregar").click(function(){
			return !$('#listTCDisponible option:selected').remove().appendTo('#listaTC');  
		});

		$("#btnQuitar").click(function(){
			return !$('#listaTC option:selected').remove().appendTo('#listTCDisponible');  
		});
		$("#btnActualizar").click(function() { $('#listaTC option').prop('selected', 'selected'); });
	
	
	});
	

</script>

