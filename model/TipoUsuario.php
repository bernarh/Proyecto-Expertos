<?php
class TipoUsuario {
	private $idTipoUsuario;
	private $tipoUsuario;
	function __construct($idTipoUsuario = NULL, $tipoUsuario = NULL) {
		$this->idTipoUsuario = $idTipoUsuario;
		$this->tipoUsuario = $tipoUsuario;
	}
	public function getIdTipoUsuario(){
		return $this->idTipoUsuario;

	}
	public function listarTipoUsuario($link) {
		return $link->executeQuery("SELECT id_tipo_usuario, nombre_tipo_usuario FROM tbl_tipo_usuario WHERE estado=1 ORDER BY id_tipo_usuario DESC ");
	}

	public function validarTipoUsuario($link) {
		return $link->executeQuery(sprintf ("SELECT count(*) AS cantidad FROM tbl_tipo_usuario WHERE estado=1 AND nombre_tipo_usuario='%s'",$this->tipoUsuario));
	}

	public function insertNuevoTipoUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_tipo_usuario(nombre_tipo_usuario, estado) VALUES ('%s',1)", $this->tipoUsuario));
	}

	public function updateTipoUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_tipo_usuario SET nombre_tipo_usuario = '%s' WHERE id_tipo_usuario = %d", $this->tipoUsuario, $this->idTipoUsuario));
	}

	public function deleteTipoUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_tipo_usuario SET estado = 2 WHERE id_tipo_usuario = %d", $this->idTipoUsuario));
	}

	public function selectTipoUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT nombre_tipo_usuario FROM tbl_tipo_usuario WHERE estado=1 AND id_tipo_usuario = %d", $this->idTipoUsuario));
	}

} ?>