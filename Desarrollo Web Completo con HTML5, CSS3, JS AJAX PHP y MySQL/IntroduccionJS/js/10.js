// OBJETOS

const producto = {
    nombreProducto: "Monitor 20 Pulgadas",
    precio: 300,
    disponible: true
}

console.log(producto);

// console.log(producto.precio);
// console.log(producto.nombreProducto);
// console.log(producto.disponible);

// console.log(producto["precio"])
// console.log(producto["nombreProducto"])
// console.log(producto["disponible"])


// AGREGAR PROPIEDADES OBJETOS
producto.imagen = "imagen.jgp";
console.log(producto)

// ELIMINAR PROPIEDADES
delete producto.disponible;
console.log(producto)