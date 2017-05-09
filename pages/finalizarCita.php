<?php

include("../model/Medico.php");
include("../model/Conexion.php");
    
     if(isset($_GET['id_cita'])){
	
        $id_cita =$_GET['id_cita'];
    
        $conexion = new Conexion();
        $medicoF = new Medico();
        $medicoF->finalizarCita($conexion,$id_cita);
       // $medicoF->eliminardelTvCita($conexion,$id_cita);

        header("Location: ../system.php?page=vista");

    } 
   //header("Location: ../system.php?page=vista");


   

    ?>