<!DOCTYPE html>

<?php
  include('Enfermeria.php');

  if(isset($_SESSION)){
    session_start();
  }


  if(isset($_POST['estatura'])){
    $conexion= new conexion();
    $enfermeria= new Enfermeria($_POST['temperatura'], $_POST['presion'], $_POST['pulso'], $_POST['peso'], $_POST['talla'], $_POST['estatura']);
    $result=$ensermeria->insertarEnfermeria($conexion->getConexion(), $_GET['id']); 


    $conexion->cerrarConexion();

  }


?>






<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="Clase de Industria">

  <?php echo css(); ?>


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  <title>Clínica J1-UNAH</title>
</head>

<body class="sticky-header">

<section>
<?php echo menu(); ?>
<!-- main content start-->
<div class="main-content" >

  <?php echo Encabezado(); ?>

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
                                            <input type="text" class="form-control" name="talla" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-3 control-label">Estatura</label>
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control" name="estatura" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-5 col-xs-offset-3">
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </form>

  </div>  

</div>

</section>

<?php echo scripts(); ?>
</body>
</html>