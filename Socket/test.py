import cv2

cap = cv2.VideoCapture(0)
cap.set(3,320)
cap.set(4,260)
ret,frame = cap.read()
print(frame)
cv2.imshow("Frame",frame)
cap.release()