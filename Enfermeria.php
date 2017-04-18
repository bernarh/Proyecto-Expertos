<?php

class Enfermeria{

<<<<<<< HEAD
	protected $temperatura;
	protected $presion;
	protected $pulso;
	protected $peso;
	protected $talla;
	protected $estatura;

	function __construct($temperatura,$presion,$pulso,$peso,$talla,$estatura){
=======
	protected $temperatura=0;
	protected $presion=0;
	protected $pulso=0;
	protected $peso=0;
	protected $talla=0;
	protected $estatura=0;

	function __contruct($temperatura,$presion,$pulso,$peso,$talla,$estatura){
>>>>>>> origin/master
		$this->temperatura=$temperatura;
		$this->presion=$presion;
		$this->pulso=$pulso;
		$this->peso=$peso;
		$this->talla=$talla;
		$this->estatura=$estatura;

	}

	function insertarEnfermeria($conexion, $idCita){
<<<<<<< HEAD
		return mysqli_query($conexion,sprintf("INSERT INTO tbl_enfermeria (id_cita, temperatura, presion, pulso, peso, talla) VALUES (%d, %d,%d,%d,%d,%d)",$idCita,$this->temperatura,$this->presion, $this->pulso,$this->peso,$this->talla ));
=======
		return mysql_query($conexion,sprintf("INSERT INTO tbl_enfermeria (id_cita, temperatura, presion, pulso, peso, talla) VALUES (%d, %d,%d,%d,%d,%d)",idCita,$this->temperatura,$this->presion, $this->pulso,$this->peso,$this->talla ));
>>>>>>> origin/master
	}

}
?>