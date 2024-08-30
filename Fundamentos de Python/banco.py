class Cuenta:
    def __init__(self, nombre, balance, balance_min):
        self.nombre = nombre
        self.balance = balance
        self.balance_min = balance_min

    def deposito(self, monto):
        self.balance += monto

    def retiro(self, monto):
        if self.balance - monto >= self.balance_min:
            self.balance -= monto
        else:
            print("No tienes dinero suficiente")

    def declaracion(self):
        print("Balance de Cuanta: {}".format(self.balance))
    

    
class Corriente(Cuenta):
    def __init__(self, nombre, balance):
        super().__init__(nombre, balance, balance_min = -1000)

    def __str__(self):
        return "La cuenta corriente de {} - Balance de: {}".format(self.nombre,self.balance)

class Ahorro(Cuenta):
    def __init__(self, nombre, balance):
        super().__init__(nombre, balance, balance_min = 0)

    def __str__(self):
        return "La cuenta ahorro de {} - Balance de: {}".format(self.nombre,self.balance)

z = Corriente("Juan", 500)

z.deposito(300)
z.declaracion()
z.retiro(1000)
z.declaracion()
z.retiro(801)
z.declaracion()
print(z)

t = Ahorro("Tom", 300)
t.retiro(300)
t.declaracion()
t.retiro(1)
print(t)

