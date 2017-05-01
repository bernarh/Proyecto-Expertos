<?php 

/**
* 
*/
class TipoMedico
{
	private $idTM;
	private $nombreTM;
	
	function __construct($idTM=NULL,$nombreTM =NULL)
	{
		$this->idTM = $idTM;
		$this->nombreTM =$nombreTM;
	}

	public function insertarTipoMedico($link){
		return $link->executeNonQuery(sprintf("INSERT INTO tbl_tipo_medicos(nombre_tipo_medico) VALUES('%s')",$this->nombreTM ));
	}
	public function actualizarTipoMedico($link){
		return $link->executeNonQuery(sprintf("UPDATE tbl_tipo_medicos SET nombre_tipo_medico ='%s' WHERE id_tipo_medico=%d",$this->nombreTM,$this->idTM ));
	}
	public function eliminarTipoMedico($link){
		return $link->executeNonQuery(sprintf("DELETE FROM tbl_tipo_medicos WHERE id_tipo_medico =%d",$this->idTM));
	}
	public function listarTipoMedicos($link){
		return $link->executeQuery("SELECT *FROM tbl_tipo_medicos");
	}

}

class Medico{
	private $idM;
	private $idTipoM;
	private $nombreM;
	private $generoM;
	private $estadoM;

	function __construct($idM=NULL,$idTipoM=NULL,$nombreM =NULL,$generoM=NULL,$estadoM=NULL){
     $this->idM  =$idM;
     $this->idTipoM = $idTipoM;
     $this->nombreM= $nombreM;
     $this->generoM = $generoM;
     $this->estadoM= $estadoM;
	}

	public function insertarMedico($link){
		return $link->executeNonQuery(sprintf("INSERT INTO tbl_medicos(id_tipo_medico,nombre_medico,genero,estado) VALUES(%d,'%s','%s','%s')",$this->idTipoM, $this->nombreM,$this->generoM,$this->estadoM ));
	}
	public function actualizarMedico($link){
		return $link->executeNonQuery(sprintf("UPDATE tbl_medicos SET id_tipo_medico =%d,nombre_medico='%s',genero='%s',estado='%s' WHERE id_medico=%d",$this->idTipoM,$this->nombreM,$this->generoM,$this->estadoM,$this->idM ));
	}
	public function eliminarMedico($link){
		return $link->executeNonQuery(sprintf("DELETE FROM tbl_medicos WHERE id_medico =%d ",$this->idM));
	}

	public function listarMedicos($link){
		return $link->executeQuery("SELECT * FROM tbl_medicos ");
	}

	public function listaMedicos($link,$limite,$cantidad){
		return $link->executeQuery(sprintf("SELECT M.id_medico, M.id_tipo_medico, M.nombre_medico, M.genero, M.estado, TM.nombre_tipo_medico FROM tbl_medicos M INNER JOIN tbl_tipo_medicos TM ON(M.id_tipo_medico=TM.id_tipo_medico) ORDER BY M.id_medico DESC LIMIT %d, %d", $limite, $cantidad ));
	}
	public function cantidadMedicos($link) {
		return $link->executeQuery("SELECT count(*) FROM tbl_medicos");
	}

	public function buscarMedico($link,$id){
		return $link->executeQuery("SELECT * FROM tbl_medicos WHERE id_medico = $id");
	}
	public function citaMedica($link) {
		return $link->executeQuery(sprintf("SELECT A.nombres , D.nombre_cita , C.nombre_medico , B.fecha ,							B.id_cita
									FROM tbl_pacientes A
									INNER JOIN tbl_citas B
									ON(A.nro_cuenta = B.nro_cuenta)
									INNER JOIN tbl_medicos C
									ON(B.id_medico = C.id_medico)
									INNER JOIN tbl_tipo_citas D
									ON(B.id_tipo_cita = D.id_tipo_cita) WHERE B.estado = %d",1 ));
	}

	public function mostrarCita($link,$id_cita) {
		return $link->executeQuery(sprintf("SELECT A.nombres , D.nombre_cita , C.nombre_medico , B.fecha ,							B.id_cita,B.estado
									FROM tbl_pacientes A
									INNER JOIN tbl_citas B
									ON(A.nro_cuenta = B.nro_cuenta)
									INNER JOIN tbl_medicos C
									ON(B.id_medico = C.id_medico)
									INNER JOIN tbl_tipo_citas D
									ON(B.id_tipo_cita = D.id_tipo_cita) WHERE B.id_cita = %d",$id_cita ));
	}

	public function finalizarCita($link,$id_cita){
		return$link->executeNonQuery(sprintf("UPDATE tbl_citas SET estado = %d WHERE id_cita =%d" ,2,$id_cita));
	}


}

?>