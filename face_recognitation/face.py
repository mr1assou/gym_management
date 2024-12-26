import cv2
import numpy as np
import face_recognition
import os
from datetime import datetime
from connect import DatabaseConnection
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
def send_email(sender_email, receiver_email, subject, body):
    smtp_server = "smtp-relay.brevo.com"
    smtp_port = 587
    smtp_login = "75a2ad002@smtp-brevo.com"
    smtp_password = "kMhwZ2DHTE4qIn6J"
    message = MIMEMultipart()
    message["From"] = sender_email
    message["To"] = receiver_email
    message["Subject"] = subject
    message.attach(MIMEText(body, "plain"))
    try:
        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()  
        server.login(smtp_login, smtp_password)
        text = message.as_string()
        server.sendmail(sender_email, receiver_email, text)
        print("Email sent successfully!")
    except Exception as e:
        print(f"An error occurred: {e}")
    finally:
        server.quit()
def get_expired_clients():
    connection = DatabaseConnection.create_connection()
    cursor = connection.cursor()
    cursor.execute("{CALL searchClientsMonthExpired(?)}", (1117,))
    encodedRejectedFaces=[]
    expired_clients =[]
    for row in cursor.fetchall():
        faceEncodings=face_recognition.face_encodings(face_recognition.load_image_file(row[3]))
        if faceEncodings:
            expired_clients.append([row[1],row[2],faceEncodings[0]])
            encodedRejectedFaces.append(faceEncodings[0])
    connection.close()
    return expired_clients,encodedRejectedFaces

def load_known_faces(images_path="../images/"):
    expiredClients,encodedRejectedFaces=get_expired_clients()
    accessClients = []
    # Loop through each image in the directory
    for file in os.listdir(images_path):
        if file.endswith(('jpg', 'jpeg', 'png')):
            try:   
                face_image = face_recognition.load_image_file(f"{images_path}{file}")
                face_encodings = face_recognition.face_encodings(face_image)
                if face_encodings:
                    matches=face_recognition.compare_faces(encodedRejectedFaces,face_encodings[0],tolerance=0.6)
                    if True not in matches:
                        accessClients.append(face_encodings[0])
            except Exception as e:
                print(f"× Error processing {file}: {str(e)}")
    return encodedRejectedFaces,expiredClients,accessClients

def recognize_faces():
    count=0
    encodedRejectedFaces, expiredClients, accessClients = load_known_faces()
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')    
    cap = cv2.VideoCapture(0)
    while True:
        ret, frame = cap.read()
        if not ret:
            break
        # Convert the frame to RGB for face recognition
        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        # Detect faces using OpenCV
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))
        # Find all face encodings in the current frame
        face_locations = face_recognition.face_locations(rgb_frame)
        face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)
        # Loop through the faces detected
        for (x, y, w, h), face_encoding in zip(faces, face_encodings):
            # Check if the current face encoding matches any of the rejected faces
            matches = face_recognition.compare_faces(encodedRejectedFaces, face_encoding)
            matches2 = face_recognition.compare_faces(accessClients, face_encoding)
            # If a match is found, draw a red square and label it "Rejected"
            if True in matches:
                for row in expiredClients:
                    if(True in face_recognition.compare_faces([face_encoding], row[2])):
                        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 0, 255), 2) 
                        cv2.putText(frame, f"{row[0]} {row[1]} Rejected", (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 0, 255), 2)
                        # here i need to send the email 
                        if count<1:
                            send_email("marwane.assou@gmail.com","marwane.assou@e-polytechnique.ma","expired member entred","expired member entred")
                            count+=1
            # If it's not rejected, draw a green square (or you could label it "Accepted")
            elif True in matches2 and True not in matches:
                if True in matches2:
                    cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2) 
                    cv2.putText(frame, f"Access", (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
            else:
                cv2.rectangle(frame, (x, y), (x + w, y + h), (255,0, 0), 2)  
                cv2.putText(frame, f"unknown", (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (255, 0, 0), 2)
        # Display the frame with the detection results
        cv2.imshow('Face Recognition', frame)
        # Break the loop if 'q' is pressed
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break
    # Release the webcam and close all OpenCV windows
    cap.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    recognize_faces()