
<?php
  include('model/Enfermeria.php');

  if(!isset($_SESSION)){
    session_start();
  }


  if(isset($_POST['temperatura'])){

    $conexion= new Conexion();
    $enfermeria= new Enfermeria($_POST['temperatura'], $_POST['presion'], $_POST['pulso'], $_POST['peso'], $_POST['talla']);
    $result=$enfermeria->insertarEnfermeria($conexion->getConexion(), $_SESSION['id']); 
    echo "<script>alert('Agregado exitosamente');</script>";



    $conexion->close();

  }


?>


<section>
<!-- main content start-->
  <div class="container-fluid " >

    <!-- page heading start-->
         <div >
         
          </div>
        <!-- page heading end-->

    <div class="wrapper">
      
            <div class="col-lg-12">
                <h1 class="page-header">Ingrese Datos Clínicos del Estudiante</h1>
            </div>
                  <!-- /.col-lg-12 -->
        <form id="loginForm" method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Temperatura</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="temperatura" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Presión</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="presion" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Pulso</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="pulso" onkeypress="return isNumberKey(event)"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Peso</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="peso" onkeypress="return isNumberKey(event)"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Talla</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="talla" onkeypress="return isNumberKey(event)"/>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                           
                        </div>
                    </div>
        </form>

        <div class="col-lg-12">
                <h1 class="page-header">Estudiantes en lista de espera para entrar a Enfermería</h1>
          </div>

          <div class="col-lg-12">
                <table class="table table-striped">
                    <tr>
                      <th>Cuenta</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Fecha de Nacimiento</th>
                      <th>Teléfono</th>
                      <th>Género</th>
                      <th>Carrera</th>
                    </tr>
                      <?php 
                        $conexion= new Conexion();
                        $result= $conexion->executeQuery("SELECT * FROM tbl_pacientes A INNER JOIN tbl_carreras B ON (A.id_carrera=B.id_carrera)");



                      while ($row = $conexion->getRecords($result)) { ?>
                    <tr>
                      <td><?php echo $row["nro_cuenta"]; ?></td>
                      <td><?php echo $row["nombres"]; ?></td>
                      <td><?php echo $row["apellidos"]; ?></td>
                      <td><?php echo $row["fecha_nacimiento"]; ?></td>
                      <td><?php echo $row["telefono"]; ?></td>
                      <td><?php echo $row["genero"]; ?></td>
                      <td><?php echo $row["nombre_carrera"]; ?></td>
                
                    </tr>
                      <?php }  ?>
                  </table>
          </div>
    </div>  

  </div>

</section>
