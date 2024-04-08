<?php

function obtener_servicios() {
    try {
        // importar las credenciales
        require "database.php";
        // Consulta SQL
        $sql = "SELECT * FROM servicios;";
        // Realizar la consulta
        $consulta = mysqli_query($db, $sql);

        return $consulta;
        // Acceder a los resultados

        // Cerrar la conexion (opcional)
        mysqli_close($db);
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

obtener_servicios();