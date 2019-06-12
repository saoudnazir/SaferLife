from LoadDB import LoadDB
from recognition import Recognition
from general import General
from os.path import join, dirname
import os
from client import startSocket

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
        ipAddr = '127.0.0.1'
        port = 8485
        startSocket(ipAddr,port)

    def downloadDB(self):
        LoadDB.downloadDB()


menu = Menu()
methods = {
    0: {"name": "Exit"},
    1: {"function": menu.offlineMode, "name": "Offline Mode"},
    2: {"function": menu.onlineMode, "name": "Online Mode"},
    3: {"function": menu.downloadDB, "name": "Download Latest DB"},
}


for keys, values in methods.items():
    print("Press {} for {}".format(keys,values['name']))


while True:
    choice = int(input("Enter a number between 1 and {}: ".format(len(methods))))
    if(choice is 0):
        break
    methods[choice]['function']()
