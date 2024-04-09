<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="modulos-nav">

<header class="header"></header>

<nav class="sidebar">
    
<li><a href="/">INICIO</a></li>
<li><a href="/">INICIO</a></li>
<li><a href="/">INICIO</a></li>
<li><a href="/">INICIO</a></li>

</nav>


<main class="main">
    <form action="crearUsuarios.php" method="POST">
        <h2>Nuevo Usuario</h2>
        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Apellido</label>
        <input type="text" name="apellido" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="contraseña" required>

        <label>Rol</label>
        <select name="rol" required>
            <option value="estandar">ESTANDAR</option>
            <option value="superadmin">SUPERADMIN</option>
        </select>
        <button type="submit" name="crearUsuario">Crear Usuario</button>
    </form>

    <?php
		include "consultas.php";
        if(isset($_POST["crearUsuario"])){
            $nombre = $_POST["nombre"]; 
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $contraseña = $_POST["contraseña"]; 
            $rol = $_POST["rol"]; 
            $crearUsuario = crearUsuario($nombre,$apellido,$email,$contraseña,$rol);
            if($crearUsuario){
                echo "USUARIO CREADO";
            } else{
                echo "EL USUARIO NO HA PODIDO SER CREADO";
            }
        }

        ?>
</main>

</body>
</html>