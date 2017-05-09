<?php 
include('model/Conexion.php');
echo $_POST["condicion"];
if(isset($_POST["condicion"])){
  // si llega la condicion, y es igual a la condicion que necesitas para entrar ejecuta la función y devuelve el resultado
  if($_POST["condicion"] == "regresar" ){
     cambiarEstadoEspera();
     // salimos de la pagina php y devolvemos la respuesta
     exit();
  }else if($_POST["condicion"] == "finalizar" ){
     cambiarEstadoFinalizar();
     // salimos de la pagina php y devolvemos la respuesta
     exit();
  }
 }
function cambiarEstadoEspera(){
     $id_cita=$_POST['id_cita'];
     echo $id_cita;
      $conexion = new Conexion();
      $sql="UPDATE tbl_citas SET estado=1  WHERE id_cita=$id_cita";
      $result=$conexion->executeNonQuery($sql);
      $conexion->close();
  }

  function cambiarEstadoFinalizar(){
     $id_cita=$_POST['id_cita'];
      $conexion = new Conexion();
      $sql="UPDATE tbl_citas SET estado=2  WHERE id_cita=$id_cita";
      $result=$conexion->executeNonQuery($sql);
      $conexion->close();
  }
?>