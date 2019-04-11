from LoadDB import LoadDB
from recognition import Recognition


class Menu:
    names = []
    faces = []

    def offlineMode(self):
        self.faces, self.names = LoadDB.loadofflineDB()
        if(self.faces and self.names):
            r = Recognition(self.faces, self.names)
            r.startFaceRecognition()
        else:
            print("DB not loaded")

    def onlineMode(self):
        pass

    def startPreview(self):
        if(self.faces and self.names):
            r = Recognition(self.faces, self.names)
            r.startFaceRecognition()
        else:
            print("DB not loaded")


menu = Menu()
methods = {
    1: {"function": menu.offlineMode, "name": "Offline Mode"},
    2: {"function": menu.onlineMode, "name": "Online Mode"},
    3: {"function": menu.startPreview, "name": "Start Preview"}
}


for keys, values in methods.items():
    print(f"Press {keys} for {values['name']}")

while True:
    choice = int(input(f"Enter a number between 1 and {len(methods)}: "))
    if(choice is 4):
        break
    methods[choice]['function']()
