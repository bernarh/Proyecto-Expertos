
<?php
  include('model/Enfermeria.php');


   function mostrarEnTv($idCita, $cuenta, $nombre, $sala){
  
      $conexion= new Conexion();
      $sql="INSERT INTO tbl_tv (id_cita, nro_cuenta, nombre, sala, fecha) VALUES ( $idCita, '$cuenta','$nombre','$sala',NOW())";
      $result=$conexion->executeNonQuery($sql);
      $conexion->close();
  
  }

  

  if(!isset($_SESSION)){
    session_start();
  }


  if(isset($_POST['temperatura']) && isset($_GET['id_cita'])){

    $conexion= new Conexion();
    $enfermeria= new Enfermeria($_POST['temperatura'], $_POST['presion'], $_POST['pulso'], $_POST['peso'], $_POST['talla']);
    $result=$enfermeria->insertarEnfermeria($conexion->getConexion(), $_GET['id_cita']); 
    echo "<script>alert('Agregado exitosamente');</script>";
    header("location: system.php?page=enfermeria");



    $conexion->close();

  }

  if(isset($_GET['id_cita']) ){
      $id_cita=$_GET['id_cita'];
      $conexion = new Conexion();

      $sql="SELECT * FROM tbl_citas WHERE id_cita=$id_cita";
      $resultCita=$conexion->executeQuery($sql);
      $rowCita=$conexion->getRecords($resultCita);
      $estado=$rowCita["estado"];

      if($estado==1){
        $sql="UPDATE tbl_citas SET estado=3  WHERE id_cita=$id_cita";
        $result=$conexion->executeNonQuery($sql);

        $sql="SELECT B.nro_cuenta, B.nombres, B.apellidos, B.fecha_nacimiento, B.telefono, B.genero, C.nombre_carrera FROM tbl_citas A 
          INNER JOIN tbl_pacientes B ON (A.nro_cuenta=B.nro_cuenta)
          INNER JOIN tbl_carreras C ON (B.id_carrera=C.id_carrera) WHERE A.id_cita=$id_cita";
        $result=$conexion->executeQuery($sql);

        $rowPaciente=$conexion->getRecords($result);
        $cuenta=$rowPaciente["nro_cuenta"];
        $nombre=$rowPaciente["nombres"];
        mostrarEnTv($id_cita, $cuenta,$nombre ,"Enfer.");
      }
        

        
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
        <div class="row">
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
                        $result= $conexion->executeQuery("SELECT A.id_cita, B.nro_cuenta, B.nombres, B.apellidos, 
                                                          B.fecha_nacimiento, B.telefono, B.genero, C.nombre_carrera, A.fecha FROM tbl_citas A
                                                          INNER JOIN tbl_pacientes B 
                                                          ON (A.nro_cuenta=B.nro_cuenta)
                                                          INNER JOIN tbl_carreras C 
                                                          ON (B.id_carrera=C.id_carrera)
                                                          WHERE A.estado=1  
                                                          ORDER BY A.fecha ASC LIMIT 10");



                      while ($row = $conexion->getRecords($result)) { ?>
                    <tr>
                      <td><?php echo $row["nro_cuenta"]; ?></td>
                      <td><?php echo $row["nombres"]; ?></td>
                      <td><?php echo $row["apellidos"]; ?></td>
                      <td><?php echo $row["fecha_nacimiento"]; ?></td>
                      <td><?php echo $row["telefono"]; ?></td>
                      <td><?php echo $row["genero"]; ?></td>
                      <td><?php echo $row["nombre_carrera"]; ?></td>
                      <td><a type="button" href="system.php?page=enfermeria&id_cita=<?php echo $row['id_cita']; ?>">Llamar</a></td>
                
                    </tr>
                      <?php } $conexion->close();   ?>
                  </table>
          </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
              <h1>Datos del Paciente Seleccionado</h1>
              <form class="form-horizontal">
                  <div class="form-group">
                      <label class="col-xs-3 control-label">Cuenta</label>
                      <div class="col-xs-7">
                        <input type="hidden" id="id_cita" name="" <?php echo (isset($_GET ["id_cita"])&& $estado==1) ? ' value='. $id_cita : 'value=""';  ?> />
                          <input type="text" class="form-control" name="txtCuenta" 
                           <?php echo (isset($_GET ["id_cita"])&& $estado==1) ? ' value='. $cuenta : 'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Nombre</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtNombre" <?php echo (isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $nombre :'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Apellido</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtApellido" <?php echo (isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $rowPaciente["apellidos"] : 'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Fecha Nacimiento</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtNaci" <?php echo(isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $rowPaciente["fecha_nacimiento"] : 'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Teléfono</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtTelefono" <?php echo (isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $rowPaciente["telefono"] : 'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Género</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtGenero" <?php echo (isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $rowPaciente["genero"] : 'value=""';  ?>  />
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-xs-3 control-label">Carrera</label>
                      <div class="col-xs-7">
                          <input type="text" class="form-control" name="txtCarrera" <?php echo (isset($_GET ["id_cita"]) && $estado==1) ? ' value='. $rowPaciente["nombre_carrera"] : 'value=""';  ?>  />
                      </div>
                  </div>

                   <div class="form-group">
                                <div class="col-xs-5 col-xs-offset-3">
                                    <button id="btn_espera" type="button" class="btn btn-primary" >Regresar a lista de Espera</button><br>
                                    <button id="btn_finalizar" type="button" class="btn btn-danger" >Finalizar Cita</button>
                                </div>
                            </div>

                
              </form>
      

            </div>
      
            <div class="col-lg-6">
                <h1 class="page-header">Ingrese Datos Clínicos del Estudiante</h1>
            
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
            </div>

        </div>

        
    </div>  

  </div>

</section>

<?php unset($_GET["id_cita"]);



?>


