<?php
	class config{
		private $server;
		private $ipServer;
		private $nombreDB;
		private $usuario;
		private $pass;

		function __construct()
		{
			$this->server="localhost";
			$this->ipServer="127.0.0.1";
<<<<<<< HEAD
			$this->nombreDB="db_proyecto_clinica";
=======
			$this->nombreDB="db_conteo_votos";
>>>>>>> origin/master
			$this->usuario="root";
			$this->pass="";

		}

		function setServer($server){
			$this->server=$server;

		}

		function getServer(){
			return $this->server;
			
		}

		function setIpServer($ipServer){
			$this->ipServer=$ipServer;

		}

		function getIpServer(){
			return $this->ipServer;
			
		}

		function setNombreDB($nombreDB){
			$this->nombreDB=$nombreDB;

		}

		function getNombreDB(){
			return $this->nombreDB;
			
		}

		function setUsuario($usuario){
			$this->usuario=$usuario;

		}

		function getUsuario(){
			return $this->usuario;
			
		}

		function setPass($pass){
			$this->pass=$pass;

		}

		function getPass(){
			return $this->pass;
			
		}



		
	}


?>