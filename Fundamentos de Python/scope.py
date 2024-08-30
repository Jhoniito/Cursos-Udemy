# Hay variables de alcance globales y locales
a = 250

# Las funciones crean variables de alcance local
def f1():
    b = a + 10
    print(b)

def f2():
    a = 50
    print(a)

f1()
f2()


# Las variables de alcance global solo pueden ser modificadas en el ambito global
print(a)

# Excepto usando la palabra reservada global para anular la proteccion de alcance global
def f3():
    global a
    a = 80

f3()

print(a)

# En la listas el comportamiento es distinto, ya que en una misma funcion si modifica PARTE el valor global de la variable
b = [1,3,4,6]
def f4():

    b[0] = 8
f4()

print(b)