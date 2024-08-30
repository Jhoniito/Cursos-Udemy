<?php

require "db.php";





////////////////////////

function consulta_articulo(){
 
        //IMPORTAR CREDENCIALES
        $db = conexionDB();

        //CONSULTA SQL
        $sql = "SELECT * FROM articulos;";

        //REALIZAR LA CONSULTA
        $consulta = mysqli_query($db, $sql);

        return $consulta;

}

///////////////////////////



                    



function crear_articulo($nombre, $imagen, $ean){
    

        $db = conexionDB();
        $imagen = $_FILES["imagen"];
        $carpetaImagenes = "../imagenes/";

        // CREAMOS LA CARPETA DONDE ALMACENAREMOS LAS MAGENES
        
        if(!is_dir($carpetaImagenes)) { // Si no existe la carpetaImagenes -->
            mkdir($carpetaImagenes); // --> creará la carpeta
        }
        // GENERARA UN NOMBRE UNICO PARA QUE NO SOBREESCRIBA LA IMAGEN
        $nombreImagen = md5(uniqid("")) . ".jpg"; // Genera nombres aleatorios 
    
        // SUBIMOS EL ARCHIVO QUE SE ALMACENA TEMPORALMENTE EN tmp_name A LA $carpetaImagenes
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen );

        $verificacionEan = consulta_ean($ean);

        if(!$verificacionEan){
            $sql = "INSERT INTO articulos (nombre, imagen, ean) VALUES ('$nombre', '$nombreImagen', '$ean')";

            $consulta = mysqli_query($db, $sql);
        if($consulta) {
            mysqli_close($db);
            return true; // Devolver true si la consulta fue exitosa
        } else {
            mysqli_close($db);
            return false; // Devolver false si la consulta falló
        }

        } else {

            
        }

}

//------------ELIMINACION------------//

function eliminar_articulo($idArticulo){

        $db = conexionDB();
        $carpetaImagenes = "../imagenes/";

        // Primero comprobaremos si el id del articulo existe en la tabla ubicacion articulo para dar mas integridad a los datos
        $sqlubicacion = "SELECT * FROM ubicacion_articulo WHERE idArticulo = '$idArticulo'";
        $consultaUbicacion = mysqli_query($db, $sqlubicacion);

        if($consultaUbicacion) {
            mysqli_close($db);
            return false;
        }

        // Posteriormente si el articulo no esta anclado a ninguna ubicacion, seleccionaremos su respectiva imagen si tiene, en caso de que
        // si la tenga se procedera a ala eliminacion de ella dirgiendose a la carpeta de imagenes. 
        $sqlImagenAct = "SELECT imagen FROM articulos WHERE idArticulo = '$idArticulo'";
        $queryImagen = mysqli_query($db, $sqlImagenAct);
        $resultadoImagen =  mysqli_fetch_assoc($queryImagen);
        $imagenAct = $resultadoImagen["imagen"];

        if (!empty($imagenAct) && file_exists($carpetaImagenes . $imagenAct)) {
            unlink($carpetaImagenes . $imagenAct);
        }

        // Finalmente se eliminará todos los registros de dicho articulo 
        $sql = "DELETE FROM articulos WHERE idArticulo = '$idArticulo'";
        $consulta = mysqli_query($db, $sql);

        mysqli_close($db);


}




////////////////
function consulta_datos_articulo($idArticulo){

        $db = conexionDB();

        $sql = "SELECT * FROM articulos WHERE idArticulo = '$idArticulo'";

        $consulta = mysqli_query($db, $sql);

        $articulo = mysqli_fetch_assoc($consulta);


        mysqli_close($db);
        return $articulo;




    }

///////////////////////

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
