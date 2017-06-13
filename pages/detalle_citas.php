<?php 
if(isset($_POST['id_cita']) && isset($_POST['nro_cuenta']) ){
      include("../model/Conexion.php");
      include("../model/Medico.php");
      include("../model/Enfermeria.php");
      $conexionE = new Conexion();
      $idCita = $_POST['id_cita'];

      
     //Datos correspondientes de enfermeria a mostrar
      $enfermeria = new Enfermeria();
      $resultEn = $enfermeria->elegirDatos($conexionE,$idCita);
      $row = $conexionE->getRecords($resultEn);

      //insertar en tv

        $nro_cuenta=$_POST['nro_cuenta'];
        $nombre =$_POST['nombres'];
        $sala=$_POST['nombre_sala'];
        //$fecha= NOW();
        $medico = new Medico();
        //$dateTime = date_create('now')->format('Y-m-d H:i:s');
        $medico->insertarTv($conexionE,$idCita,$nro_cuenta,$nombre,$sala);

       //combiar de estado 
      $medico->estadoMostrarCita($conexionE,$idCita);
       

      //Obtener la cita a mostrar para eliminarla
      $conexionF = new Conexion();
  
      $resultF = $medico->mostrarCita($conexionF,$idCita);
      $rowCita = $conexionF->getRecords($resultF);

//echo "<script> alert ('Carrera Eliminada Con Exito');</script>";


     
 }
?>
<?php if(isset($_POST['id_cita'])){?>

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
          <th>Presión :</th>
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
          <a  href="pages/finalizarCita.php?id_cita=<?php echo $rowCita['id_cita']; ?>" class="btn btn-success btn-sm"  >Finalizar</a>

      </div>
    </div>
   <?php } ?> 