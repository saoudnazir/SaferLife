import cv2

cap = cv2.VideoCapture(0)
W = cap.get(3)
H = cap.get(4)
fourcc = cv2.VideoWriter_fourcc(*'DIVX')
out = cv2.VideoWriter('test.avi',fourcc, 20.0, (int(W),int(H)),True)

while True:
    ret, frame = cap.read()
    out.write(cv2.flip(frame, 180))
    cv2.imshow("Frame",frame)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
    
out.release()
cap.release()
cv2.destroyAllWindows()
