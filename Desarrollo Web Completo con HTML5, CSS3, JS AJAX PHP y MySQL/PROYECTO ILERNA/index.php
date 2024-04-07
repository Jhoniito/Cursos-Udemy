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
		$nombre = $_POST["nombreUsuario"]; // Creará la variable con el parametro que hayamos introducido en nombreUsuario
		$correo = $_POST["correoUsuario"]; // Creará la variable con el parametro que hayamos introducido en correoUsuario
		$tipoUsuario = tipoUsuario($nombre, $correo); // Creará otra variable cuyo valor sera el resultado de la consulta tipoUsuario
		setcookie("datosU", $tipoUsuario, time()+600); // Asignaremos a las cookies el valor de tipoUsuario durante 600 segundos
		if($tipoUsuario === "superadmin"){ // Si el resultado es superadmin...
			echo "Accede a como SUPER-ADMIN $nombre <a href='usuarios.php'>aqui</a>"; // nos indicara que lo somos y 
																					 //nos indicara un link para acceder a usuarios.php
		}
		elseif($tipoUsuario === "autorizado"){ //Si el resultado es autorizado...
			echo "$nombre AUTORIZADO accede <a href='articulos.php'>aqui</a>"; //nos indicara que lo somos y 
																			  //nos indicara un link para acceder a articulos.php 
		}
		elseif($tipoUsuario === "registrado"){ // Si el resultado es registrado...
			echo "$nombre NO ESTA AUTORIZADO"; // nos indicara que estamos no estamos autorizados 
		}
		else{ // Si los datos introducidos no coinciden con ningun usuario nos indicara que no estamos registrados o bien, 
			echo "CREDENCIALES INCORRECTAS O NO REGISTRADO";// las credenciales son incorrectas
		}
	};


	?>
    <footer class="footer">
        <p class="footer__texto">SAI - Todos los derechos Reservados 2024</p>
    </footer>


</body>
</html>