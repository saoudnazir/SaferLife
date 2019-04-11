from os.path import dirname, join
import json


class LoadDB:
    known_faces_encodings = []
    known_names = []

    def loadofflineDB():
        try:
            print("Loading DB....")
            dir = dirname(__file__)
            path = join(dir, "db.json")
            with open(path) as json_file:
                data = json.load(json_file)
                for key, value in data.items():
                    LoadDB.known_names.append(key)
                    LoadDB.known_faces_encodings.append(value)
                    print(
                        f"{(len(LoadDB.known_names)/len(data.items())*100)}% has been loaded")

        except IOError:
            print("DB could not be loaded.")
        else:
            print("DB has been loaded.")
        return LoadDB.known_faces_encodings, LoadDB.known_names

    def loadOnlineDB():
        pass
