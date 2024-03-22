for numero in range (1, 101):
    print(numero)

for numeroLista in [1,2,3,4,5,6]:
    print(numeroLista)

for letra in "abcd":
    print(letra)

for numero in range (1, 11, 2):
    print(numero)

vocales = 0
consonantes = 0 
for letra in "programacion":
    if letra.lower() in "aeiou":
        vocales = vocales + 1
    elif letra == "":
        pass
    else:
        consonantes = consonantes + 1
print("Tenemos {} vocales".format(vocales) )
print("Tenemos {} consonantes".format(consonantes))

estudiantes = {
    "masculino": ["Tom","Charlie", "Harry","Frank"],
    "femenino": ["Sarah","Huda","Samantha","Emily"]
}
for key in estudiantes.keys():
    for nombre in estudiantes[key]:
        if "a" in nombre:
            print(nombre)