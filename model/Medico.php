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
	private $nombreM;
	private $apellidoM;
	private $generoM;
	private $estadoM;
	private $idUsuario;
	private $idSala;
	function __construct($idM=NULL,$nombreM =NULL,$apellidoM=NULL,$generoM=NULL,$estadoM=NULL,$idUsuario=NULL,$idSala=NULL){
     $this->idM  =$idM;
     $this->nombreM= $nombreM;
     $this->apellidoM= $apellidoM;
     $this->generoM = $generoM;
     $this->estadoM= $estadoM;
     $this->idUsuario= $idUsuario;
     $this->idSala= $idSala;
	}

	public function insertarMedico($link){
		return $link->executeNonQuery(sprintf("INSERT INTO tbl_medicos(nombre_medico,apellido_medico,genero,estado,id_usuario,id_sala) VALUES('%s','%s','%s','%s',%d,%d)", $this->nombreM,$this->apellidoM,$this->generoM,$this->estadoM,$this->idUsuario,$this->idSala ));
	}
	public function actualizarMedico($link){
		
		return $link->executeNonQuery(sprintf("UPDATE tbl_medicos SET nombre_medico='%s',apellido_medico='%s',genero='%s',estado='%s',id_usuario=%d ,id_sala=%d WHERE id_medico=%d",$this->nombreM,$this->apellidoM,$this->generoM,$this->estadoM,$this->idUsuario,$this->idSala,$this->idM ));
	}
	public function eliminarMedico($link){
		return $link->executeNonQuery(sprintf("DELETE FROM tbl_medicos WHERE id_medico =%d ",$this->idM));
	}

	public function listarMedicos($link){
		return $link->executeQuery("SELECT * FROM tbl_medicos ");
	}
//lista para la tabla
	public function listaMedicos($link,$limite,$cantidad){
		return $link->executeQuery(sprintf("SELECT id_medico,  nombre_medico, apellido_medico, genero, estado, id_usuario,id_sala  FROM tbl_medicos ORDER BY id_medico DESC LIMIT %d, %d", $limite, $cantidad ));
	}
	public function cantidadMedicos($link) {
		return $link->executeQuery("SELECT count(*) FROM tbl_medicos");
	}
//buscar medico a actualizar
	public function buscarMedico($link,$id){
		return $link->executeQuery("SELECT * FROM tbl_medicos WHERE id_medico = $id");
	}

//---------------- funciones vista doctor de entrada ---
	public function citaMedica1($link) {
		return $link->executeQuery(sprintf("SELECT A.nombres , C.nombre_medico , B.fecha ,							B.id_cita
									FROM tbl_pacientes A
									INNER JOIN tbl_citas B
									ON(A.nro_cuenta = B.nro_cuenta)
									INNER JOIN tbl_medicos C
									ON(B.id_medico = C.id_medico)
									INNER JOIN tbl_tipo_citas D
									ON(B.id_tipo_cita = D.id_tipo_cita)
									/*INNER JOIN tbl_tipo_medicos E 
									ON(C.id_tipo_medico = E.id_tipo_medico)*/
									 WHERE B.estado = %d AND C.id_medico = %d",1,1 ));
	}
//funcion buena de entrad
public function citaMedicaEntrada($link,$id_medico) {
		return $link->executeQuery(sprintf("SELECT A.nro_cuenta ,A.nombres ,A.apellidos,A.fecha_nacimiento, B.nombre_carrera,C.id_tipo_cita,C.id_cita,E.nombre_sala
									FROM tbl_pacientes A
                                    INNER JOIN tbl_carreras B
                                    ON(A.id_carrera=B.id_carrera)
									INNER JOIN tbl_citas C
									ON(A.nro_cuenta = C.nro_cuenta)
                                    INNER JOIN tbl_medicos D
									ON(D.id_medico = C.id_medico)
                                    INNER JOIN tbl_salas E
									ON(E.id_sala = D.id_sala)
                                    WHERE (C.estado=%d or C.estado=%d)  AND C.id_medico=%d ORDER BY C.fecha ASC",3,4,$id_medico ));
	}

//---------------- funciones para encontrar la cita a elminar o finalizar ---


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
//para mostrar datos de enfermeria y cambiar al estado 2 y insertar en tv
	public function finalizarCita($link,$id_cita){
		return $link->executeNonQuery(sprintf("UPDATE tbl_citas SET estado = %d WHERE id_cita =%d" ,2,$id_cita));
	}

	public function estadoMostrarCita($link,$id_cita){
		return $link->executeNonQuery(sprintf("UPDATE tbl_citas SET estado = %d WHERE id_cita =%d" ,4,$id_cita));
	}

	/*public function insertarTv($link,$id_cita,$nro_cuenta,$nombre,$sala,$fecha){

		return $link->executeNonQuery(sprintf("INSERT INTO tbl_tv(id_cita,nro_cuenta,nombre, sala, fecha) VALUES(%d,'%s','%s','%s','%s')", $id_cita,$nro_cuenta,$nombre,$sala,$fecha));
	}*/

	public function insertarTv($link,$id_cita,$nro_cuenta,$nombre,$sala){

		return $link->executeNonQuery(sprintf("INSERT INTO tbl_tv(id_cita,nro_cuenta,nombre, sala, fecha) VALUES(%d,'%s','%s','%s',now())", $id_cita,$nro_cuenta,$nombre,$sala));
	}
	public function eliminardelTvCita($link,$id_cita){
		return $link->executeNonQuery(sprintf("DELETE FROM tbl_tv  WHERE id_cita =%d",$id_cita));
	}

//subconsulta para obtener las TCDisponibles
	public function mostrarTiposCitasDisponiblesA($link,$id_medico){
		return $link->executeQuery(sprintf("SELECT id_tipo_cita,nombre_cita
											FROM tbl_tipo_citas WHERE (id_tipo_cita) NOT IN 
											(
											  SELECT id_tipo_cita
											  FROM tbl_medicos_x_tipo_cita
											  WHERE id_medico= %d  
											)",$id_medico));
	}

	

///tipo de usuario -----tbl_USUARIOS-----

	public function listarUsuariosDisponibles($link){
		return $link->executeQuery(sprintf("SELECT * FROM tbl_usuario WHERE id_tipo_usuario =2 AND estado_asignado=0"));
	}
	public function listarUsuariosActualizar($link,$id_usuario){
		return $link->executeQuery(sprintf("SELECT * FROM tbl_usuario 
											WHERE id_tipo_usuario =2 
											AND 
											estado_asignado=0 
											OR
											id_usuario=%d ",$id_usuario));
	}
  ///actualizar estado de usuario----

	public function actualizarUsuario($link,$id_usuario){
		$estadoAsignado=1;
		return $link->executeNonQuery(sprintf("UPDATE tbl_usuario SET estado_asignado= '%s' WHERE id_usuario = %d",$estadoAsignado,$id_usuario ));
	}
//obtener el id del del medico para mostrar sus citas
	public function obtenerIdMedico($link,$id_usuario){
		
		return $link->executeQuery(sprintf("SELECT id_medico FROM tbl_medicos WHERE id_usuario =%d",$id_usuario));

	}

	/*public function cambiarEstadoMedico($link,$id_medico,$estado){
		if ($estado===1) {
			return$link->executeNonQuery(sprintf("UPDATE tbl_medicos SET estado = %d WHERE id_medico =%d" ,2,$id_medico));
		}else if($estado===2){
			return$link->executeNonQuery(sprintf("UPDATE tbl_medicos SET estado = %d WHERE id_medico =%d" ,1,$id_medico));
		}
		
	}*/

	//-----gama

	public function listaPacientes($link,$idM){
		return $link->executeQuery(sprintf("SELECT * FROM `tbl_citas` WHERE id_medico=%d AND estado=3", $idM));
	}
	public function cantidadPacientes($link,$idM){
		return $link->executeQuery(sprintf("SELECT count(*) FROM `tbl_citas` WHERE id_medico=%d AND estado=3", $idM));
	}

	public function listaMedicosDisponible($link,$idM,$idTipoM){
		return $link->executeQuery(sprintf("SELECT CM.id_medico FROM `tbl_medicos_x_tipo_cita` CM
											INNER JOIN tbl_medicos M ON (CM.id_medico=M.id_medico)
											WHERE M.estado=1 AND CM.id_tipo_cita=%d AND NOT CM.id_medico =%d",$idTipoM, $idM));
	}

	public function cantidadMedicosDisponible($link,$idM,$idTipoM){
		return $link->executeQuery(sprintf("SELECT count(*) FROM `tbl_medicos_x_tipo_cita` CM
											INNER JOIN tbl_medicos M ON (CM.id_medico=M.id_medico)
											WHERE M.estado=1 AND CM.id_tipo_cita=%d AND NOT CM.id_medico =%d",$idTipoM,$idM));
	}

	public function cambiarMedico($link,$idC,$idM){
		return $link->executeNonQuery(sprintf("UPDATE `tbl_citas` SET `id_medico`=%d WHERE id_cita=%d", $idM,$idC));
	}

	public function activarMedico($link,$estado,$idM){
		if ($estado==1){
			return $link->executeNonQuery(sprintf("UPDATE tbl_medicos SET estado=2 WHERE id_medico=%d", $idM));
		}else{
			return $link->executeNonQuery(sprintf("UPDATE tbl_medicos SET estado=1 WHERE id_medico=%d", $idM));
		}
	}


}

?>