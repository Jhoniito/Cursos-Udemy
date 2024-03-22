# obtener oracion del usuario
original = input("Ingresa una oracion").strip().lower()


# dividir en plabaras individuales
palabras = original.split()

# recorrer palabras y convertirlas con el tracudtor
nuevas_palabras = []
for palabra in palabras:
    if palabra[0] in "aeiou":
        nueva_palabra = palabra + "yay"
        nuevas_palabras.append(nueva_palabra)
    else:
        vocal_pos = 0
        for letra in palabra:
            if letra not in "aeiou":
                vocal_pos = vocal_pos + 1
            else:
                break
        cons = palabra[:vocal_pos]
        el_resto = palabra[vocal_pos:]
        nueva_palabra = el_resto + cons + "ay"
        nuevas_palabras.append(nueva_palabra)
    
print(nuevas_palabras)

# unir palabras en una oracion

salida = " ".join(nuevas_palabras)

# generear cadena final
print(salida)