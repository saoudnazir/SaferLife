from django.shortcuts import render
from django.http import HttpResponse, StreamingHttpResponse
from django.template import loader
import cv2
from LoadDB import LoadDB
from recognition import Recognition
from general import General
from os.path import dirname, join

from datetime import datetime
from datetime import date
import socket
import sys
import cv2
import pickle
import numpy as np
import struct
import zlib
import time 
# Create your views here.
class video:
    frames = []
    def appendframes(self,frame):
        video.frames.append(frame)

    def saveVideo(self):
        out = cv2.VideoWriter('outpy.avi',cv2.VideoWriter_fourcc('M','J','P','G'), 10, (320,240))
        for f in video.frames:
            out.write(f)
        out.release()
    def printFrames(self):
        print(video.frames)

def myIndex(request):
    template = loader.get_template('index.html')
    return HttpResponse(template.render({}, request))

def stream():
    faces , names = LoadDB.loadofflineDB()
    r = Recognition(faces,names)
    v = video()
    
 
    
    
    
    HOST = ''
    PORT = 8485

    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    print('Socket created')

    s.bind((HOST, PORT))
    print('Socket bind complete')
    s.listen(10)
    print('Socket now listening')

    conn, addr = s.accept()

    data = b""
    payload_size = struct.calcsize(">L")
    print("payload_size: {}".format(payload_size))
    while True:

        while len(data) < payload_size:
            print("Recv: {}".format(len(data)))
            data += conn.recv(4096)
        
        if len(data)>0:
            print("Done Recv: {}".format(len(data)))
            packed_msg_size = data[:payload_size]
            data = data[payload_size:]
            msg_size = struct.unpack(">L", packed_msg_size)[0]
            print("msg_size: {}".format(msg_size))
            while len(data) < msg_size:
                data += conn.recv(4096)
            frame_data = data[:msg_size]
            data = data[msg_size:]

            frame = pickle.loads(frame_data, fix_imports=True, encoding="bytes")
            frame = cv2.imdecode(frame, cv2.IMREAD_COLOR)
            frame,name =  r.startFaceRecognition(frame)
            cv2.waitKey(1)
            cv2.imwrite('outgoing.jpg', frame)
            v.appendframes(frame)
            with open(f"{date.today()}.txt", "a") as f:
                f.write(f"{name} is seen on {date.today()} at {datetime.now().strftime('%I:%M:%S %p')}\n")
                f.close()
            if not data:
                print("Breaking Loop")
                break
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + open('outgoing.jpg', 'rb').read() + b'\r\n')
    conn.close()
    print("Closing Socket")

def video_feed(request):
    return StreamingHttpResponse(stream(), content_type='multipart/x-mixed-replace; boundary=frame')

def test(request):
    v = video()
    v.printFrames()
