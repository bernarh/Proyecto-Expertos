<?php

class Enfermeria{

	protected $temperatura;
	protected $presion;
	protected $pulso;
	protected $peso;
	protected $talla;
	protected $estatura;

	function __construct($temperatura,$presion,$pulso,$peso,$talla,$estatura){
		$this->temperatura=$temperatura;
		$this->presion=$presion;
		$this->pulso=$pulso;
		$this->peso=$peso;
		$this->talla=$talla;
		$this->estatura=$estatura;

	}

	function insertarEnfermeria($conexion, $idCita){
		return mysqli_query($conexion,sprintf("INSERT INTO tbl_enfermeria (id_cita, temperatura, presion, pulso, peso, talla) VALUES (%d, %d,%d,%d,%d,%d)",$idCita,$this->temperatura,$this->presion, $this->pulso,$this->peso,$this->talla ));
	}

}
?>