import cv2
import face_recognition
import array as arr
import json
from general import General
from datetime import datetime
from os.path import dirname, join
import os


class Recognition:
    known_faces_encodings = []
    known_names = []
    known_IDs = []

    def __init__(self, known_faces_encodings, known_names,known_IDs):
        self.known_faces_encodings = known_faces_encodings
        self.known_names = known_names
        self.known_IDs = known_IDs


    def startFaceRecognition(self):
        face_locations = []
        face_names = []
        user_face = []
        user_ID = []
        process = True     
        imgCount = 1
        activityLog = []
        cap = cv2.VideoCapture(0)
        while True:
            ret , frame = cap.read()
            print(ret)
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
                    id = 0
                    if True in match:
                        first_match_index = match.index(True)
                        name = self.known_names[first_match_index]
                        id = self.known_IDs[first_match_index]
                    face_names.append(name)
                    user_ID.append(id)

            process = not process
            if "Unknown" in face_names:
                    cv2.imwrite(f"Unknown{imgCount}.jpg",frame)
                    imgCount+=1
            for (top, right, bottom, left), name, id in zip(face_locations, face_names,user_ID):
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
                now = datetime.now()
                current_time = now.strftime("%H:%M")
                current_date = now.strftime("%Y-%m-%d")
                activityLog.append(f"{name} is seen on {current_time}\n")
            cv2.imshow("Frames",frame)
            if cv2.waitKey(1) & 0xFF == ord('q'):
                g = General()
                activityLog = g.sortActivityLog(activityLog)
                path = join(dirname(__file__),f"Logs/{current_date}.txt")
                with open(path,"w") as file:
                    file.writelines(activityLog)
                print(path)
                break
        cap.release()
        cv2.destroyAllWindows()