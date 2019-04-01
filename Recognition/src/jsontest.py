import array as arr
import json

knownNames = []
knownFaces = []

with open('db.json') as json_file:  
    data = json.load(json_file)
    for key, value in data.items():
        knownNames.append(key)
        knownFaces.append(value)
        

print(knownFaces)
