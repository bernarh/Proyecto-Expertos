<?php
	session_start(); 

	include 'conexion.php';
	require_once( 'conexion.php');
	$conexion = new Conexion();
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	if(isset($username) && isset($pass)) {
	
		$sql= mysqli_query($conexion->getConexion(), "SELECT * FROM TBL_USUARIO WHERE usuario='$username' AND password='$pass' " );
		$array= mysqli_fetch_array( $sql);
		
		if($array['password']==$pass && $array['usuario']==$username){
			$_SESSION['id']=$array['id_usuario'];
			$_SESSION['usuario']=$array['usuario'];
			echo "<script>location.href='system.php?page=enfermeria' </script>"; // redirigir a la pagina deseada si cumple el login
			$conexion->cerrarConexion();
		}else{	
			echo "<script>location.href='../index.php' </script>"; // redirigir al login si es incorrecto
			echo "<script>alert('Usuario o Contraseña incorrectos') </script>";
			$conexion->cerrarConexion();
			session_destroy();
		}
			
	}else{
		header("location:../index.php");
	}	

?>