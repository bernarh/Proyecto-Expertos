<?php
include("config.php");

	class conexion{
		private $conexion;
		private $config;

		function __construct()
		{
			$config= new config();
<<<<<<< HEAD
			$this->conect = new mysqli($config->getServer(),$config->getUsuario(), $config->getPass(), $config->getNombreDB());
=======
			$this->conect = new mysqli($config->getServer(), $config->getIpServer(), $config->getNombreDB(),$config->getUsuario(), $config->getPass());
>>>>>>> origin/master
			/* verificar conexión */
			if (mysqli_connect_errno()) {
    			printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
			}
		}
		
		/* retorna una conexion conexión */
		public function getConexion(){
			return $this->conect;
		}
		/* cerrar conexión */
		public function cerrarConexion(){
			mysqli_close($this->conect);
		}

		

	}


?>