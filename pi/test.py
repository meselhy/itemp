#!/usr/bin/env python
from sys import exit
import time
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
            if t >= 36 and t <= 40:#36  40
                return round(t, 2)
            elif t >= 34.2 and t <= 35.9:#35   36
                return round(t + 2.2, 2)
            elif t >= 31.5 and t <= 34.2:#32.9  35.9
                return round(t + 3.6, 2)
            else:
                readTemp()
        else:
            readTemp()
            

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
        i+1
    GPIO.cleanup()

def gBlink():
    green = 13
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(green, GPIO.OUT)
    i=0
    for i in range(3):
        GPIO.output(green,True)
        time.sleep(0.1)
        GPIO.output(green,False)
        time.sleep(0.1)
        i+1
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
        i+1
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
        i+1
    GPIO.cleanup()


def main():
    gBlink2()
    u = str(readR())
    if not u.isdigit():
        rBlink()
        main()
    print("UserID : " + u)
    gBlink()
    time.sleep(1)
    t = readTemp()
    if t <= 37.7:
        t2=str(t)
        gLed()
        print("Temperature is " + t2 + " degrees, Door Opened!")
    else:
        t2=str(t)
        rLed()
        print("Temperature is " + t2 + " degrees, Door Closed!")

main()