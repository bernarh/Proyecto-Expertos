<?php
  include_once('model/Conexion.php');
  include_once('model/TipoCita.php');
  include_once('model/Medico.php');
  include_once('model/Cita.php');
  include_once('model/Paciente.php');
  $conexion= new  Conexion();
  $nombreTipoCita=-1;
  $idTipoCita=-1;
  $estadoTipoCita=-1;

  $tipoCita= new TipoCita($nombreTipoCita,$idTipoCita,$estadoTipoCita);
    $resultTipoCitas=$tipoCita->listarTipoCita($conexion);

    

   if(isset($_POST['nro_cuenta']))
   {
      $id_cita=-1;
      $nro_cuenta=$_POST['nro_cuenta'];
      $id_tipo_cita=$_POST['id_tipo_cita'];
      $id_doctor=$_POST['id_doctor'];
        $fecha=date("Y-m-d H:i:s");
      //$fecha=date('d-m-Y');
      $estado =1;

      //validar paciente 


      if(verificarRegistro()!=true)
      {
        echo " <script>alert('Primero debe registrarse o su cuenta esta inactiva!');</script>";
      } 
      else if (verificarCita()==true) {
        echo " <script>alert('Usted ya tiene una cita!');</script>";
      }
      else
      {
        $cita= new Cita($id_cita,$id_tipo_cita,$nro_cuenta,$fecha,$estado,$id_doctor);
              $cita->insertarCita($conexion);
              echo " <script>alert('cita creada!');</script>";
      }

   }

  function verificarRegistro()
  { 
      $conex = new Conexion();
      $nombre=-1;
      $apellido=-1;
      $est=-1;
      $fecha_nacimiento=-1;
      $genero=-1;
      $id_carrera=-1;
      $cuenta=-1;
      $telefono=-1;

      $numerosArray= array();
      $paciente=new Paciente($cuenta,$nombre,$apellido,$est,$fecha_nacimiento,$genero,$id_carrera,$telefono);
      $resultBuscar= $paciente->buscarPaciente($conex);
      while($rowBuscar=$conex->getRecords($resultBuscar))
      {
        $numerosArray[]=$rowBuscar['nro_cuenta'];
        
      }
      foreach ($numerosArray as  $value) {
          if($_POST['nro_cuenta']==$value){
            
            return true;
          }
        }
        return false;

  }
  function verificarCita()
  {
      $e=-1;
      $date=-1;
      $id_c=-1;
      $id_m=-1;
      $id_t_c=-1;
      $n_cuenta=-1;
      $conex = new Conexion();

      $citasArray= array();
      $cita= new Cita($e,$date,$id_c,$id_m,$id_t_c,$n_cuenta);
      $resultCita=$cita->buscarCita($conex);
      while($rowCita= $conex->getRecords($resultCita))
      {
        $citasArray[]=$rowCita['nro_cuenta'];
      }

      foreach ($citasArray as $value) {
        if($_POST['nro_cuenta']==$value)
        {
          return true;
        }
        
      }return false;
      
  }

?>



     
      




<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico">-->

    <title>Pagina Oficial Clinica Unah</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    
    <div class="site-wrapper"> 
      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
             
              <nav>
                <ul class="nav masthead-nav">
                  <li><a href="index.php">Inicio</a></li>
                  <li><a href="login.php">Iniciar sesi&oacute;n</a></li>
                   <li class="active"><a href="citas.php">Citas</a></li>
                  <li><a href="pages/tv.php">TV</a></li>
                </ul>
              </nav>
            </div>
          </div>
      </div>

  
   

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="images/1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
               <!--<h1>Example headline.</h1>-->
             <p id="wrapper-contenido">Bienvenidos a la clinica UNAH.</p>
              <p><a class="btn btn-lg btn-primary" href="login.php" role="button">Iniciar Sesión</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="images/2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
               <!--<h1>Another example headline.</h1>-->
              <p id="wrapper-contenido">Servicio de Consulta General y Odontologia.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Reservar cita</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="images/5.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
               <!--<h1>One more for good measure.</h1>-->
              <p id="wrapper-contenido">Sala de Espera.</p>
              <p><a class="btn btn-lg btn-primary" href="pages/tv.php" role="button">Ver TV</a></p>
            </div>
          </div>
        </div>
        
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div id= "crearcita" class="row">
          <div class ="legend-margin">
<fieldset>
  <legend><h1>Crear Cita</h1>
    

  </div>

  <div class="wrapper">
    
  <form  method="post" id="form1" class="form-horizontal", action="">

    <div class="form-group">
      <label class="col-xs-2 control-label">Numero de Cuenta:</label>
      <div class="col-xs-4">
        <input type="text" class="form-control" maxlength="11"  name="nro_cuenta"  id="nro_cuenta" />
      </div>  
    </div>

    
    <div class="form-group">
      <label class="col-xs-2 control-label">Tipo de Cita:</label>
      <div class="col-xs-4">
        <select id="id_tipo_cita" name="id_tipo_cita">
        <option value="" selected>--Seleccione la Cita--</option>
          <?php 
          while ($rowTipoCita=$conexion->getRecords($resultTipoCitas)) { ?>
            <option  value="<?php echo( $rowTipoCita['id_tipo_cita'] );?>" ><?php echo $rowTipoCita['nombre_cita']?>
              
            </option>

          <?php } ?>

        </select>
        <option></option> 
      </div>  
    </div>

    <div class="form-group">
      <label class="col-xs-2 control-label">Doctor:</label>
      <div class="col-xs-4">
        <select id="id_doctor" name="id_doctor" >
          

        </select>
      
      </div>  
    </div>
    <!--/////////////////////////////////////////////////-->
       <div class="form-group">
               <div class="col-xs-2"></div>
                         <div class="col-xs-5">
                           <button type="button" name="view"  id="<?php if (isset($_POST['nro_cuenta'])){ echo $_POST['nro_cuenta'];}?>" class="btn btn-info btn-xs view_data" >Confirmar Datos</button>
                       </div>
             </div>
                  </br>

      
    <!--////////////////////////////////////////location.href='system.php?page=dashboard'/////////-->

     <div class="form-group">
        <div class="col-xs-2"></div>
                  <div class="col-xs-5">
                           <button type="submit" class="btn btn-primary" id='bEnviar' name='bEnviar'>Registrar</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal" onClick="formReset()">Cancelar</button>
                  </div>
          </div>

  </form>
  </legend>
</fieldset>

</div>


<!--/////////////////////////////////////////////////-->
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Detalles del Paciente</h4>  
                </div>  
                <div class="modal-body" id="paciente_detalle">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
                </div>  
           </div>  
      </div>  
 </div
<!--/////////////////////////////////////////////////-->







<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

  $('#id_tipo_cita').change(function(){

    $('#id_tipo_cita option:selected').each(function(){

      id_tipo_cita=$(this).val();
    //  window.alert(id_tipo_cita);
      $.post("pages/AccionDoctores.php", {id_tipo_cita: id_tipo_cita}, function(data){
        $("#id_doctor").html(data);

      });
    });

  });


});
  

</script>


<script type="text/javascript">
  $("#form1").submit(function(e) {
  

     var nameField = $("input#nro_cuenta").filter(function() {
        return !$.trim(this.value).length;
    });

    if (nameField.length) {
        nameField.css("border", "1px solid red");
        alert("Ingrese su numero de cuenta!");

        return false;
    }



var stateField = $("#id_tipo_cita");

if (stateField.val() == 0) {
    stateField.css("border", "1px solid red");
    alert("Seleccione una cita!");
    return false;
}
else
{ 
  var stateField1 = $('#id_doctor');
  if(stateField1.val()==0)
  {
    stateField1.css('border','1px solid red');
    alert('Seleccione un Doctor');
    return false;
  }
}

});
</script>

<script src="js/jquery.numeric.js"></script>
<script type="text/javascript">
$('input#nro_cuenta').numeric();
</script>

<!--/////////////////////////////////////////////////-->

<script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){ 
        
       var nro_cuenta = $("#nro_cuenta").val(); 
       var nombreCita = $("#id_tipo_cita option:selected").text();
       var doctor =$("#id_doctor option:selected").text();


        $.ajax({
              url:"pages/AccionModal.php",  
                method:"post", 
                data:{nro_cuenta:nro_cuenta, nombreCita:nombreCita, doctor:doctor},
                success:function(data){
                    $('#paciente_detalle').html(data);
                    $('#dataModal').modal("show");
                    
                }

        });
      });  
 });  
 </script>


<!--/////////////////////////////////////////////////-->
<script type="text/javascript">
function formReset()
{
document.getElementById("form1").reset();
}
</script>      
      </div><!-- /.row -->
  </div>
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">ir hacia arriba</a></p>
        <p>&copy; 2017 INGENIERIA EN SISTEMAS - UNAH. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
