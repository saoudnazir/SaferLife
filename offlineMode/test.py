import cv2
import numpy as np

cap = cv2.VideoCapture(0)
while True:
    ret, frame = cap.read()
    height = np.size(frame, 0)
    width = np.size(frame, 1)
    print(height,width)
    cv2.imshow("s",frame)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()