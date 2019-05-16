from os.path import dirname, join
import array as arr
import json
from datetime import datetime
from datetime import date
from general import General
import cv2
import face_recognition


class Recognition:
    known_faces_encodings = []
    known_names = []
    activity_log = []
    frameArr = []

    def __init__(self, known_faces_encodings, known_names):
        self.known_faces_encodings = known_faces_encodings
        self.known_names = known_names    
    
    def startFaceRecognition(self):
        print("Starting Preview")
        logsFile = open(f"{date.today()}.txt", "w")
        frameCount = 1  # Frame Count
        video_cap = cv2.VideoCapture(0)
        # Define the codec and create VideoWriter object 
        fourcc = cv2.VideoWriter_fourcc(*'XVID') 
        out = cv2.VideoWriter('output.avi', fourcc, 20.0, (640, 480)) 

        face_locations = []
        face_names = []
        user_face = []
        process = True
        while True:
            ret, frame = video_cap.read()
            small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
            rgb_small_frame = small_frame[:, :, ::-1]
            if process:
                
                face_locations = face_recognition.face_locations(
                    rgb_small_frame)
                user_face = face_recognition.face_encodings(
                    rgb_small_frame, face_locations)
                face_names = []
                for user in user_face:
                    match = face_recognition.compare_faces(
                        self.known_faces_encodings, user)

                    name = "Unknown"
                    if True in match:
                        first_match_index = match.index(True)
                        name = self.known_names[first_match_index]
                    face_names.append(name)

            process = not process
            if "Unknown" not in face_names:
                for (top, right, bottom, left), name in zip(face_locations, face_names):
                    top *= 4
                    right *= 4
                    bottom *= 4
                    left *= 4
                    cv2.rectangle(frame, (left, top),
                                  (right, bottom), (0, 0, 255), 2)
                    cv2.rectangle(frame, (left, bottom-35),
                                  (right, bottom), (0, 0, 255), cv2.FILLED)
                    font = cv2.FONT_HERSHEY_DUPLEX
                    cv2.putText(frame, name, (left + 6, bottom - 6),
                                font, 1.0, (255, 255, 255), 1)
                    dateTime = datetime.now()
                    timestr = dateTime.strftime("%H:%M")
                    datestr = dateTime.strftime("%d %b,%y")
                    if frameCount < 100:
                        self.activity_log.append(
                            f"{name} is seen on {datestr} at {timestr} \n")
                    frameCount += 1
                    self.frameArr.append(frame)
            cv2.imshow('Video', frame)
            out.write(frame)
            if cv2.waitKey(1) & 0xFF == ord('q'):
                general = General()
                self.activity_log = general.sortActivityLog(self.activity_log)
                logsFile.writelines(self.activity_log)
                logsFile.close()
                dir = dirname(__file__)
                path = join(dir, f"{date.today()}.txt")
                if general.isFileEmpty(path) is False:
                    print("Activity Log has been generated.")
                break
        video_cap.release()
        out.release()
        cv2.destroyAllWindows()
