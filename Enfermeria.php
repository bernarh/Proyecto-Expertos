<?php

class Enfermeria{

	protected $temperatura=0;
	protected $presion=0;
	protected $pulso=0;
	protected $peso=0;
	protected $talla=0;
	protected $estatura=0;

	function __contruct($temperatura,$presion,$pulso,$peso,$talla,$estatura){
		$this->temperatura=$temperatura;
		$this->presion=$presion;
		$this->pulso=$pulso;
		$this->peso=$peso;
		$this->talla=$talla;
		$this->estatura=$estatura;

	}

	function insertarEnfermeria($conexion, $idCita){
		return mysql_query($conexion,sprintf("INSERT INTO tbl_enfermeria (id_cita, temperatura, presion, pulso, peso, talla) VALUES (%d, %d,%d,%d,%d,%d)",idCita,$this->temperatura,$this->presion, $this->pulso,$this->peso,$this->talla ));
	}

}
?>