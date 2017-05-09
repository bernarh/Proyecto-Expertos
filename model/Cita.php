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

		return $link->executeNonQuery(sprintf("INSERT INTO tbl_citas(id_tipo_cita,nro_cuenta, fecha,estado,id_medico) VALUES(%d,'%s','%s',%d,%d)",$this->id_tipo_cita,$this->nro_cuenta,$this->fecha,$this->estado,$this->id_medico));
	}

	public function buscarCita($link)
	{
		return $link->executeQuery("SELECT nro_cuenta FROM tbl_citas WHERE estado=1;");
	}


	public function cantidad_de_Citas($link)
	{
		return $link->executeQuery("SELECT COUNT(*) AS cant_de_citas, id_medico FROM tbl_citas Where estado=1 or estado=3 or estado=4
            GROUP BY id_medico;");
	}

	/*public function detallePaciente($link, $nro_cuenta)
	{
		return $link->executeQuery(sprintf("SELECT p.nro_cuenta AS Cuenta, p.nombres As Nombre, p.apellidos AS Apellido,  b.nombre_cita AS Cita , m.nombre_medico AS Doctor FROM 			tbl_citas c
					INNER JOIN tbl_tipo_citas b 
					on(c.id_tipo_cita= b.id_tipo_cita)
					INNER JOIN tbl_pacientes p 
					on(c.nro_cuenta = p.nro_cuenta)
					INNER JOIN tbl_medicos m 
					on(c.id_medico= m.id_medico) WHERE c.nro_cuenta='%s'",$nro_cuenta));
	}*/
	public function detallePaciente($link, $nro_cuenta)
	{
		return $link->executeQuery(sprintf("SELECT nro_cuenta, nombres, apellidos FROM tbl_pacientes WHERE nro_cuenta='%s'",$nro_cuenta));
	}

  

}

?>