numeros = [1,2,3,4,5,6]

#Imprime la lista obtenida
print(numeros)

#Desempaqueta la lista obtenida y muestra cada argumento
print(*numeros)

#Empaquetar los argumentos desempaquetados
def agregar(x,y):
    print (x+y)
    return x + y

agregar(10,10)

def agregar2(*numeros):
    total = 0
    for numero in numeros:
        total = total + numero
    return (total)

print(agregar2(1,2,3,4,5,6,7,8,9))

def sobre(nombre, edad, gustos):
    oracion = "Es {} tiene {} años de edad y le gusta {}".format(nombre,edad,gustos)
    print(oracion)
    return oracion


dictionary = {"nombre": "Jack", "edad": 23, "gustos": "Python"}

sobre(**dictionary)

def mi_funcion(**kwargs):
    for key,value in kwargs.items():
        print("{}:{}".format(key,value))

mi_funcion(Sara = "Femenino", John = "Masculino")