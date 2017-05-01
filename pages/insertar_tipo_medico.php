<?php 
include_once("model/Medico.php");
//include("model/Conexion.php");
if (isset ( $_POST ['txtNombre'] )) {

$id = -1;
$nombre = $_POST['txtNombre'];

$conexion = new Conexion();
$tipoMedico = new TipoMedico($id,$nombre);
$tipoMedico->insertarTipoMedico($conexion);

header("Location: system.php?page=tipo");

}
?>
	<title>Insertar tipo de medico</title>

<div class="container">
<div class="row">
  <div class="col-md-10">
    <div class="well">
		<div>
			<h2 class="page-header">Ingresar categoria</h2>
		</div>
		<form id="form" class="form-horizontal" method="POST">
			<div class="form-group">
				<label class="label-control col-xs-1">Nombre:</label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre">
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-offset-1 col-xs-9">
					<button type="submit" class="btn btn-primary" id="btnRegistrar" name="btnRegistrar" >Registrar</button>
				</div>
			</div>
		</form>
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

	var validar = function(e){
		validarNombre(e);

		//alert("Numero de radios :" elementRadio);
	} ;
	formulario.addEventListener("submit",validar);

	</script>