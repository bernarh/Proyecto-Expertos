<?php
 class Sala
 {
 	private $id_sala;
 	private $nombre_sala;
 	private $estado_sala;

 	function __construct( $id_sala=NULL,$nombre_sala=NULL,$estado_sala=NULL){
 		$this->id_sala=$id_sala;
 		$this->nombre_sala=$nombre_sala;
 		$this->estado_sala=$estado_sala;

 	}


 	public function listarSalas($link){

 		return $link ->executeQuery("SELECT id_sala, nombre_sala, estado_sala FROM tbl_salas WHERE estado_sala=0");

 	}

 	public function insertarSala($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_salas(nombre_sala, estado_sala) VALUES ('%s',0)", $this->nombre_sala));
	}


	/*public function actualizarSala($link)
	{
		return $link->executeNonQuery( sprintf(
			"UPDATE tbl_salas SET nombre_sala = '%s' WHERE 
			id_sala =%d", $this->nombre_sala, $this->id_sala));
	}*/
	public function listarSalasActualizar($link,$id_sala){
		return $link->executeQuery(sprintf("SELECT * FROM tbl_salas 
											WHERE  estado_sala=0 
											OR
											id_sala=%d ",$id_sala));
	}

	public function actualizarEstadoSala($link,$id_sala){
		$estadoAsignado=1;
		return $link->executeNonQuery(sprintf("UPDATE tbl_salas SET estado_sala= '%s' WHERE id_sala = %d",$estadoAsignado,$id_sala ));
	}

//-----------------------------------------------------------------------




	public function validadTipoCita($link)
	{
		return $link->executeQuery(sprintf("SELECT count(*) AS cantidad FROM tbl_tipo_citas WHERE nombre_cita='%s'",$this->nombre_cita));
	}

	public function selectionTipoCita($link)
	{
		return $link->executeNonQuery(sprintf(
			"SELECT nombre_cita FROM tbl_tipo_citas WHERE id_tipo_cita=%d",$this->id_tipo_cita
			));
	}

	public function cambiarEstadoTipoCita($link, $estado)
	{
		if($estado==='1')
		return $link->executeNonQuery( sprintf(
			"UPDATE tbl_tipo_citas SET estado =2 WHERE 
			id_tipo_cita =%d",$this->id_tipo_cita));

		else 
		return $link->executeNonQuery( sprintf(
			"UPDATE tbl_tipo_citas SET estado =1 WHERE 
			id_tipo_cita =%d",$this->id_tipo_cita));

	}

	public function getNombre()
	{
		return $this->nombre_cita;
	}
	public function getId()
	{
		return $this->id_tipo_cita;
	}

	public function getEstado()
	{
		return  $this->estado;
	}


 }

?>