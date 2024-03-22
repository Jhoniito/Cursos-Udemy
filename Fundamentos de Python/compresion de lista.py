numero_par = [x for x in range(1,101) if x%2 == 0]
print(numero_par)
numero_impar = [x for x in range(1,101) if x%2 != 0]
print(numero_impar)

palabras = ["python","es","un","lenguaje","de","programacion"]
respuesta = [[w.upper(),w.lower(),len(w)] for w in palabras]
print(respuesta)