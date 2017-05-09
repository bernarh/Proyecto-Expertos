<?php
include_once('../model/Conexion.php');
include_once('../model/Cita.php');
if(isset($_POST['nro_cuenta']))
{
	 $output = '';  

	 $conexion= new Conexion();
	 $cita= new Cita();

	 $resultDetalles= $cita->detallePaciente($conexion,$_POST['nro_cuenta']);

	 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';

       while ($row =$conexion->getRecords($resultDetalles)) {

       		$output .= '  
                <tr>  
                     <td width="30%"><label>Numero de Cuenta</label></td>  
                     <td width="70%">'.$row["nro_cuenta"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Nombre</label></td>  
                     <td width="70%">'.$row["nombres"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Apellido</label></td>  
                     <td width="70%">'.$row["apellidos"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Cita</label></td>  
                     <td width="70%">'.$_POST["nombreCita"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Doctor</label></td>  
                     <td width="70%">'.$_POST["doctor"].'</td>  
                </tr> 
                 
                ';  
       	
       }
       
        $output .= "</table></div>";  
      echo $output;


}
	/*	*/


?>