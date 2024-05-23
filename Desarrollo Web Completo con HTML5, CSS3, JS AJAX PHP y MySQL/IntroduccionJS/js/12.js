"use strict" // ejecuta el codigo de js de forma estricta

const producto = {
    nombreProducto: "Monitor 20 Pulgadas",
    precio: 300,
    disponible: true
}

Object.freeze(producto); // No permite que el objeto sea modificado, borrado o agregado

// Object.seal(producto) No permite agregar ni borrar pero si modificar 

producto.imagen = "imagen.jpg";

console.log(Object.isFrozen(producto));

console.log(producto);