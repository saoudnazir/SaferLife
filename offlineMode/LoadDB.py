from os.path import dirname, join
import json
from general import General
from urllib import request


class LoadDB:
    known_faces_encodings = []
    known_names = []
    known_ids = []

    def loadofflineDB():
        try:
            print("Loading DB....")
            dir = dirname(__file__)
            path = join(dir, "db.json")
            with open(path) as json_file:
                data = json.load(json_file)
                for key, value in data.items():
                    LoadDB.known_ids.append(key)
                    for k,v in value.items():
                        if k == "name":
                            LoadDB.known_names.append(v)
                        if k == "face":
                            LoadDB.known_faces_encodings.append(v)
                    print('{}% has been loaded'.format((len(LoadDB.known_names)/len(data.items())*100)))

        except IOError:
            print("DB could not be loaded.")
        else:
            print("DB has been loaded.")
        return LoadDB.known_faces_encodings, LoadDB.known_names, LoadDB.known_ids

    def downloadDB(ip):
        g = General()
        url = "http://{}:8000/downloadDB/".format(ip)
        jsonURL = request.urlopen(url)
        data = json.loads(jsonURL.read().decode('utf-8'))
        try:
            with open(join(dirname(__file__),"db.json"),"w") as db:
                json.dump(data,db)
            print("DB downloaded !!")
        except:
            print("Some Error")


