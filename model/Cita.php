<?php

class Cita{

	private $id_cita;
	private $id_tipo_cita;
	private $nro_cuenta;
	private $fecha;
	private $estado;
	private $id_medico;

	function __construct($id_cita=NULL, $id_tipo_cita=NULL, $nro_cuenta=NULL, $fecha=NULL,$estado=NULL, $id_medico=NULL)
	{
		$this->id_cita=$id_cita;
		$this->id_tipo_cita=$id_tipo_cita;
		$this->nro_cuenta = $nro_cuenta;
		$this->fecha =$fecha;
		$this->estado=$estado;
		$this->id_medico =$id_medico;
	}
	 public function listarDoctores($link, $idTipoCita)
   {
   	 	return  $link->executeQuery(sprintf("SELECT M.nombre_medico, M.id_medico FROM tbl_medicos_x_tipo_cita Z 
						inner JOIN tbl_medicos M 
						on(z.id_medico= M.id_medico) 
						inner JOIN tbl_tipo_citas c
						on(z.id_tipo_cita= c.id_tipo_cita)
						where  c.id_tipo_cita=%d and c.estado=1 ",$idTipoCita));
   }

	public function insertarCita($link){

		return $link->executeNonQuery(sprintf("INSERT INTO tbl_citas(id_cita,id_tipo_cita,nro_cuenta, fecha,estado,) VALUES(%d,%d,'%s','%s',%d,%d)",$this->id_cita,$this->id_tipo_cita,$this->nro_cuenta,$this->fecha,$this->estado,$this->id_medico));
	}

  

}

?>