<?php

class Usuario {
	private $idUsuario;
	private $usuario;
	private $tipoUsuario;
	private $idTipoUsuario;
	private $password;

	function __construct($idUsuario = NULL, $usuario = NULL, $tipoUsuario = NULL, $idTipoUsuario = NULL,$password = NULL) {
		$this->idUsuario = $idUsuario;
		$this->usuario = $usuario;
		$this->idTipoUsuario = $idTipoUsuario;
		$this->tipoUsuario = $tipoUsuario;
		$this->password = $password;
	}
	
	public function insertNuevoUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "INSERT INTO tbl_usuario(id_tipo_usuario, usuario, password,estado_usuario,estado_asignado) VALUES (%d, '%s', '%s',1,0)", $this->idTipoUsuario, $this->usuario, $this->password));
	}
	
	public function updateUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_usuario SET usuario = '%s', id_tipo_usuario = %d WHERE id_usuario = %d", $this->usuario, $this->idTipoUsuario, $this->idUsuario));
	}

	public function updatePassUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "UPDATE tbl_usuario SET password = '%s' WHERE id_usuario = %d", $this->password, $this->idUsuario));
	}
	
	public function listarUsuarios($link,$limite,$cantidad) {
		return $link->executeQuery(sprintf ("SELECT U.id_usuario, U.id_tipo_usuario, U.usuario, U.password, TU.nombre_tipo_usuario as tipo_usuario,U.estado_usuario FROM `tbl_usuario` U INNER JOIN tbl_tipo_usuario TU on (U.id_tipo_usuario=TU.id_tipo_usuario) ORDER BY U.id_usuario DESC LIMIT %d, %d", $limite, $cantidad ));
	}

	public function cantidadUsuarios($link) {
		return $link->executeQuery("SELECT count(*) FROM `tbl_usuario`");
	}

	public function listarTiposUsuario($link) {
		return $link->executeQuery("SELECT id_tipo_usuario, nombre_tipo_usuario FROM tbl_tipo_usuario WHERE estado=1");
	}
	
	public function deleteUsuario($link, $estadoUsuario) {
		if ($estadoUsuario==='1')
			return $link->executeNonQuery ( sprintf ( "UPDATE tbl_usuario SET estado_usuario = 2 WHERE id_usuario = %d", $this->idUsuario));
		else
			return $link->executeNonQuery ( sprintf ( "UPDATE tbl_usuario SET estado_usuario = 1 WHERE id_usuario = %d", $this->idUsuario));
	}
	public function selectUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT id_usuario, id_tipo_usuario, usuario, password FROM tbl_usuario WHERE id_usuario = %d", $this->idUsuario));
	}
	public function validarUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT count(*) as cantidad FROM tbl_usuario WHERE usuario = '%s'", $this->usuario));
	}

	public function nombreUsuario($link) {
		return $link->executeNonQuery ( sprintf ( "SELECT usuario FROM tbl_usuario WHERE id_usuario = %d", $this->idUsuario));
	}
}
?>