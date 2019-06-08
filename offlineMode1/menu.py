from LoadDB import LoadDB
from recognition import Recognition
from general import General
from os.path import join, dirname
import os
class Menu:
    names = []
    faces = []
    ids =[]

    def offlineMode(self):
        self.faces, self.names, self.ids = LoadDB.loadofflineDB()
        if(self.faces and self.names):
            r = Recognition(self.faces, self.names,self.ids)
            r.startFaceRecognition()
        else:
            print("DB not loaded")

    def onlineMode(self):
        pass


menu = Menu()
methods = {
    0: {"name": "Exit"},
    1: {"function": menu.offlineMode, "name": "Offline Mode"},
    2: {"function": menu.onlineMode, "name": "Online Mode"},
}


for keys, values in methods.items():
    print(f"Press {keys} for {values['name']}")


while True:
    choice = int(input(f"Enter a number between 1 and {len(methods)}: "))
    if(choice is 0):
        break
    methods[choice]['function']()
