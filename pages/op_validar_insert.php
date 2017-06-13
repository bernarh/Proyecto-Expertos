<?php
/*$mensaje =null;

if (isset($_POST['txtNombre'])) {
	
	$nombre= htmlspecialchars($_POST["txtNombre"]);
	$apellido= htmlspecialchars($_POST["txtApellido"]);
	$nombre= htmlspecialchars($_POST["genero"]);
}*/

$nombre = $_POST["nombre"];
$apellido =$_POST["apellido"];
$generoM=$_POST["generoM"];
$generoF= $_POST["generoF"];

if(empty($nombre)){
	echo "Ingrese un nombre por favor";
}elseif (empty($apellido)) {
	echo "Ingrese un apellido por favor";
}elseif ($generoM.checked==false && $generoF.checked==false) {
	echo "Seleccione un  sexo por favor" ;
}else{
	echo "Registro con exito!!";
}

?>