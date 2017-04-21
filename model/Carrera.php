<?php
class Facultad {
	private $idFacultad;
	private $facultad;
	function __construct($idFacultad = NULL, $facultad = NULL) {
		$this->idFacultad = $idFacultad;
		$this->facultad = $facultad;
	}
	public function getIdFacultad(){
		return $this->idFacultad;

	}
	public function listarFacultades($link) {
		return $link->executeQuery("SELECT id_facultad, nombre_facultad FROM tbl_facultades WHERE estado=1 ORDER BY id_facultad DESC ");
	}

	public function validarFacultad($link) {
		return $link->executeQuery(sprintf ("SELECT count(*) AS cantidad FROM tbl_facultades WHERE estado=1 AND nombre_facultad='%s'",$this->facultad));
	}

	public function insertNuevaFacultad($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_facultades(nombre_facultad, estado) VALUES ('%s',1)", $this->facultad));
	}

	public function updateFacultad($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_facultades SET nombre_facultad = '%s' WHERE id_facultad = %d", $this->facultad, $this->idFacultad));
	}

	public function deleteFacultad($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_facultades SET estado = 2 WHERE id_facultad = %d", $this->idFacultad));
	}

	public function selectFacultad($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT nombre_facultad FROM tbl_facultades WHERE estado=1 AND id_facultad = %d", $this->idFacultad));
	}
	public function listasFacultades($link) {
		return $link->executeQuery("SELECT * FROM tbl_facultades; ");
	}

}

class Carrera  extends Facultad {
	private $idCarrera;
	private $nombreCarrera;
	function __construct($idCarrera = NULL, $nombreCarrera = NULL, $idFacultad = NULL, $facultad = NULL) {
		$this->idCarrera = $idCarrera;
		$this->nombreCarrera = $nombreCarrera;
		parent::__construct($idFacultad, $facultad);
	}

	public function insertNuevaCarrera($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_carreras(nombre_carrera, id_facultad, estado) VALUES ('%s', %d,1)", $this->nombreCarrera, $this->getIdFacultad()));
	}

	public function listarCarreras($link,$limite,$cantidad) {
		return $link->executeQuery(sprintf ("SELECT C.id_carrera, C.nombre_carrera, C.id_facultad, F.nombre_facultad FROM tbl_carreras C INNER JOIN tbl_facultades F ON(C.id_facultad=F.id_facultad) WHERE C.estado=1 ORDER BY C.id_carrera DESC LIMIT %d, %d", $limite, $cantidad));
	}

	public function cantidadCarreras($link) {
		return $link->executeQuery("SELECT count(*) FROM tbl_carreras WHERE estado=1");
	}

	public function validarCarrera($link) {
		return $link->executeQuery(sprintf ("SELECT count(*) AS cantidad FROM tbl_carreras WHERE estado=1 AND nombre_carrera='%s'",$this->nombreCarrera));
	}

	public function updateCarrera($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_carreras SET nombre_carrera = '%s', id_facultad = %d WHERE id_carrera = %d", $this->nombreCarrera, $this->getIdFacultad(), $this->idCarrera));
	}

	public function deleteCarrera($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_carreras SET estado = 2 WHERE id_carrera = %d", $this->idCarrera));
	}

	public function selectCarrera($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT nombre_carrera FROM tbl_carreras WHERE estado=1 AND id_carrera = %d", $this->idCarrera));
	}
	public function listasCarreras($link, $id_facultad) {
		return $link->executeQuery(sprintf("SELECT id_carrera, nombre_carrera FROM tbl_carreras WHERE id_facultad=%d and estado=1", $id_facultad));
	}
	public function listasTCarreras($link) {
		return $link->executeQuery("SELECT id_carrera, nombre_carrera FROM tbl_carreras WHERE estado=1");
	}
}
?>