from sys import exit
from time import sleep
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


#Check if the device has internet connection
def isConnected():
    try:
        sock = socket.create_connection(("www.google.com", 80))
        if sock is not None:
            sock.close
        return True
    except OSError:
        pass
        return False

#Read user id from RFID
def readUserId():
    try:
        id, text = reading.read()
        return(str(id))
    except:
        print("Error reading user ID")
    finally:
        GPIO.cleanup()


#Measuring temperature
def readTemperature():
    while True:
        highestTemperature = 39
        for _ in range (6):
            row5 = (amg.pixels[4:5])
            row6 = (amg.pixels[5:6])
        row56 = row5 + row6
        flatten = [item for sublist in row56 for item in sublist]
        flatten.sort()
        highestTemperatureInFlatten = '{0:0.2f}'.format(flatten[-1])
        highestTemperatureFloat = float(highestTemperature)
        highestTemperatureInFlattenFloat = float(highestTemperatureInFlatten)
        temperature = (highestTemperatureFloat + highestTemperatureInFlattenFloat) /2
        temperature = round(temperature, 2)
        if temperature != 0:            
            if temperature >= 36 and temperature <= highestTemperature:
                return round(temperature, 2)
            elif temperature >= 32 and temperature <= 34:
                return round(temperature + 3.8, 2)
            elif temperature >= 34 and temperature <= 36:
                return round(temperature + 2.2, 2)
            else:
                readTemperature()
        else:
            readTemperature()


#Check user id in database
def isUser(userid):
    try:
        userdata = {"userid": userid}
        response = requests.get('https://itemp.ml/app/isusr.php', params=userdata, headers={"User-agent":"ab"})
        if response.text == "1":
            return True
        else:
            return False
    except:
        return True
       

#Update temperature in database
def updateUser(userid, temperature):
    try:
        userdata = {"userid": userid, "temperature": temperature, "device": "A", "gate": "A"}
        response = requests.get('https://itemp.ml/app/upuser.php', params=userdata, headers={"User-agent":"ab"})
        if response.text == "1":
            pass
        elif response.text == "0":
            saveToFile(userid, temperature)
    except:
        saveToFile(userid, temperature)


#Save users data in txt file (if no internet connection)
def saveToFile(userid, temperature):
    file = open("users.txt","a")
    data = {"UserID": userid, "Temperature": temperature, "Device": "A", "Gate": "A"}
    stringData = str(data)
    file.write(str(stringData + "\n"))
    file.close()


def redLed():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    GPIO.output(red,True)
    sleep(3)
    GPIO.output(red,False)
    sleep(0.5)
    GPIO.cleanup()

def greenLed():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(10):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()

def greenBlink():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(4):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()
    
def greenBlink2():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(2):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()

def redBlink():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    for _ in range(3):
        GPIO.output(red,True)
        sleep(0.1)
        GPIO.output(red,False)
        sleep(0.1)
    GPIO.cleanup()

def redBlink2():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    for _ in range(2):
        GPIO.output(red,True)
        sleep(0.1)
        GPIO.output(red,False)
        sleep(0.1)
    GPIO.cleanup()

#Online
def onlineMain():
    greenBlink2()
    u = readUserId()
    if isUser(u) == False:
        redBlink2()
        sleep(1)
        main()
    else:
        print("User : ",u)
        greenBlink()
        sleep(1)
        t = readTemperature()
        if t <= 37.7:
            print("Temperature is ",t," degrees, Door Opened!")
            greenLed()
            try:
                updateUser(u, t)
            except:
                saveToFile(u, t)
                main()
            main()
        else:
            print("Temperature is ",t," degrees, Door Closed!")
            redLed()
            sleep(1)
            main()

#Offline
def offlineMain():
    greenBlink2()
    u = readUserId()
    if not u.isdigit():
        redBlink2()
        sleep(1)
        main()
    else:
        print("User : ",u)
        greenBlink()
        sleep(1)
        t = readTemperature()
        if t <= 37.7:
            print("Temperature is ",t," degrees, Door Opened!")
            greenLed()
            saveToFile(u, t)
            main()           
        else:
            print("Temperature is ",t," degrees, Door Closed!")
            redLed()
            sleep(1)
            main()

#Main
def main():
    if isConnected() == True:
        onlineMain()
    else:
        offlineMain()

main()