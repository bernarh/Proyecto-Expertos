<?php

class Enfermeria{
	protected $idCita=0;
	protected $temperatura;
	protected $presion;
	protected $pulso;
	protected $peso;
	protected $talla;
	protected $estatura=0;
	protected $listaEnfermeria = array();

	function __construct($temperatura=NULL,$presion=NULL,$pulso=NULL,$peso=NULL,$talla=NULL){
		$this->temperatura=$temperatura;
		$this->presion=$presion;
		$this->pulso=$pulso;
		$this->peso=$peso;
		$this->talla=$talla;

	}

	function insertarEnfermeria($conexion, $idCita){
		return mysqli_query($conexion,sprintf("INSERT INTO tbl_enfermeria (id_cita, temperatura, presion, pulso, peso, talla) VALUES (%d, %d,%d,%d,%d,%d)",$idCita,$this->temperatura,$this->presion, $this->pulso,$this->peso,$this->talla ));
	}
	public function elegirDatos($link,$id){
		return $link->executeQuery(sprintf("SELECT * FROM tbl_enfermeria WHERE id_cita =%d",$id));
	}

}
?>