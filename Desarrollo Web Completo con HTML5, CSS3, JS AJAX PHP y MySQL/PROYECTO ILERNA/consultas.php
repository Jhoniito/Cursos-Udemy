<?php
require "conexion.php";


function tipoUsuario($nombre, $contraseña){
    $conexion = crearConexion();
    $rol = comprobarRol($nombre, $contraseña);
    if($rol !== false){
        switch($rol){
            case "superadmin":
                return "superadmin";
                break;
            case "estandar":
                return "estandar";
                break;
            case "admin":
                return "admin";
                break;
        }    
    }
}

function ultimaConexion($nombre,$contraseña ){
    $conexion = crearConexion();
    $querySQL = "UPDATE usuarios SET ultimaConex = NOW(), conectado = 1 
    WHERE correo = '$nombre' AND contraseña = '$contraseña'";
    mysqli_query($conexion, $querySQL);
}

function comprobarRol($nombre, $contraseña){
    $conexion = crearConexion();

    $querySQL = "SELECT nombreRol, contraseña 
    FROM usuarios 
    INNER JOIN roles ON usuarios.idRol = roles.idRol 
    WHERE usuarios.correo = '$nombre' 
    AND usuarios.contraseña = '$contraseña'";

    $resultado = mysqli_query($conexion, $querySQL);
    if($datos = mysqli_fetch_array($resultado)){

        ultimaConexion($nombre, $contraseña);
        return $datos["nombreRol"];
        
        }  else{
            return false;
        }
        
    }
//-------------------------------------------------
