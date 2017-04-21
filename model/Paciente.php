<?php
/**
* 
*/
class Paciente
{
	private $nro_Cuenta;
	private $nombres;
	private $apellidos;
	private $fecha_nacimiento;
	private $telefono;
	private $genero;
	private $id_carrera;
	private $estado;
	
	function __construct($nro_Cuenta=NULL,$nombres=NULL, $apellidos=NULL, $fecha_nacimiento=NULL, $telefono=NULL, $genero=NULL, $id_carrera=NULL, $estado=NULL)
	{	
		$this->nro_Cuenta=$nro_Cuenta;
		$this->nombres= $nombres;
		$this->apellidos= $apellidos;
		$this->fecha_nacimiento=$fecha_nacimiento;
		$this->telefono= $telefono;
		$this->genero= $genero;
		$this->id_carrera=$id_carrera;
		$this->estado= $estado;
		
	}

	public function listarPacientes($link)
	{
		return $link ->executeQuery("SELECT P.nro_cuenta, P.nombres, P.apellidos, P.fecha_nacimiento, P.telefono, P.genero, P.estado, C.nombre_carrera FROM  tbl_pacientes P
			inner JOIN tbl_carreras C
			on(P.id_carrera = C.id_carrera);");
	}

	public function insertarPaciente($link)
	{
		return $link->executeNonQuery(sprintf("INSERT INTO tbl_pacientes(nro_cuenta,nombres,apellidos,fecha_nacimiento,telefono,genero,id_carrera,estado)VALUES('%d','%s','%s','%s','%s','%s','%d','%d')",$this->nro_Cuenta,$this->nombres,$this->apellidos,$this->fecha_nacimiento,$this->telefono, $this->genero, $this->id_carrera, $this->estado)); 
	}

	



}

?>