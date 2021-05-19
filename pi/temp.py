from sys import exit
import cv2
import time
import busio
import board
import adafruit_amg88xx
import requests
from statistics import mean
from pyzbar import pyzbar
from pydub import AudioSegment
from pydub.playback import play


i2c = busio.I2C(board.SCL, board.SDA)
amg = adafruit_amg88xx.AMG88XX(i2c)

# checking the username from  qr reader is mandatory for the temp to run
# the code should be waiting the user to inter qr code infront of cam


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
        if cv2.waitKey(1) and 0xFF == 27: #barcode_text!="": 
            break
# free camera object and exit
    camera.release()
    cv2.destroyAllWindows()


# Read temprature and return it
def tempRead():
    if True:
        for row in amg.pixels:
            #time.sleep(0)
            xtemp = ['{0:0.2f}'.format(temp) for temp in row]
        rslt = list(map(float, xtemp))
        avg = 0
        avg = mean(rslt)
        #print("Average of the list =", round(avg, 2))
        if avg == 0:
            tempRead()
        elif avg != 0:
            if avg >= 35 or avg <= 40:
                #send it to db
                return avg
            else:
                tempRead()
        else:
            return avg

# Check if the user is guest or not RETUNR TRUE/FALSE
def isGuest(x):
    #call readUsr() to check if the user is guest or not / if true todb will be used else updb
    #x = readUsr()
    userdata = {"username": x}
    resp = requests.get('https://itemp.ml/app/isguest.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.text)
    if resp.text == "1":
        return True
    else:
        return False
    
def checkDb(x):
    #call readUsr() to check if the user is guest or not / if true todb will be used else updb
    #x = readUsr()
    userdata = {"phone": x}
    resp = requests.get('https://itemp.ml/app/phonesearch.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.text)
    if resp.text == "1":
        return True
    else:
        return False

# Sends temp to database, Paramaters are username & temp   #for guests
def toDb(usr, tempp):
    # send the new temp to the db
    userdata = {"username": usr, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/todb.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    return(resp.text)

# Update updated temp to database, Paramaters are username & temp  #for regestred users
def upDb(usr, tempp):
    # send the new temp to the db
    userdata = {"username": usr, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/updb.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    return(resp.text)
    
    

def instoGuest(fname,num, tempp):
    # send the new temp to the db
    userdata = {"fullname": fname,"phone": num, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/instodb.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    return(resp.text)

def updGuest(usr, tempp):
    # send the new temp to the db
    userdata = {"phone": usr, "temp": tempp}
    resp = requests.get('https://itemp.ml/app/updateexistngguest.php', params=userdata, headers={"User-agent":"ab"})
    #print(resp.status_code)
    return(resp.text)



def main():
    u = readUsr()
    if ',' in u:
        l=u.split(",")
        fname=(l[0])
        phone=(l[1])
        g = isGuest(phone)
        if g == False:
            l=u.split(",")
            fname=(l[0])
            phone=(l[1])
            z=checkDb(phone)
            t = tempRead()
            if t >= 36 or t <= 38:
                if z==True:
                    updGuest(phone, t)
                    song = AudioSegment.from_wav("ok.wav")
                    play(song)
                    main()
                else :
                    instoGuest(fname,phone, t)
                    song = AudioSegment.from_wav("ok.wav")
                    play(song)
                    main()
            else:
                song = AudioSegment.from_wav("err.wav")
                play(song)
                main()
    else:
        t = tempRead()
        if t >= 36 or t <= 38:
            song = AudioSegment.from_wav("ok.wav")
            play(song)
            upDb(u, t)
            main()
        else:
            song = AudioSegment.from_wav("err.wav")
            play(song)
            main()
           
    #print(u)
    #tempRead()
    
            
main()
