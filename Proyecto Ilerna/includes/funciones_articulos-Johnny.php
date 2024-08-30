<?php

require "db.php";

//CONSULTA DE TODOS LOS ARTICULOS//

function consulta_articulo(){
 
        //IMPORTAR CREDENCIALES
        $db = conexionDB();

        //CONSULTA SQL
        $sql = "SELECT * FROM articulos;";

        //REALIZAR LA CONSULTA
        $consulta = mysqli_query($db, $sql);

        return $consulta;

}

//FUNCION DE CREAR ARTICULOS//
function crear_articulo($nombre, $imagen, $ean){
    

        $db = conexionDB();
        $imagen = $_FILES["imagen"];// Creamos la variable imagen junto con la variable superglobal $_FILES que
        // se obtendra del archivo subido a traves del formulario llamado imagen
        $carpetaImagenes = "../imagenes/";//Creamos esta variable la cual contiene la ruta donde se almacenara
        //las imagenes de nuestro proyecto

        // CREAMOS LA CARPETA DONDE ALMACENAREMOS LAS MAGENES
        
        if(!is_dir($carpetaImagenes)) { // Si no existe la carpetaImagenes -->
            mkdir($carpetaImagenes); // --> creará la carpeta
        }
        // GENERARA UN NOMBRE UNICO PARA QUE NO SOBREESCRIBA LA IMAGEN
        $nombreImagen = md5(uniqid("")) . ".jpg"; // Genera nombres aleatorios 
    
        // SUBIMOS EL ARCHIVO QUE SE ALMACENA TEMPORALMENTE EN tmp_name A LA $carpetaImagenes
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen );

        $verificacionEan = consulta_ean($ean); //Utilizamos la funcion que creamos para buscar un ean ya creado

        if(!$verificacionEan){// si el valor recibido es false, se procedera a crear el articulo ya que no existe en la base de datos
            $sql = "INSERT INTO articulos (nombre, imagen, ean) VALUES ('$nombre', '$nombreImagen', '$ean')";

            $consulta = mysqli_query($db, $sql);// Ejecutamos la consulta
             if($consulta) {
            mysqli_close($db);
                return true; // Devolver true si la consulta fue exitosa
            } else {
                mysqli_close($db);
                return false; // Devolver false si la consulta falló
            }

        } 
}

//ELIMINACION DEL ARTICULO//

function eliminar_articulo($idArticulo){

        $db = conexionDB();
        $carpetaImagenes = "../imagenes/";//Creamos esta variable la cual contiene la ruta donde se almacenara
        //las imagenes de nuestro proyecto

        // Primero comprobaremos si el id del articulo existe en la tabla ubicacion articulo para dar mas integridad a los datos
        $sqlubicacion = "SELECT * FROM ubicacion_articulo WHERE idArticulo = '$idArticulo'";
        $consultaUbicacion = mysqli_query($db, $sqlubicacion);

        if(mysqli_num_rows($consultaUbicacion) > 0) {//Si el articulo de que queremos eliminar esta anclado a una ubicacion, cerraremos la conexion
            // y no podra ser borrado hasta que dicho articulo no tenga una ubicacion asignada
            mysqli_close($db);
            return false;
        } else {

        // Posteriormente si el articulo no esta anclado a ninguna ubicacion, seleccionaremos su respectiva imagen si tiene, en caso de que
        // si la tenga se procedera a la eliminacion de ella dirgiendose a la carpeta de imagenes. 
        $sqlImagenAct = "SELECT imagen FROM articulos WHERE idArticulo = '$idArticulo'";
        $queryImagen = mysqli_query($db, $sqlImagenAct);
        $resultadoImagen =  mysqli_fetch_assoc($queryImagen);
        $imagenAct = $resultadoImagen["imagen"];

        if (!empty($imagenAct) && file_exists($carpetaImagenes . $imagenAct)) { //Verifica si existe la imagen y si existe 
            // en la direccion de ruta
            unlink($carpetaImagenes . $imagenAct);// si cumple las condiciones, elimina la imagene de la carpeta
        }

        // Finalmente se eliminará todos los registros de dicho articulo 
        $sql = "DELETE FROM articulos WHERE idArticulo = '$idArticulo'";
        $consulta = mysqli_query($db, $sql);

        mysqli_close($db);
    }


}

//CONSULTA DE DATOS DEL ARTICULO//
function consulta_datos_articulo($idArticulo){

        $db = conexionDB();

        $sql = "SELECT * FROM articulos WHERE idArticulo = '$idArticulo'";

        $consulta = mysqli_query($db, $sql);

        $articulo = mysqli_fetch_assoc($consulta);


        mysqli_close($db);
        return $articulo;




    }

//ACTUALIZA LOS DATOS DE UN ARTICULO YA EN LA BASE DE DATOS//

function actualizar_datos_articulo($idArticulo, $nombre, $imagen, $ean){
    try {
        $db = conexionDB();

        // OBTENEMOS EL NOMBRE DE LA IMAGEN ACTUAL
        $sqlImagenAct = "SELECT imagen FROM articulos WHERE idArticulo = '$idArticulo'";
        $queryImagen = mysqli_query($db, $sqlImagenAct);
        $resultadoImagen =  mysqli_fetch_assoc($queryImagen);
        $imagenAct = $resultadoImagen["imagen"];



        // CREAMOS LA CARPETA DONDE ALMACENAREMOS LAS MAGENES
        $carpetaImagenes = "../imagenes/";
        if(!is_dir($carpetaImagenes)) { // Si no existe la carpetaImagenes -->
            mkdir($carpetaImagenes); // --> creará la carpeta
        }
        // GENERARA UN NOMBRE UNICO PARA QUE NO SOBREESCRIBA LA IMAGEN
        $nombreImagen = md5(uniqid("")) . ".jpg"; // Genera nombres aleatorios 

        // BORRAMOS LA IMAGEN SI EXISTE
        if (!empty($imagenAct) && file_exists($carpetaImagenes . $imagenAct)) {
            unlink($carpetaImagenes . $imagenAct);
        }

        // SUBIMOS EL ARCHIVO QUE SE ALMACENA TEMPORALMENTE EN tmp_name A LA $carpetaImagenes
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen );


        $sql = "UPDATE articulos SET nombre='$nombre', imagen='$nombreImagen', ean = '$ean' WHERE idArticulo='$idArticulo'";

        $consulta = mysqli_query($db, $sql);
        mysqli_close($db);

    } catch (\Throwable $th) {
        var_dump($th) ;
    }
}

//CONSULTA DE EAN
function consulta_ean($ean){
    $db = conexionDB();

    $sql = "SELECT * FROM articulos WHERE ean = '$ean'";

    $consulta = mysqli_query($db, $sql);

    $articulo = mysqli_fetch_assoc($consulta);

    if($articulo){
        return true;
    } else {
        return false;
    }

}

    
?>
