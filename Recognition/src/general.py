import os
from os.path import dirname, join
import json


class General:

    def sortActivityLog(self, logs):
        sortedList = []
        for eachLog in logs:
            if eachLog not in sortedList:
                sortedList.append(eachLog)
        return sortedList

    def isFileEmpty(self, path):
        return os.stat(path).st_size == 0

    def generateLocalDB(self, names, encodedImgs):
        dir = dirname(__file__)
        path = join(dir, "db.json")
        count = 0
        jsonData = {}
        data = {}
        for name, img in zip(names, encodedImgs):
            data[f"{name}"] = img
            jsonData.update(data)
            count += 1
        print(jsonData)
        with open(path, 'w') as json_file:
            json_file.write(str(json.dumps(data)))
        json_file.close()
        print("New DB has generated")
    
