
<?php 

class Medico_x_tipoCita
 {
 	public static $tablename = "tbl_medicos_x_tipo_cita";

 	private $id_medico;
 	private $id_tipo_cita;
 	

 	function __construct( $id_medico=NULL,$id_tipo_cita=NULL){
 		
 		$this->id_medico=$id_medico;
 		$this->id_tipo_cita=$id_tipo_cita;

 	}


 	public function listarMedico_x_tipoCitaUnico($link,$id_medico){

 		return $link ->executeQuery(sprintf("SELECT id_medico, id_tipo_cita FROM tbl_medicos_x_tipo_cita WHERE id_medico=%d",$id_medico));
 	}

 	/*public function listarTipoCitaDispo($link,$id_cita){

 		return $link ->executeQuery(sprintf("SELECT id_tipo_cita, nombre_cita FROM tbl_tipo_citas WHERE id_tipo_cita =%d ",$id_cita));

 	}*/

 	public function insertarMedico_x_tipoCita($link,$id_medico,$id_tipo_cita) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_medicos_x_tipo_cita(id_medico, id_tipo_cita) VALUES ('%s',%d)", $id_medico,$id_tipo_cita));
	}

	public function eliminarTipoMxC($link,$id_medico){

 		return $link ->executeNonQuery(sprintf("DELETE FROM tbl_medicos_x_tipo_cita WHERE id_medico =%d ",$id_medico));

 	}

//lista de las categorias seleccionadas al actualizar
	public function listarMedico_x_tipoCita($link,$id){

 		return $link ->executeQuery(sprintf("SELECT A.id_tipo_cita, A.nombre_cita,										B.id_medico FROM 																	tbl_tipo_citas A  
 									INNER JOIN
 									tbl_medicos_x_tipo_cita B
 									ON(A.id_tipo_cita = B.id_tipo_cita)
 									WHERE  B.id_medico = %d ",$id));

 	}
 /*	
 	public function listarMedico_x_tipoCitaDisp($link,$id){

 		return $link ->executeQuery(sprintf("SELECT A.id_tipo_cita, A.nombre_cita,								B.id_medico FROM 															tbl_tipo_citas A  
 									INNER JOIN
 									tbl_medicos_x_tipo_cita B
 									ON(A.id_tipo_cita = B.id_tipo_cita)
 									WHERE  B.id_medico != %d ",$id));

 	}*/
}

?>