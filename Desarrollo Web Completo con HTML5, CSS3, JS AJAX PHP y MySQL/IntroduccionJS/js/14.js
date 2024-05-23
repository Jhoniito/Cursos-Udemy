// ARREGLOS O ARRAYS

const numeros = [10,20,30,40,50];

console.table(numeros);

const meses = new Array("Enero","Febrero","Marzo","Abril")

console.table(meses);

const arreglos = ["Hola", 10, true, "si", null, {nombre: "Johnny", nacimiento: 1996}, [1,2,3]];

console.log(arreglos)

//Acceder a los valores de un arreglo

console.log(numeros[4]);

//Acceder la longitud del array
console.log(meses.length);

//
numeros.forEach(function(numero){
    console.log(numero)
})