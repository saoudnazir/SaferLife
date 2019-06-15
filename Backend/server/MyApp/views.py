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
import os

gobFrames = []
gobID = 0
allThreads=[]
def appendframes(frame):
    global gobFrames
    gobFrames.append(frame)

def saveVideo(request):
    try:
        print("Triggered save video")
        global gobFrames
        frames= gobFrames
        img = frames[0]
        height, width, channels = img.shape
        print(width,height)
        fourcc = cv2.VideoWriter_fourcc(*'DIVX')
        out = cv2.VideoWriter('{}.avi'.format('Video1'),fourcc, 10.0, (int(width),int(height)),True)
        for i in range(len(frames)):
            out.write(frames[i])
        out.release()
    except:
        print("Some Error")
     

isReady = False
def stream(conn,addr):
    if not os.path.exists('{}'.format(addr)):
        os.makedirs('{}'.format(addr))
        print("Folder Created named as {}".format(addr))
    faces , names, ids = LoadDB.loadofflineDB()
    r = Recognition(faces,names,ids)
    data = b""
    global gobFrames
    global allThreads
    logs = []
    g = General()
    allThreads.append(threading.current_thread().ident)
    payload_size = struct.calcsize(">L")
    print("payload_size: {}".format(payload_size))
    while True:
        global isReady
        global gobID
        while len(data) < payload_size:
            #print("Recv: {}".format(len(data)))
            data += conn.recv(4096)
            if len(data) < 5 :
                print("1.Breaking Face Recognition")
                conn.close()
                break
        
        #print("Done Recv: {}".format(len(data)))
        packed_msg_size = data[:payload_size]
        data = data[payload_size:]
        msg_size = struct.unpack(">L", packed_msg_size)[0]
        #print("msg_size: {}".format(msg_size))
        while len(data) < msg_size:
            data += conn.recv(4096)
            if len(data) < 5:
                print("2.Breaking Face Recognition")
                conn.close()
                break
        frame_data = data[:msg_size]
        data = data[msg_size:]
        frame = pickle.loads(frame_data, fix_imports=True, encoding="bytes")
        frame = cv2.imdecode(frame, cv2.IMREAD_COLOR)
        frame,name,id =  r.startFaceRecognition(frame,addr)
        #sleep(0.015)
        cv2.waitKey(1)
        cv2.imwrite('outgoing.jpg', frame)

        isReady= True
        if name:
            logs.append(f"{name} is seen on {date.today()} at {datetime.now().strftime('%I:%M %p')}\n")
            logs = g.sortActivityLog(logs)
            with open(f"{addr}/{date.today()}.txt", "w") as f:
                f.writelines(logs)
            name=False
        gobFrames.append(frame)
        gobID = id
        if len(frame_data) < 0:
                print("3.Breaking Face Recognition")
                conn.close()
                break
def returnFrame():
    while True:
        global isReady
        if isReady:
            isReady = False
            yield (b'--frame\r\n'
                b'Content-Type: image/jpeg\r\n\r\n' + open('outgoing.jpg', 'rb').read() + b'\r\n')
def video_feed(request):
    return StreamingHttpResponse(returnFrame(), content_type='multipart/x-mixed-replace; boundary=frame')

def generateDB(request):
    message=""
    try:
        print("Starting DB generation...")
        g = General()
        url ="http://192.168.0.27/saferlife/newLocalDB.php"
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
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    print('Socket created')

    s.bind((HOST, PORT))
    print('Socket bind complete')
    s.listen(10)
    print('Socket now listening')
    #threading.Thread(target=optimizeThreads).start()
    num = 1
    global allThreads
    while True:
        print("Waiting for Connection")
        conn, addr = s.accept()
        ip, port = addr
        print(f"Connected with {ip}")
        t = threading.Thread(target=stream,name=f"Streaming-{num}", args=(conn,ip,))
        num+=1
        '''threadCount = 0
        for t in threads:
            if not t.is_alive():
                del threads[threadCount]
            threadCount+=1
        print(f"Total number of threads {len(threads)} and {threadCount} are running")'''
        t.start()
        print(allThreads,len(allThreads))
        

def downloadDB(request):
    with open("db.json","r") as file:
        return HttpResponse(file.read())