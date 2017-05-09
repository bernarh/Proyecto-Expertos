<?php
	session_start(); 
	require_once( 'model/Conexion.php');
	$conexion = new Conexion();
	$con=$conexion->getConexion();
	$username = mysqli_real_escape_string($con,(strip_tags($_POST ['username'],ENT_QUOTES)));
	$pass = sha1(mysqli_real_escape_string($con,(strip_tags($_POST ['pass'],ENT_QUOTES))));
	if(isset($username) && isset($pass)) {
		
		$sql= mysqli_query($conexion->getConexion(),sprintf( "SELECT * FROM tbl_usuario WHERE usuario='%s' AND password='%s' AND estado_usuario=1  ",$username,$pass) );
		$array= mysqli_fetch_array( $sql);
		
		if($array['password']==$pass && $array['usuario']==$username){
			$_SESSION['id']=$array['id_usuario'];
			$_SESSION['usuario']=$array['usuario'];
			$_SESSION['id_tipo_usuario']=$array['id_tipo_usuario'];
			echo "<script>location.href='system.php?page=dashboard' </script>"; // redirigir a la pagina deseada si cumple el login
			$conexion->close();
		}else{	
			echo "<script>alert('Usuario o Contraseña incorrectos') </script>";
			echo "<script>location.href='login.php' </script>"; // redirigir al login si es incorrecto
			
			$conexion->close();
			session_destroy();
		}
			
	}else{
		header("location:../login.php");
	}	

?>