ruta = "C:/archivos/personas.txt"

def Agregar(nombre, edad,genero):
    with open(ruta, "a") as archivo: ## "a" agrega el contenido que queremos al archivo
        fila = "{}, {}, {}\n" .format(nombre,edad,genero)
        archivo.write(fila)
        print("Persona Agregada")

def Lista():
    with open(ruta, "r") as archivo:
        print("-------Lista-------")
        print(archivo.read())
        print("-------------------")

def  Listar_Genero(letra_genero):
    with open(ruta,"r") as archivos:    
        archivos.seek(0) # El metodo seek posociona el cursor en el archivo donde deseamos, en este caso (0) al inicio
        for archivo in archivos:
            archivo = archivo.strip("\n") # El metodo strip elimina los espacios en blanco, saltos de linea, etc al inicio - final de una cadena de texto
            nombre, edad, genero = [x.strip() for x in archivo.split(",")] # El metodo split divide una cadena en una lista de subcadenas utilizando un delimitador, en este caso ","

            if letra_genero == genero:
                print(archivo)


while True:
    print("------elige una opcion-------")
    print("1-agregar una persona")
    print("2-listar personas")
    print("3-listar personas por genero")
    print("4-cerrar registro")
    opcion = input("elige una opcion: ").strip()

    if int(opcion) == 1:
        nom = input("nombre: ").strip().capitalize()
        ed = input("edad: ").strip()
        gen = input("genero: ").strip().upper()

        Agregar(nom,ed,gen)

    elif int(opcion) == 2:
        Lista()
    
    elif int(opcion) == 3:
        gen = input("ingresa el genero: ").strip().upper()
        Listar_Genero(gen)
    elif (int(opcion) == 4):
        break
    else:
        print("OPCION INVALIDA")
    






