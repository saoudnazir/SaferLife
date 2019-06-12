import os
from os.path import dirname, join
import json
import face_recognition
import numpy as np



class General:

    def sortActivityLog(self, logs):
        sortedList = []
        for eachLog in logs:
            if eachLog not in sortedList:
                sortedList.append(eachLog)
        return sortedList

    def isFileEmpty(self, path):
        return os.stat(path).st_size == 0

    def generateLocalDB(self, names, encodedImgs,ids):
        dir = dirname(__file__)
        path = join(dir, "db.json")
        count = 0
        jsonData = {}
        data = {}
        for name, img, id in zip(names, encodedImgs,ids):
            data[str(id)] = {"name":name,"face":img}


            #data[f"{name}"] = img
            jsonData.update(data)
            count += 1
        with open(path, 'w') as json_file:
            json_file.write(str(json.dumps(data)))
        json_file.close()
        print("New DB has generated")

    def encodeImages(self,imgPaths):
        encodedImagesArr = []
        if imgPaths:
            for img in imgPaths:
                loadedImg = face_recognition.load_image_file(img)
                encodedImagesArr.append(face_recognition.face_encodings(loadedImg)[0])
        count = 0
        encodedImgArrStr = []
        for encodedImg in encodedImagesArr:
            if encodedImg.all():
                encodedImgArrStr.append([])
            for eachArr in encodedImg:
                encodedImgArrStr[count].append(eachArr)
            
            count = count+1
        

        return encodedImgArrStr
    
    def startSocketConn(self):
        pass