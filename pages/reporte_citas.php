
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/Highmaps/code/highcharts.js"></script>
<script src="js/Highmaps/code/modules/exporting.js"></script>

<?php
      $where=" ";
      if (isset($_POST["selBuscarPor"])){
        $buscarPor=$_POST['selBuscarPor'];
      }  
     

      if (isset($_POST["bd-desde"])){
        $fechaini=$_POST['bd-desde'];
        
      } 
      if (isset($_POST["bd-hasta"])){
        $fechafin=$_POST['bd-hasta'];
       }
      


    if(isset($_POST['txtBuscar']) and !empty($_POST['txtBuscar'])){  
        // vacio fecha inicial y fecha final
        if( empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==1 ){
            $where=" AND ( TC.nombre_cita like '%".$_POST['txtBuscar']."%' OR C.nro_cuenta like '%".$_POST['txtBuscar']."%' OR  M.nombre_medico like '%".$_POST['txtBuscar']."%') ";

        }else if( empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==2){
             $where=" AND TC.nombre_cita like '%".$_POST['txtBuscar']."%' ";

        }else if( empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==3){
            $where=" AND  C.nro_cuenta like '%".$_POST['txtBuscar']."%' ";

        }else if( empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==4){
                $where=" AND  M.nombre_medico like '%".$_POST['txtBuscar']."%' ";

         }else if( empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==5){
                $where=" AND  P.genero like '%".$_POST['txtBuscar']."%' ";

        // vacio fecha final
        }else if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==1 ){
            $where=" AND ( TC.nombre_cita like '%".$_POST['txtBuscar']."%' OR C.nro_cuenta like '%".$_POST['txtBuscar']."%' OR  M.nombre_medico like '%".$_POST['txtBuscar']."%') AND C.fecha>= '".$fechaini."'";

        }else if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==2){
             $where=" AND TC.nombre_cita like '%".$_POST['txtBuscar']."%' AND C.fecha>= '".$fechaini."'";

        }else if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==3){
            $where=" AND  C.nro_cuenta like '%".$_POST['txtBuscar']."%' AND C.fecha>= '".$fechaini."' ";

        }else if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==4){
                $where=" AND  M.nombre_medico like '%".$_POST['txtBuscar']."%' AND C.fecha>= '".$fechaini."'";

        }else if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==5){
                $where=" AND  P.genero like '%".$_POST['txtBuscar']."%' AND C.fecha>= '".$fechaini."'";


        // ninguna vacia
        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==1 ){
            $where=" AND ( TC.nombre_cita like '%".$_POST['txtBuscar']."%' OR C.nro_cuenta like '%".$_POST['txtBuscar']."%' OR  M.nombre_medico like '%".$_POST['txtBuscar']."%') AND fecha between '".$fechaini."' AND '".$fechafin."'";

        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==2){
             $where=" AND TC.nombre_cita like '%".$_POST['txtBuscar']."%' AND fecha between '".$fechaini."' AND '".$fechafin."'";

        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==3){
            $where=" AND  C.nro_cuenta like '%".$_POST['txtBuscar']."%' AND fecha between '".$fechaini."' AND '".$fechafin."'";

        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==4){
                $where=" AND  M.nombre_medico like '%".$_POST['txtBuscar']."%' AND fecha between '".$fechaini."' AND '".$fechafin."'";

        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) and $_POST['selBuscarPor'] ==5){
                $where=" AND  P.genero like '%".$_POST['txtBuscar']."%' AND fecha between '".$fechaini."' AND '".$fechafin."'";
        }else{}
               
    } else{
         // vacio fecha final
        if( !empty($_POST['bd-desde']) and empty($_POST['bd-hasta'])){
            $where=" AND  C.fecha>= '".$fechaini."'";
        // ninguna vacia
        }else if( !empty($_POST['bd-desde']) and !empty($_POST['bd-hasta']) ){
            $where=" AND fecha between '".$fechaini."' AND '".$fechafin."'";
        }
    }

    $limite= 0;
    $cantidad = 20;
    if (isset ( $_GET ['limite'] ))
        $limite = $_GET ['limite'];
    if(isset($_POST['selBuscarPor'])){
        $sqli="SELECT C.`id_cita`, TC.nombre_cita, C.`nro_cuenta`, `fecha`, C.estado, M.nombre_medico, CONCAT(nombres, ' ', apellidos) as nombre_paciente, P.genero FROM `tbl_citas` C
                INNER JOIN tbl_tipo_citas TC ON (TC.id_tipo_cita= C.id_tipo_cita)
                INNER JOIN tbl_medicos M ON (M.id_medico=C.id_medico)
                INNER JOIN tbl_pacientes P ON (P.nro_cuenta=C.nro_cuenta)
                WHERE C.estado=2 $where ORDER BY fecha DESC";
        
        $sqlCantidadFilas="SELECT count(*) as cantidad FROM `tbl_citas` C
                INNER JOIN tbl_tipo_citas TC ON (TC.id_tipo_cita= C.id_tipo_cita)
                INNER JOIN tbl_medicos M ON (M.id_medico=C.id_medico)
                INNER JOIN tbl_pacientes P ON (P.nro_cuenta=C.nro_cuenta)
                WHERE C.estado=2 $where ";

         $conexion = new Conexion();
         $result=$conexion->executeQuery($sqli);
         $resultFilas=$conexion->executeQuery($sqlCantidadFilas);
         $rowTotal = $conexion->getRecords($resultFilas);
         $totalFilas=$rowTotal['cantidad'];
     }
     echo EncabezadoAdministrar();
    ?>

<h2 class="page-header">Reporte de citas Diarias</h2>
	</head>
	<body>
  <!--filtros para el grafico-->
        <div  class="container row">
            <form method="POST" action="" class="form-horizontal">
                 <div class="col-md-4">
                    
                    <label class="control-label" for="txtBuscar">Buscar:</label>
                     <div class="inner-addon left-addon">
                        <i class="glyphicon glyphicon-search"></i>
                        <input type="text" name="txtBuscar" class="form-control" value="" id="txtBuscar">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="selMedico">Buscar por:</label>
                    <select name="selBuscarPor" class="form-control" value="" id="selBuscarPor">
                        <option value="1">Todo</option>
                        <option value="2">Tipo de Cita</option>
                        <option value="3">Número de cuenta</option>
                        <option value="4">Medico</option>
                        <option value="5">Genero</option>
                    </select>
                    
                </div>
                <div class="col-md-2">
                                    
                    <label class="control-label" for="bd-desde">Fecha Inicial:</label>
                    <div class="">
                        <input class="form-control" name="bd-desde" type="date" >
                        
                    </div>
                </div>

                <div class="col-md-2">

                    <label class="control-label" for="bd-hasta">Fecha Final:</label>
                    <div class="">
                        <input class="form-control" name="bd-hasta" type="date" >
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="bd-hasta">_</label>
                    <input type="submit" class="form-control" value="Buscar" />
                </div>
            </div>
            <br>
            <br>
        <?php
            if(isset($_POST['selBuscarPor'])){?>     
            <a href="javascript:descargarExcel();">Descargar a Excel</a>|<a href="javascript:graficar();">Graficar</a>
            <table  id="tblReporte" class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>N&uacute;mero de Cuenta</th>
                    <th>Nombre Paciente</th>
                    <th>Genero</th>
                    <th>Tipo de Cita</th>
                    <th>Fecha</th>
                    <th>Nombre M&eacute;dico</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $conexion->getRecords($result)) {?>
                <tr>
                    <td><?php echo $row['id_cita']; ?></td>
                    <td><?php echo $row['nro_cuenta']; ?></td>
                    <td><?php echo $row['nombre_paciente']; ?></td>
                    <td><?php echo $row['genero']; ?></td>
                    <td><?php echo $row['nombre_cita']; ?></td>
                    <td><?php echo $row['fecha']?></td>
                    <td><?php echo $row['nombre_medico'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
               <!-- <tr>
                <td>
                   <?php if (($limite - $cantidad) >= 0) {?>
                    <a href="system.php?page=reporte_citas&limite=<?php echo ($limite - $cantidad);?>">Anterior</a> |
                <?php } 
                      if(($limite * $cantidad) < $totalFilas) {?>
                    <a href="system.php?page=reporte_citas&limite=<?php echo ($limite + $cantidad);?>">Siguiente</a>
                <?php } ?>
                    
                </td>
            </tr>-->
                </table>
             <?php } ?>
        </div>

        <div id="graficaReporteDiario"></div>
           
    <script type="text/javascript">
        function descargarExcel(){
                //Creamos un Elemento Temporal en forma de enlace
                var tmpElemento = document.createElement('a');
                // obtenemos la información desde el div que lo contiene en el html
                // Obtenemos la información de la tabla
                var data_type = 'data:application/vnd.ms-excel';
                var tabla_div = document.getElementById('tblReporte');
                var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
                tmpElemento.href = data_type + ', ' + tabla_html;
                //Asignamos el nombre a nuestro EXCEL
                tmpElemento.download = 'Reporte_citas.xls';
                // Simulamos el click al elemento creado para descargarlo
                tmpElemento.click();
            }
           
           
            //graficar al presionar el boton graficar
            function graficar(){
                
                $(function () {
                    Highcharts.chart('graficaReporteDiario',{
                        title: {
                            text: 'SISTEMA CLINICA UNAH',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Grafica de Reporte Diario de Citas',
                            x: -20
                        },
                        xAxis: {
                            categories: [
                                <?php 
                                    $conexion= new Conexion();
                                    $sql= "SELECT count(*) as cantidad, Date_format(fecha,'%Y/%M/%d') as fecha_agrupada FROM `tbl_citas` C
                                        INNER JOIN tbl_tipo_citas TC ON (TC.id_tipo_cita= C.id_tipo_cita)
                                        INNER JOIN tbl_medicos M ON (M.id_medico=C.id_medico)
                                        INNER JOIN tbl_pacientes P ON (P.nro_cuenta=C.nro_cuenta)
                                        WHERE C.estado=2 $where GROUP BY fecha_agrupada";
                                    $result = mysqli_query($conexion->getConexion(),$sql);
                                    while ($registros=mysqli_fetch_array($result)) {
                                        ?>
                                        '<?php echo $registros["fecha_agrupada"] ?>',
                                        <?php
                                    }
                                    $conexion->close(); 
                                    ?>
                            ]
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidad de Citas.'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            valueSuffix: 'Citas'
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        },
                        series: [{
                            name: 'Citas',
                            data: [
                                <?php 
                                    $conexion= new Conexion();
                                    
                                    $result = mysqli_query($conexion->getConexion(),$sql);
                                    while ($registros=mysqli_fetch_array($result)) {
                                        ?>
                                         <?php echo $registros["cantidad"] ?>,
                                        <?php
                                    }
                                    $conexion->close(); 
                                    ?>
                            ]
                        }]
                    });
                });
            }
     </script>
