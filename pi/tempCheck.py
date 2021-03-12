# SPDX-FileCopyrightText: 2021 ladyada for Adafruit Industries
# SPDX-License-Identifier: MIT
# Hanna update
import time
import busio
import board
import adafruit_amg88xx
from statistics import mean

i2c = busio.I2C(board.SCL, board.SDA)
amg = adafruit_amg88xx.AMG88XX(i2c)

if True:
    for row in amg.pixels:
        #print(['Thermistor Temp = {0:0.2f} *C'.format(temp) for temp in row])
        time.sleep(0)
        xtemp = ['{0:0.2f}'.format(temp) for temp in row]
        print(xtemp)
    
x = list(map(float, xtemp))
 
def Average(x):
    return mean(x)

average = Average(x)
print("Average of the list =", round(average, 2))
