<?php
	session_start(); 

	include 'conexion.php';
	require_once( 'conexion.php');
	$conexion = new Conexion();
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	if(isset($username) && isset($pass)) {
	
<<<<<<< HEAD
		$sql= mysqli_query($conexion->getConexion(), "SELECT * FROM TBL_USUARIO WHERE usuario='$username' AND password='$pass' " );
=======
		$sql= mysqli_query($conexion->getConexion(), "SELECT * FROM TBL_USUARIOS WHERE USUARIO='$username' AND PASSWORD='$pass' " );
>>>>>>> origin/master
		$array= mysqli_fetch_array( $sql);
		
		if($array['password']==$pass && $array['usuario']==$username){
			$_SESSION['id']=$array['id_usuario'];
			$_SESSION['usuario']=$array['usuario'];
<<<<<<< HEAD
			echo "<script>location.href='system.php?page=enfermeria' </script>"; // redirigir a la pagina deseada si cumple el login
			$conexion->cerrarConexion();
		}else{	
			echo "<script>location.href='../index.php' </script>"; // redirigir al login si es incorrecto
			echo "<script>alert('Usuario o Contraseña incorrectos') </script>";
			$conexion->cerrarConexion();
=======
			echo "<script>location.href='../index.php' </script>"; // redirigir a la pagina deseada si cumple el login
		}else{	
			echo "<script>location.href='../login.php' </script>"; // redirigir al login si es incorrecto
			echo "<script>alert('Usuario o Contraseña incorrectos') </script>";
>>>>>>> origin/master
			session_destroy();
		}
			
	}else{
		header("location:../index.php");
	}	

?>