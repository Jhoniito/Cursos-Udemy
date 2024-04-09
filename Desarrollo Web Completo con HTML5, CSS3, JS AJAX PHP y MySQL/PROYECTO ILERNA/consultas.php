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
                
        }    
    }
}

function ultimaConexion($nombre,$contraseña ){
    $conexion = crearConexion();
    $querySQL = "UPDATE usuariosp SET ultimaConexion = NOW()
    WHERE email = '$nombre' AND contraseña = '$contraseña'";
    mysqli_query($conexion, $querySQL);
}

function comprobarRol($nombre, $contraseña){
    $conexion = crearConexion();

    $querySQL = "SELECT rol
    FROM usuariosp 
    WHERE email = '$nombre' 
    AND contraseña = '$contraseña'";

    $resultado = mysqli_query($conexion, $querySQL);
    if($datos = mysqli_fetch_array($resultado)){

        ultimaConexion($nombre, $contraseña);
        return $datos["rol"];
        
        }  else{
            return false;
        }
        
    }
//-------------------------------------------------

function crearUsuario($nombre,$apellido,$email,$contraseña,$rol){
    $conexion = crearConexion();

    $querySQL = "INSERT INTO usuariosp (nombre, apellido, email, contraseña, rol)
    VALUES ('$nombre', '$apellido', '$email', '$contraseña', '$rol')";
    $resultado = mysqli_query($conexion, $querySQL);
    if($resultado){
        return true;
    } else{
        return false;
    }
    mysqli_close($conexion);

}

function 