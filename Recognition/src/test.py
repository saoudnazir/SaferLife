from general import General
from recognition import Recognition
from LoadDB import LoadDB
from os.path import dirname, join
import json
import array as arr

faces, names = LoadDB.loadofflineDB()
r = Recognition(faces, names)
names = ["Saoud", "huy", "Marcus"]
imgs = ["12312", "1231231233123", "1231231231231231231231"]
r.generateLocalDB(names, imgs)
