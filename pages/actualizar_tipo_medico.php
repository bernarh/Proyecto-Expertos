<?php 
include_once("Medico.php");
//include("conexion.php");



if (isset ( $_POST ['txtNombre'] )) {

$id = $_GET['id_tipo_medico'];
$nombre = $_POST['txtNombre'];

$conexion = new Conexion();
//registro a actualizar//
$tipo = new TipoMedico();
$resultEle =$tipo->listarTipoMedico($conexion);
$row = $conexion->getRecords($resultEle);

//Actualizar registro//

$tipoMedico = new TipoMedico($id,$nombre);
$tipoMedico->actualizarTipoMedico($conexion);

header("Location: system.php?page=tipo");

}
?>
	<title>Actualizar tipo de medico</title> 


<div>
	<h2>Agregue especialidad</h2>
</div>
<form class="form-horizontal" method="POST">
	<div class="form-group">
		<label class="label-control col-xs-1">Nombre:</label>
		<div class="col-xs-4">
			<input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo $row['nombre_tipo_medico']; ?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-1 col-xs-9">
			<button type="submit" class="btn btn-primary" id="btnRegistrar" name="btnRegistrar" >Registrar</button>
		</div>
	</div>
</form>
