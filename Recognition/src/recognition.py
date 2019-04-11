from os.path import dirname, join
import cv2
import face_recognition
import array as arr
import json


class Recognition():
    known_faces_encodings = []
    known_names = []

    def __init__(self, known_faces_encodings, known_names):
        self.known_faces_encodings = known_faces_encodings
        self.known_names = known_names

    def startFaceRecognition(self):
        print("Starting Preview")
        video_cap = cv2.VideoCapture(0)
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
            cv2.imshow('Video', frame)
            if cv2.waitKey(1) & 0xFF == ord('q'):
                break
        video_cap.release()
        cv2.destroyAllWindows()
