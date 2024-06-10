<?php

function conexionDB() { /*Creamos la funcion la cual realizara la conexion con la base de datos*/
    $db = mysqli_connect("localhost", "root", "Ilerna861996", "sai");

    if(!$db){
        echo "HUBO UN ERROR EN LA CONEXION"; /* Muestro por pantalla en caso de que la conexion no se haya efectuado*/
        exit;
    }
    
    return $db; /* Devolvemos la conexion si ha sido correcta*/
}


?>
