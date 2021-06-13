from sys import exit
import time
import busio
import board
import adafruit_amg88xx
import requests
import socket
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522


try:
    i2c = busio.I2C(board.SCL, board.SDA)
    amg = adafruit_amg88xx.AMG88XX(i2c)
    reading=SimpleMFRC522()
except:
    print("Couldn't load AMG88XX sensor, please try to reattach the it")
    exit()


#Check if the device has internet connection or no
def isConnected():
    try:
        sock = socket.create_connection(("www.google.com", 80))
        if sock is not None:
            sock.close
        return True
    except OSError:
        pass
        return False
#Read RFID data
def readR():
    try:
        id, text=reading.read()
        return(id)
    except:
        print("Error reading user ID")
    finally:
        GPIO.cleanup()

#Reading temprature
def readTemp():
    while True:
        te = '{0:0.2f}'.format(amg.temperature)
        #print(te)
        for j in range (5):
            x = (amg.pixels[4:5])
            y = (amg.pixels[5:6])
        z = x + y
        flattn = [item for sublist in z for item in sublist]
        flattn.sort()
        fl = '{0:0.2f}'.format(flattn[-1])
        teF = float(te)
        flF = float(fl)
        t = (teF+flF) /2
        t = round(t, 2)
        if t != 0:            
            if t >= 36 and t <= 40:
                return round(t, 2)
            elif t >= 34.2 and t <= 35.9:
                return round(t + 2.2, 2)
            elif t >= 31.5 and t <= 34.2:
                return round(t + 3.6, 2)
            else:
                readTemp()
        else:
            readTemp()

#Check user id in database
def isUsr(usrid):
    try:
        userdata = {"uid": usrid}
        resp = requests.get('https://itemp.ml/app/isusr.php', params=userdata, headers={"User-agent":"ab"})
        if resp.text == "1":
            return True
        else:
            return False
    except:
        return True
        
#Update temp in database for registred users, Paramaters are userid & temp
def upUser(usr, temp):
    try:
        userdata = {"userid": usr, "temp": temp}
        requests.get('https://itemp.ml/app/updb.php', params=userdata, headers={"User-agent":"ab"})
    except:
        saveToFileUsr(usr, temp)

#Save users data in txt file
def saveToFileUsr(uname, temp):
    f = open("users.txt","a")
    d = {"UserID": uname, "Temp": temp}
    s = str(d)
    f.write(str(s+"\n"))
    f.close()

def rLed():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    GPIO.output(red,True)
    time.sleep(3)
    GPIO.output(red,False)
    time.sleep(0.5)
    GPIO.cleanup()

def gLed():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    i=0
    for i in range(10):
        GPIO.output(green,True)
        time.sleep(0.1)
        GPIO.output(green,False)
        time.sleep(0.1)
    GPIO.cleanup()

def gBlink():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    i=0
    for i in range(4):
        GPIO.output(green,True)
        time.sleep(0.1)
        GPIO.output(green,False)
        time.sleep(0.1)
    GPIO.cleanup()
    
def gBlink2():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    i=0
    for i in range(2):
        GPIO.output(green,True)
        time.sleep(0.1)
        GPIO.output(green,False)
        time.sleep(0.1)
    GPIO.cleanup()

def rBlink():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    i=0
    for i in range(3):
        GPIO.output(red,True)
        time.sleep(0.1)
        GPIO.output(red,False)
        time.sleep(0.1)
    GPIO.cleanup()

def rBlink2():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    i=0
    for i in range(2):
        GPIO.output(red,True)
        time.sleep(0.1)
        GPIO.output(red,False)
        time.sleep(0.1)
    GPIO.cleanup()

#Online
def onMain():
    gBlink2()
    u = str(readR())
    if isUsr(u) == False:
        rBlink2()
        main()
    else:
        print("User : " + u)
        gBlink()
        time.sleep(1)
        t = readTemp()
        if t <= 37.7:
            t2=str(t)
            gLed()
            print("Temperature is " + t2 + " degrees, Door Opened!")
            try:
                upUser(u, t)
            except:
                saveToFileUsr(u, t)
                main()
            main()
        else:
            t2=str(t)
            rLed()
            print("Temperature is " + t2 + " degrees, Door Closed!")
            time.sleep(1)
            main()

#Offline
def offMain():
    gBlink2()
    u = str(readR())
    if not u.isdigit():
        rBlink()
        offMain()
    gBlink()
    time.sleep(1)
    t = readTemp()
    if t <= 37.7:
        t2=str(t)
        gLed()
        print("Temperature is " + t2 + " degrees, Door Opened!")
        saveToFileUsr(u, t)
        main()           
    else:
        t2=str(t)
        rLed()
        print("Temperature is " + t2 + " degrees, Door Closed!")
        time.sleep(1)
        main()

#Main
def main():
    if isConnected() == True:
        onMain()
    else:
        offMain()

main()
