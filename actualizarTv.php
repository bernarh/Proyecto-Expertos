<?php include("model/Conexion.php"); ?>
<h1>
                     <table class="table table-striped" ">
                        <tr>
                            <th >Cuenta</th>
                            <th >Estudiante</th>
                            <th >Sala</th>
                        </tr>
                        <?php 
                        $conexion= new Conexion();
                        $sql="SELECT nro_cuenta, nombre, sala FROM tbl_tv ORDER BY fecha DESC LIMIT 7";
                        $result=$conexion->executeQuery($sql);
                        
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['nro_cuenta']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['sala']; ?></td>
                                                        
                        </tr>
                            <?php } $conexion->close(); ?>
                    
                </table>

</h1>

