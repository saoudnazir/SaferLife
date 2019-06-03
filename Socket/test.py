import face_recognition
import os
from os.path import dirname, join

img = face_recognition.load_image_file(join(dirname(__file__),"huy.jpeg"))
encodedimg = face_recognition.face_encodings(img)[0]
print(encodedimg)