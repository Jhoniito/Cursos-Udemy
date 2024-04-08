<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontEnd Store</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <a href="index.html"><img class="header__logo" src="img/logo.png" alt="Logotipo"></a>
    </header>

    <h2>inicio de sesión</h2>

    <div class="contenedor sombra">
        
        <form class="formulario" action="index.php" method="post">
        <fieldset>
            <div class="formulario__campo">
                <label>usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="formulario__campo">
                <label>contraseña</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <div class="formulario__boton">
                <input class="formulario__boton" name="acceder" type="submit" value="Iniciar Sesión">
            </div>


        </fieldset>
    </form>
    </div>
	<?php
    
		include "consultas.php";
	if(isset($_POST["acceder"])){ // Si ejecuta el boton acceder con metodo post...
		$nombre = $_POST["usuario"]; // Creará la variable con el parametro que hayamos introducido en nombreUsuario
		$contraseña = $_POST["contraseña"]; // Creará la variable con el parametro que hayamos introducido en correoUsuario
		$tipoUsuario = tipoUsuario($nombre, $contraseña); // Creará otra variable cuyo valor sera el resultado de la consulta tipoUsuario
		setcookie("datosU", $tipoUsuario, time()+600); // Asignaremos a las cookies el valor de tipoUsuario durante 600 segundos
		if($tipoUsuario === "superadmin"){ // Si el resultado es superadmin...
			header("Location: superadmin.php");
        exit();
		}
		elseif($tipoUsuario === "estandar"){ //Si el resultado es autorizado...
			header("Location: estandar.php");
            exit();														  //nos indicara un link para acceder a articulos.php 
		}
		elseif($tipoUsuario === "admin"){ // Si el resultado es registrado...
			header("Location: admin.php");
            exit();
		}
		else{ // Si los datos introducidos no coinciden con ningun usuario nos indicara que no estamos registrados o bien, 
			echo "DATOS DE INGRESO ERRONEOS";// las credenciales son incorrectas

		}
	};


	?>
    <footer class="footer">
        <p class="footer__texto">SAI - Todos los derechos Reservados 2024</p>
    </footer>


</body>
</html>