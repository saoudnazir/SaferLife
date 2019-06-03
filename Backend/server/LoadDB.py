from os.path import dirname, join
import json


class LoadDB:
    known_faces_encodings = []
    known_names = []
    known_ids = []

    def loadofflineDB():
        try:
            print("Loading DB....")
            dir = dirname(__file__)
            path = join(dir, "dbtest.json")
            with open(path) as json_file:
                data = json.load(json_file)
                for key, value in data.items():
                    LoadDB.known_ids.append(key)
                    for k,v in value.items():
                        if k == "name":
                            LoadDB.known_names.append(v)
                        if k == "face":
                            LoadDB.known_faces_encodings.append(v)
                    print(
                        f"{(len(LoadDB.known_names)/len(data.items())*100)}% has been loaded")

        except IOError:
            print("DB could not be loaded.")
        else:
            print("DB has been loaded.")
        return LoadDB.known_faces_encodings, LoadDB.known_names, LoadDB.known_ids

    def loadOnlineDB(self):
        pass
