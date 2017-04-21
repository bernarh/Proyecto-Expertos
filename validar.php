<?php
	session_start(); 
	require_once( 'model/Conexion.php');
	$conexion = new Conexion();
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	if(isset($username) && isset($pass)) {
	
		$sql= mysqli_query($conexion->getConexion(), "SELECT * FROM tbl_usuario WHERE usuario='$username' AND password='$pass' AND estado_usuario=1" );
		$array= mysqli_fetch_array( $sql);
		
		if($array['password']==$pass && $array['usuario']==$username){
			$_SESSION['id']=$array['id_usuario'];
			$_SESSION['usuario']=$array['usuario'];
			echo "<script>location.href='system.php?page=dashboard' </script>"; // redirigir a la pagina deseada si cumple el login
			$conexion->close();
		}else{	
			echo "<script>alert('Usuario o Contraseña incorrectos') </script>";
			echo "<script>location.href='index.php' </script>"; // redirigir al login si es incorrecto
			
			$conexion->close();
			session_destroy();
		}
			
	}else{
		header("location:../index.php");
	}	

?>