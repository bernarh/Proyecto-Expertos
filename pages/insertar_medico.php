<?php
include("model/Medico.php");

if (isset($_POST['txtNombre'])) {
	

$id= -1;
$tipoM =$_POST['medico'];
$nombre =$_POST['txtNombre'];
$genero =$_POST['genero'];
$estado =$_POST['estado'];


$conexion= new Conexion();
$medico = new Medico($id,$tipoM,$nombre,$genero,$estado);
$medico->insertarMedico($conexion);

header("Location: system.php?page=medico");
}

$conexion = new Conexion();
$tipoM = new TipoMedico();
$result = $tipoM->listarTipoMedicos($conexion);

?>

<div class="container">
<div class="row">
  <div class="col-md-10">
    <div class="well">
		<div class="col-md-3"></div>
		<h2 class="page-header">Registre un nuevo doctor</h2>

	  <div class="card-content table-responsive">
		<form id="form" class="form-horizontal" method="POST">
			<div class="form-group">
				<label class="control-label col-xs-3">Tipo de medico :</label>
				<div class="col-xs-5">
					<select id="medico" name="medico" class="form-control">
						<?php  while ($row =$conexion->getRecords($result)) { ?>
							
						<option value="<?php echo $row['id_tipo_medico']; ?>"><?php echo $row['nombre_tipo_medico']; ?></option>

					<?php	} ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Nombre:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Genero:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio"  id="generoM" name="genero" value="M">Masculino
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" id="generoF" name="genero" value="F">Femenino
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Estado:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" id="genero1" name="estado" value="1">Habilitar
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" id="genero2" name="estado" value="2">Desabilitar
					</label>
				</div>

			</div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-1">
					<input type="submit" class="btn btn-primary" name="btnAgregar" value="Agregar">
				</div>
			</div>
		</form>
	 </div>
	</div>
   </div>
</div>
</div>


<script type="text/javascript">
	var formulario = document.getElementById("form");
	//var elementRadio = document.getElementsByName("estado");


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
	var validarEstado = function(e){
		if (formulario.estado[0].checked == true|| formulario.estado[1].checked == true) {

		}else{
			alert("Asignele un estado por favor");
			e.preventDefault();
		}
	};

	
	var validar = function(e){
		validarNombre(e);
		validarGenero(e);
		validarEstado(e);

		//alert("Numero de radios :" elementRadio);
	} ;
	formulario.addEventListener("submit",validar);

</script>

