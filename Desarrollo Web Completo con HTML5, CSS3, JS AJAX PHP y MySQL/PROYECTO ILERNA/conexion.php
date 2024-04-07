<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "Ilerna861996"; // He tenido que poner contraseña ya que en mi Base de datos tengo credenciales
		$baseDatos = "app_sai";

		// Completar...
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);
		return $conexion;
	}


	function cerrarConexion($conexion) {
		// Completar...
		mysqli_close($conexion);
		
	}


	
?>