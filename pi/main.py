from sys import exit
import cv2
import time
import busio
import board
import adafruit_amg88xx
import requests
import socket
from statistics import mean
from pyzbar import pyzbar
from pydub import AudioSegment
from pydub.playback import play


try:
    i2c = busio.I2C(board.SCL, board.SDA)
    amg = adafruit_amg88xx.AMG88XX(i2c)
except:
    alrt = AudioSegment.from_wav("alert.wav")
    play(alrt)
    print("Couldn't load AMG88XX sensor, please try to reattach the it")


def isConnected():
    try:
        sock = socket.create_connection(("www.google.com", 80))
        if sock is not None:
            sock.close
        return True
    except OSError:
        pass
        return False


#Scan usernames from QR reader RETURN username OR fullname & phone for guests
def readUsr():
    camera = cv2.VideoCapture(0)
    ret, frame = camera.read()
    text = ""
    while ret:
        ret, frame = camera.read()
        barcodes = pyzbar.decode(frame)
        for barcode in barcodes:
            x, y , w, h = barcode.rect
            text = barcode.data.decode('utf-8')
            return text
            cv2.rectangle(frame, (x, y),(x+w, y+h), (0, 255, 0), 2)
        cv2.imshow('Barcode reader', frame)
        if cv2.waitKey(1) and 0xFF == 27:
            break
    camera.release()
    cv2.destroyAllWindows()


#Reading temprature
def tempRead():
    if True:
        for row in amg.pixels:
            temp = ['{0:0.2f}'.format(x) for x in row]
        rslt = list(map(float, temp))
        avg = 0
        avg = mean(rslt)
        if avg == 0:
            tempRead()            
        else:
            if avg >= 35 or avg <= 40:
                return avg
            else:
                tempRead()


#Update temp in database for regestred users, Paramaters are username & temp
def upDb(usr, temp):
    userdata = {"username": usr, "temp": temp}
    resp = requests.get('https://itemp.ml/app/updb.php', params=userdata, headers={"User-agent":"ab"})
    #return(resp.text)


#Check if the guest already in database or not   
def checkDb(num):
    userdata = {"phone": num}
    resp = requests.get('https://itemp.ml/app/phonesearch.php', params=userdata, headers={"User-agent":"ab"})
    if resp.text == "1":
        return True
    else:
        return False

    
#Sends temp to database for guests, Paramaters are username & temp
def instoGuest(fname, num, temp):
    userdata = {"fullname": fname,"phone": num, "temp": temp}
    resp = requests.get('https://itemp.ml/app/instodb.php', params=userdata, headers={"User-agent":"ab"})
    #return(resp.text)


#Update new temp to database for guests, Paramaters are username & temp
def updGuest(phn, temp):
    userdata = {"phone": phn, "temp": temp}
    resp = requests.get('https://itemp.ml/app/updateexistngguest.php', params=userdata, headers={"User-agent":"ab"})
    #return(resp.text)

def saveToFileGst(fname, phn, temp):
    g=open("guests.txt","a")
    data = {"Full Name": fname, "Phone" : phn , "Temp": temp}
    s = str(data)
    g.write(str(s+"\n"))
    g.close()


def saveToFileUsr(uname, temp):
    f=open("users.txt","a")
    d = {"Username": uname, "Temp": temp}
    s = str(d)
    f.write(str(s+"\n"))
    f.close()


def onMain():
    succ = AudioSegment.from_wav("ok.wav")
    alrt = AudioSegment.from_wav("alert.wav")
    hight = AudioSegment.from_wav("hightemp.wav")
    u = readUsr()
    t = tempRead()
    if ',' in u:
        s = u.split(",")
        fname = (s[0])
        phone = (s[1])
        c = checkDb(phone)
        if t >= 36 or t <= 38:
            if c == True:
                updGuest(phone, t)
                play(succ)
                time.sleep(1)
                main()
            else :
                instoGuest(fname, phone, t)
                play(succ)
                time.sleep(1)
                main()
        else:
            play(hight)
            time.sleep(1)
            main()
    else:
        if t >= 36 or t <= 38:
            upDb(u, t)
            play(succ)
            time.sleep(1)
            main()
        else:
            play(hight)
            time.sleep(1)
            main()

def offMain():
    #read usr and temp without DB checking, save to txt file
    succ = AudioSegment.from_wav("ok.wav")
    alrt = AudioSegment.from_wav("alert.wav")
    u = readUsr()
    t = tempRead()
    if "," in u:
        s = u.split(",")
        fname = (s[0])
        phone = (s[1])
        if t >= 36 or t <= 38:
            saveToFileGst(fname, phone, t)
            play(succ)
            time.sleep(1)
            main()
        else:
            play(hight)
            time.sleep(1)
            main()
    else:
        if t >= 36 or t <= 38:
            saveToFileUsr(u, t)
            play(succ)
            time.sleep(1)
            main()
            
        else:
            play(hight)
            time.sleep(1)
            main()

def main():
    if isConnected() == True:
        onMain()
    else:
        offMain()

main()
