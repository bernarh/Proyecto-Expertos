<?php 
include("model/Medico.php");
include("model/Enfermeria.php");


if(isset($_GET['id_cita']) ){

      $conexionE = new Conexion();
      $idCita = $_GET['id_cita'];
     
     //Datos correspondientes de enfermeria a mostrar
      $enfermeria = new Enfermeria();
      $resultEn = $enfermeria->elegirDatos($conexionE,$idCita);
      $row = $conexionE->getRecords($resultEn);

      //Obtener la cita a mostrar
      $conexionF = new Conexion();
      $medico = new Medico();
      $resultF = $medico->mostrarCita($conexionF,$idCita);
      $rowCita = $conexionF->getRecords($resultF);
     
 }

//Mostrar todas las citas del medico 

$conexion = new Conexion();
$medico = new Medico();
$resultC = $medico->citaMedica($conexion);



?>


<div class="container">
  <div class="row">
    <div class="col-md-10">
    <div class="well">
      <h1>Atencion clinica</h1>
    </div>
    </div>
    
  </div>
   
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
    <div class="well">
      <table class="table table-hover">
        <tr class="success">
          <th>Paciente</th>
          <th>Asunto</th>
          <th>Medico</th>
          <th>Fecha</th>
        </tr>
      <?php while ($rowCitas = $conexion->getRecords($resultC)) {  ?>
              
        <tr>
          <td><?php echo $rowCitas['nombres']; ?></td>
          <td><?php echo $rowCitas['nombre_cita']; ?></td>
          <td><?php echo $rowCitas['nombre_medico']; ?></td>
          <td><?php echo $rowCitas['fecha'] ?></td>
          <td><a href="system.php?page=vista&id_cita=<?php echo $rowCitas['id_cita']; ?>">mostrar datos</a></td>

        </tr>
     <?php } ?>  

      </table>

      </div>
    </div>

   <?php if(isset($_GET['id_cita'])){?>

    <div id="enfermeria" class="col-md-4">
    
      <div class="well">
      <table class="table table-hover">
        <thead >
          <th class="success" colspan="2">Datos clinicos</th>
        </thead>
        <tr>
          <th>Temperatura :</th>
          <td><?php echo $row['temperatura'].' '.'°C'; ?></td>
        </tr>
        <tr>
          <th>Precion :</th>
          <td><?php echo $row['presion'].' '.'mmHg'; ?></td>
        </tr>
        <tr>
          <th>Pulso :</th>
          <td><?php echo $row['pulso'].' '.'Fr/m'; ?></td>
        </tr>
        <tr>
          <th>Talla :</th>
          <td><?php echo $row['talla'].' '.'cm'; ?></td>
        </tr>
        <tr>
          <th>Peso :</th>
          <td><?php echo $row['peso'].' '.'kg'; ?></td>
        </tr>
      </table>
      </div>
      <div>
          <a href="pages/finalizarCita.php?id_cita=<?php echo $rowCita['id_cita']; ?>" class="btn btn-success btn-sm" >Finalizar</a>

      </div>
    </div>
   <?php } ?> 
  </div>
</div>


<script type="text/javascript">



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