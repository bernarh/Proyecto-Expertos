<?php

abstract class Config {
	protected $server = '127.0.0.1';
	protected $dataBase = 'db_clinica3';
	protected $user = 'User';
	protected $pass = 'user';
	
	protected function getServer() {
		return $this->server;
	}
	protected function getDataBase() {
		return $this->dataBase;
	}
	protected function getUser() {
		return $this->user;
	}
	protected function getPass() {
		return $this->pass;
	}
}


class Conexion extends Config {
	private $link;
	function __construct() {
		$this->connect ();
	}
	public function connect() {
		$this->link = mysqli_connect(parent::getServer(), parent::getUser(), parent::getPass());
		if (!$this->link) {
			die('No pudo conectarse: ' . mysqli_error());
		}
		if (!mysqli_select_db($this->link, parent::getDataBase())) {
			die('No pudo seleccionar la base de datos: ' . mysqli_error());
		}
	}
	public function close() {
		mysqli_close ( $this->link );
	}

	public function getConexion() {
		return $this->link;
	}

	public function executeNonQuery($command) {
		$result = mysqli_query ( $this->link, $command );
		if (mysqli_errno ( $this->link )) {
			$error = "Error: " . mysqli_error ( $this->link );
			return $error;
		} else {
			return $result;
		}
	}
	public function executeQuery($commandQuery) {
		$result = mysqli_query ( $this->link, $commandQuery );
		if (mysqli_errno ( $this->link )) {
			$error = "Error:" . mysqli_error ( $this->link );
			return $error;
		} else {
			return $result;
		}
	}
	public function getNumRows($result) {
		return mysqli_num_rows ( $result );
	}
	public function getRecords($result) {
		return mysqli_fetch_assoc ( $result );
	}
}
?>