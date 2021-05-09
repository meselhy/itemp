import time
import busio
import board
import adafruit_amg88xx
from statistics import mean


i2c = busio.I2C(board.SCL, board.SDA)
amg = adafruit_amg88xx.AMG88XX(i2c)

def readTemp():
    if True:
        for row in amg.pixels:
            time.sleep(0)
            xtemp = ['{0:0.2f}'.format(temp) for temp in row]
            return xtemp



def Average(x):
    return mean(x)

readTemp()


def main():
   
 abd = list(map(float,readTemp()))
 average = Average(abd)
 if average == 0.00:
     #print(average)
     readTemp()
     y = list(map(float, readTemp()))
     avera = Average(y)
     print("Average of the list =", round(avera, 2))
     
if __name__ == '__main__':
    main()