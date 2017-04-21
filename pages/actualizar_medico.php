<?php
include("model/Medico.php");

if (isset($_POST['txtNombre'])){
	# code...

$id= $_GET['id_medico'];
$tipoM =$_POST['medico'];
$nombre =$_POST['txtNombre'];
$genero =$_POST['genero'];
$estado =$_POST['estado'];

//echo "el genero es" .$_POST['genero'];
$conexion= new Conexion();

$id= $_GET['id_medico'];

$medico = new Medico($id,$tipoM,$nombre,$genero,$estado);
$medico->actualizarMedico($conexion);



//echo "el genero es" .$_POST['genero'];

header("Location: system.php?page=listamedicos");
}
$id= $_GET['id_medico'];


echo "estado :".$_GET['estado'];
$estado= $_GET['estado'];
//$genero= $rowM['genero'];

$conexion = new Conexion();

$medico = new Medico();
$resultM = $medico->buscarMedico($conexion,$id);
$rowM = $conexion->getRecords($resultM);
//echo "genero :".$rowM['genero'];

$tipoM = new TipoMedico();
$result = $tipoM->listarTipoMedicos($conexion);

?>

<div class="container">
<div class="row">
  <div class="col-md-10">
    
		<div class="col-md-3"></div>
		<h2 class="page-header">Actualizar doctor</h2>

	  <div class="card-content table-responsive">
		<form class="form-horizontal" method="POST">
			<div class="form-group">
				<label class="control-label col-xs-3">Tipo de medico :</label>
				<div class="col-xs-5">
					<select id="medico" name="medico" class="form-control">
						<?php while ($row = $conexion->getRecords($result)) { 
					echo '<option value ="'.$row['id_tipo_medico'].'"';
					if ($row['id_tipo_medico']==$rowM['id_tipo_medico'])
						echo 'selected';
					echo '>'.$row['nombre_tipo_medico'].'</option>';
					}?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Nombre:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php echo $rowM['nombre_medico']; ?>" placeholder="Nombre">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Genero:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio"  id="generoM" name="genero" required <?php if($rowM['genero']=="M"){ echo "checked"; }?> value="M"  >Masculino
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio"  name="genero" required <?php if($rowM['genero']=="F"){ echo "checked"; }?> value="F">Femenino
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Estado:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" name="estado" required <?php if($rowM['estado']=="1"){ echo "checked"; }?> value="1" >Habilitar
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" name="estado" required <?php if($rowM['estado']=="2"){ echo "checked"; } ?> value="2">Desabilitar
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
