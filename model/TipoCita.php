<?php
 class TipoCita
 {
 	private $id_tipo_cita;
 	private $nombre_cita;
 	private $estado;

 	function __construct( $nombre_cita=NULL,$id_tipo_cita=NULL,$estado=NULL){
 		$this->estado=$estado;
 		$this->nombre_cita=$nombre_cita;
 		$this->id_tipo_cita=$id_tipo_cita;

 	}


 	public function listarTipoCita($link){

 		return $link ->executeQuery("SELECT id_tipo_cita, nombre_cita, estado FROM tbl_tipo_citas");

 	}

 	public function insertarTipoCita($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_tipo_citas(nombre_cita, estado) VALUES ('%s',%d)", $this->nombre_cita, $this->estado));
	}

	public function validadTipoCita($link)
	{
		return $link->executeQuery(sprintf("SELECT count(*) AS cantidad FROM tbl_tipo_citas WHERE nombre_cita='%s'",$this->nombre_cita));
	}

	public function actualizarTipoCita($link)
	{
		return $link->executeNonQuery( sprintf(
			"UPDATE tbl_tipo_citas SET nombre_cita = '%s' WHERE 
			id_tipo_cita =%d", $this->nombre_cita, $this->id_tipo_cita));
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