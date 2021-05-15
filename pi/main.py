from sys import exit
import cv2
import time
import busio
import board
import adafruit_amg88xx
import requests
from statistics import mean

i2c = busio.I2C(board.SCL, board.SDA)
amg = adafruit_amg88xx.AMG88XX(i2c)

# checking the username from  qr reader is mandatory for the temp to run
# the code should be waiting the user to inter qr code infront of cam

def main():
    u = readUsr()
    #tempRead()
    g = isGuest(u)
    if g == True
        t = tempRead()
        upDb(u, t)
        main()
    else
        t = tempRad()
        toDb(u, t)
        main()

main()

#Scan usernames from QR reader RETURN username
def readUsr():
    camera = cv2.VideoCapture(0)
    ret, frame = camera.read()
    barcode_text=""
    while ret:
        ret, frame = camera.read()
        barcodes = pyzbar.decode(frame)
        for barcode in barcodes:
           x, y , w, h = barcode.rect
           barcode_text = barcode.data.decode('utf-8')
           #print(barcode_text)
           return barcode_text
           cv2.rectangle(frame, (x, y),(x+w, y+h), (0, 255, 0), 2)
        cv2.imshow('Barcode reader', frame)
        if cv2.waitKey(1) and barcode_text!="": #0xFF == 27:
            break
# free camera object and exit
cap.release()
cv2.destroyAllWindows()


# Read temprature and return it
def tempRead():
    if True:
    	for row in amg.pixels:
        	#time.sleep(0)
        	xtemp = ['{0:0.2f}'.format(temp) for temp in row]
	rslt = list(map(float, xtemp))
	avg = mean(rslt)
	#print("Average of the list =", round(avg, 2))
    if avg == 0:
        return tempRead()
    elif avg != 0:
        if avg >= 35 or avg <= 40:
            #send it to db
            return avg
        else
            return tempRead()
            #OR
            exit()
    else
        return avg
        exit()

# Check if the user is guest or not RETUNR TRUE/FALSE
def isGuest(x):
    #call readUsr() to check if the user is guest or not / if true todb will be used else updb
    x = readUsr()
    userdata = {"username": x}
    resp = requests.get('https://itemp.ml/app/isguest.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.text)
    if resp.text == 1:
        return True
    else:
        return False


# Sends temp to database, Paramaters are username & temp   #for guests
def toDb(usr, tempp):
    # send the new temp to the db
    userdata = {"username": usr, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/todb.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    #print(resp.text)

# Update updated temp to database, Paramaters are username & temp  #for regestred users
def upDb(usr, tempp):
    # send the new temp to the db
    userdata = {"username": usr, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/updb.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    #print(resp.text)
