<?php 
include("model/Medico.php");
include("model/Enfermeria.php");

//Codigo para mostrar los datos de enfermeria de la cita especifica que se esta          atendiendo





//Mostrar todas las citas del medico de entrada
$idUsuario=$_SESSION['id'];

$conexion = new Conexion();
$medico = new Medico();

$resultIdM = $medico->obtenerIdMedico($conexion,$idUsuario);
$rowIdM=$conexion->getRecords($resultIdM);
$idMedico =$rowIdM['id_medico'];
//echo "medico : ".$rowIdM['id_medico'];
//echo "Id :".$rowIdM['id_medico'];

$resultC = $medico->citaMedicaEntrada($conexion,$idMedico);
//$rowCitas = $conexion->getRecords($resultC);


?>


<title>Vista Medica</title>


<div class="container">
  <div class="row">
    <div class="col-md-10">
    <div class="well">
      <h1>Atención clinica</h1>
    </div>
    </div>
    
  </div>
   
</div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
    <div class="well">
    <!-- Tabla que contiene todas las citas de un doctor espacifico -->
    <div class="card-content table-responsive">
      <table class="table table-hover">
        <tr class="success">
          <th>No. Cuenta</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Fecha de Nacimiento</th>
          <th>Carrera</th>
        </tr>
      <?php $contador=0;
      while ($rowCitas = $conexion->getRecords($resultC)) {  $contador++; ?>
              
        <tr>
          <td><?php echo $rowCitas['nro_cuenta']; ?></td>
          <td><?php echo $rowCitas['nombres']; ?></td>
          <td><?php echo $rowCitas['apellidos']; ?></td>
          <td><?php echo $rowCitas['fecha_nacimiento'] ?></td>
          <td><?php echo $rowCitas['nombre_carrera'] ?></td>
          <td><a id="a<?php echo $contador; ?>" href="javascript:llamar(<?php echo $rowCitas['id_cita']; ?>,<?php echo $rowCitas['nro_cuenta']; ?>,'<?php echo $rowCitas['nombres']; ?>','<?php echo $contador;?>','<?php echo $rowCitas['nombre_sala']; ?>')" >llamar y mostrar</a></td>

        </tr>
     <?php } ?>  

      </table>
      </div>
      </div>
    </div>

  <!-- Tabla que contiene los datos tomados en enfermeria del paciente que se esta atendiendo -->
  <div id="mostrar_detalle"></div>
   
  </div>
</div>
<script src="./js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">

function llamar(id_cita,nro_cuenta,nombres,contador,sala){
    var element = document.getElementById('a'+contador);
    element.removeAttribute('href');
    var parametros = "id_cita="+id_cita+"&nro_cuenta="+nro_cuenta+"&nombres="+nombres+"&nombre_sala="+sala;
       $.ajax({
          type: "POST",
          url: "./pages/detalle_citas.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mostrar_detalle").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mostrar_detalle").html(datos);
            
          }
      });
      
     
    };
/* $('a.current-page').click(function() { 
  return false; 
});*/ 

 function clickAndDisable(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
     }
   }   
/*
$(document).ready(function(){

  $('#btn_finalizar').click(function(){
    var id=$('#id_cita').val();
    var confirmar= confirm("Este paciente ya no podrÃ¡ pasar con ningun mÃ©dico si finaliza esta cita. Â¿EstÃ¡ seguro que desea finalizar esta cita?");
    if(confirmar){
      $.ajax({
        url: "funciones.php",
        method: "POST",
        data: {condicion:"finalizar",
            id_cita: id},
        dataType: "text",
        success: function(data){
        
          alert("Se ha finalizado esta cita");
          window.location="system.php?page=enfermeria";
        }
      });

    }
  });
});*/

</script>

<!--
<?php //if(isset($_GET['id_cita'])){?>

SELECT A.nombres , D.nombre_cita , C.nombre_medico , B.fecha 
FROM tbl_pacientes A
INNER JOIN tbl_citas B
ON(A.nro_cuenta = B.nro_cuenta)
INNER JOIN tbl_medicos C
ON(B.id_medico = C.id_medico)
INNER JOIN tbl_tipo_citas D
ON(B.id_tipo_cita = D.id_tipo_cita);

id_cita=<?php// echo $rowCitas['id_cita']; ?>
-->