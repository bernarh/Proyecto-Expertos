<?php 
include('../model/Conexion.php');

if(!isset($_SESSION)){
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="esp">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clínica J1 TV</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/portfolio-item.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color: #CEDCC3;">


    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <img src="../images/baner.jpg" style="height: 120px; margin-top: 30px;">
            </div>
            <div class="col-lg-3">
                <div style="text-align:right;width:400px;padding:1em 0;"> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&timezone=America%2FTegucigalpa" width="100%" height="150" frameborder="0" seamless></iframe>  </div>
            </div>
            <div>
                
            </div>
            
        </div>

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Turnos
                    <small>Lista de Pacientes</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div id="recargado" class="col-md-6">
                
              
            </div>

            <div class="col-md-6">
               
                <div class="row">
                    <video autoplay controls preload loop style="height: 400px;  ">
                        <source src="../images/spot.mp4" type="video/mp4">
                        <source src="../images/spot2.mp4" type="video/mp4">
                        <source src="../images/spot3.mp4" type="video/mp4">
                    </video>
                </div>

                 <div class="row">
                    <h3>Instrucciones</h3>
                <ul>
                    <li>Regístrate en la Tablet</li>
                    <li>Pasa al area de archivo para llenar tus datos con tu forma 03</li>
                    <li>Espera a ser llamado en el TV</li>
                    
                </ul>
                </div>
                
            </div>

        </div>
        <!-- /.row -->

        <div class="row">
            <h3> <p class="bg-primary">Horarios de atención de 8:00 am a 5:00 pm</p></h3>
           
        </div>

        <!-- Related Projects Row -->
        

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p class="pull-right"><a type="button" class="btn btn-info" href="../index.php" >Inicio</a></p>
                    <p>Copyright &copy; INGENIERÍA EN SISTEMAS - UNAH 2017 - Privacy - Terms</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script language="javascript" src="../js/jquery-1.10.2.min.js"></script>

    <script language="javascript">
        $(document).ready( function(){
            refresh();
            $('#recargado').load('../actualizarTv.php');

        });


        function refresh(){    
               setTimeout( function(){
                    $('#recargado').fadeOut('slow').load('../actualizarTv.php').fadeIn('slow');
                    refresh();
               }, 10000 );     
        }
</script>


</body>

</html>
