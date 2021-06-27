from sys import exit
from time import sleep
import busio
import board
import adafruit_amg88xx
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522


try:
    i2c = busio.I2C(board.SCL, board.SDA)
    amg = adafruit_amg88xx.AMG88XX(i2c)
    reading=SimpleMFRC522()
except:
    print("Couldn't load AMG88XX sensor, please try to reattach the it")
    exit()


def readUserId():
    try:
        id, text = reading.read()
        return(id)
    except:
        print("Error reading user ID")
    finally:
        GPIO.cleanup()


#Reading temprature
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
            

def rLed():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    GPIO.output(red,True)
    sleep(3)
    GPIO.output(red,False)
    sleep(0.5)
    GPIO.cleanup()

def gLed():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(10):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()

def gBlink():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(3):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()
    
def gBlink2():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    for _ in range(2):
        GPIO.output(green,True)
        sleep(0.1)
        GPIO.output(green,False)
        sleep(0.1)
    GPIO.cleanup()

def rBlink():
    red = 12
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(red, GPIO.OUT)
    for _ in range(3):
        GPIO.output(red,True)
        sleep(0.1)
        GPIO.output(red,False)
        sleep(0.1)
    GPIO.cleanup()


def main():
    gBlink2()
    u = readUserId()
    if not u.isdigit():
        rBlink()
        main()
    else:
        print("UserID : ",u)
        gBlink()
        sleep(1)
        t = readTemperature()
        if t <= 37.7:
            gLed()
            print("Temperature is ",t," degrees, Door Opened!")
        else:
            rLed()
            print("Temperature is ",t," degrees, Door Closed!")

main()