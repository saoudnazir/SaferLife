from django.shortcuts import render
from django.http import HttpResponse, StreamingHttpResponse
from django.template import loader
import threading
import cv2
from time import sleep
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
import urllib, json
#
# Create your views here.
gobFrames = []
gobID = 0
def appendframes(frame):
    global gobFrames
    gobFrames.append(frame)
def saveVideo(request):
    try:
        print("Triggered save video")
        global gobFrames
        frames= gobFrames
        print(frames)
        out = cv2.VideoWriter('outpy.avi',-1, 10, (320,240))
        for i in range(len(frames)):
            out.write(frames[i])
        out.release()
    except:
        print("Some Error")
        
def printFrames(request):
    global gobFrames
    print(gobFrames)

isReady = False
def stream(conn,num):
    faces , names, ids = LoadDB.loadofflineDB()
    r = Recognition(faces,names,ids)
    data = b""
    global gobFrames
    payload_size = struct.calcsize(">L")
    print("payload_size: {}".format(payload_size))
    while True:
        global isReady
        global gobID
        gobID = 0
        while len(data) < payload_size:
            print("Recv: {}".format(len(data)))

            data += conn.recv(4096)
        
        #print("Done Recv: {}".format(len(data)))
        packed_msg_size = data[:payload_size]
        data = data[payload_size:]
        msg_size = struct.unpack(">L", packed_msg_size)[0]
        #print("msg_size: {}".format(msg_size))
        while len(data) < msg_size:
            data += conn.recv(4096)
        frame_data = data[:msg_size]
        data = data[msg_size:]
        frame = pickle.loads(frame_data, fix_imports=True, encoding="bytes")
        frame = cv2.imdecode(frame, cv2.IMREAD_COLOR)
        frame,name,id =  r.startFaceRecognition(frame)
        #print(id)
        cv2.waitKey(1)
        cv2.imwrite('outgoing.jpg', frame)
        isReady= True
        with open(f"{date.today()}.txt", "a") as f:
            f.write(f"{name} is seen on {date.today()} at {datetime.now().strftime('%I:%M:%S %p')}\n")
            f.close()
        gobFrames.append(frame)
        gobID = id
        #print(gobID)
def returnFrame():
    while True:
        global isReady
        if isReady:
            isReady = False
            yield (b'--frame\r\n'
                b'Content-Type: image/jpeg\r\n\r\n' + open('outgoing.jpg', 'rb').read() + b'\r\n')
def video_feed(request):
    return StreamingHttpResponse(returnFrame(), content_type='multipart/x-mixed-replace; boundary=frame')

def alert_crime(request):
    global gobID
    print(gobID)
    if gobID == 0:
        return HttpResponse("No Criminal Found", content_type="text/plain")
    else:
        return HttpResponse(gobID)

def generateDB(request):
    message=""
    try:
        print("Starting DB generation...")
        g = General()
        url ="http://192.168.0.8/webandapp/newLocalDB.php"
        jsonURL = urllib.request.urlopen(url)
        data = json.loads(jsonURL.read().decode())
        id=[]
        names=[]
        images=[]
        for d in data:
            for k,v in d.items():
                #print (v)
                if k == 'p_ID':
                    id.append(v)
                if k == 'p_Name':
                    names.append(v)
                if k == 'p_Images':
                    images.append('faces/' + v)
        print(id)
        print(names, images)
        #print(type(data))
        g.generateLocalDB(names, g.encodeImages(images),id)
        message ="Successfully generating local DB"
    except IOError:
        message ='An error occured trying to read the file.'
    except ImportError:
        message = "NO file found"
    except EOFError:
        message = "Why did you do an EOF on me?"
    except:
        message = 'An error occured.'
    return HttpResponse(message)   

def MultiSocket(request):
    HOST = ''
    PORT = 8485
    threads=[]
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    print('Socket created')

    s.bind((HOST, PORT))
    print('Socket bind complete')
    s.listen(10)
    print('Socket now listening')
    #threading.Thread(target=optimizeThreads).start()
    num = 1
    while True:
        print("Waiting for Connection")
        conn, addr = s.accept()
        print(f"Connected with {addr}")
        t = threading.Thread(target=stream, args=(conn,num,))
        threads.append(t.getName())
        print(threads,len(threads))
        num+=1
        threadCount = 0
        '''for t in threads:
            if not t.is_alive():
                del threads[threadCount]
            threadCount+=1
        print(f"Total number of threads {len(threads)} and {threadCount} are running")'''
        t.start()
        

