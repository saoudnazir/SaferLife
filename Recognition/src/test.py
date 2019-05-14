from general import General
from recognition import Recognition
from LoadDB import LoadDB
from os.path import dirname, join
from recognition import Recognition
import json
import array as arr
import face_recognition
import cv2


g = General()
name = ['saoud','huy']
files = [join(dirname(__file__),'saoud.jpg'),join(dirname(__file__),'huy.jpeg')]
print(files)
g.generateLocalDB(name,g.encodeImages(files))